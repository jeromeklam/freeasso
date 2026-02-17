<?php

namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * LLM Controller for FreeAsso
 *
 * Provides natural language query capabilities scoped to the current group.
 *
 * @author jeromeklam
 */
class Llm extends \FreeFW\Core\ApiController
{

    /**
     * Comportement
     */
    use \FreeAsso\Controller\Behavior\Group;

    /**
     * Process a natural language query scoped to FreeAsso models
     *
     * POST /v1/asso/llm/query
     *
     * Accepts JSON:API: { "data": { "type": "FreeAsso_LlmQuery", "attributes": { "query": "..." } } }
     * Returns JSON:API with filter in FreeFW format: { "field": { "op": "value" } }
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function naturalQuery(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Llm.naturalQuery.start');

        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);

        if (!$apiParams->hasData()) {
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        }

        /**
         * @var \FreeAsso\Model\LlmQuery $data
         */
        $data = $apiParams->getData();
        $query = $data->getLlmqQuery();

        if (empty($query)) {
            return $this->createErrorResponse(
                FFCST::ERROR_IN_DATA,
                'Query parameter is required'
            );
        }

        try {
            // Get LLM config
            $config = $this->getAppConfig();
            $llmProvider = $config->get('llm:provider', 'ollama');

            // Instantiate centralized LLM configuration
            $llmConfig = new \FreeAsso\Service\LlmConfiguration($config, $this->logger);

            // Create provider based on config
            if ($llmProvider === 'anthropic') {
                $apiKey = $config->get('llm:anthropic_api_key', '');
                $model = $config->get('llm:anthropic_model', 'claude-sonnet-4-5-20250929');
                $timeout = intval($config->get('llm:anthropic_timeout', 30));
                $provider = new \FreeFW\Service\Llm\Providers\AnthropicProvider($apiKey, $model);
                $provider->setTimeout($timeout);
            } else {
                $ollamaUrl = $config->get('llm:ollama_url', 'http://localhost:11434');
                $ollamaModel = $config->get('llm:ollama_model', 'llama3.1:8b');
                $ollamaTimeout = intval($config->get('llm:ollama_timeout', 300));
                $provider = new \FreeFW\Service\Llm\Providers\OllamaProvider($ollamaUrl, $ollamaModel);
                $provider->setTimeout($ollamaTimeout);
            }
            if (!$provider->isAvailable()) {
                return $this->createErrorResponse(
                    FFCST::ERROR_IN_DATA,
                    'LLM provider (' . $llmProvider . ') is not available'
                );
            }

            // Create QueryParser
            $parser = new \FreeFW\Service\Llm\QueryParser($provider, $config, $this->logger);

            // Build FreeAsso-specific model metadata (with FK fields)
            $modelMetadataMap = $this->buildFreeAssoMetadataMap($llmConfig);
            $parser->setAvailableResources($modelMetadataMap);

            // Inject few-shot examples from centralized config
            $parser->setExamples($llmConfig->getFewShotExamples());

            // Parse natural language to MongoDB-style query
            $result = $parser->parseNaturalLanguage($query, $modelMetadataMap);

            // Post-process: enrich filter with date context the LLM may have missed
            $result['filter'] = $this->enrichFilterWithDateContext($query, $result['filter'] ?? [], $result['resource'] ?? null, $llmConfig);

            // Post-process: add don_status = OK for donation queries (unless user asks for cancelled/rejected)
            $result['filter'] = $this->enrichFilterWithDonationStatus($query, $result['filter'] ?? [], $result['resource'] ?? null, $llmConfig);

            // Convert MongoDB filter to JSON:API filter format
            $mongoFilter = $result['filter'] ?? [];
            $jsonApiFilter = $this->mongoToJsonApiFilter($mongoFilter);

            // Convert MongoDB sort to JSON:API sort string
            $mongoSort = $result['sort'] ?? [];
            $jsonApiSort = $this->mongoToJsonApiSort($mongoSort);

            // Build response model
            $response = new \FreeAsso\Model\LlmQuery();
            $response
                ->setLlmqQuery($query)
                ->setLlmqResource($result['resource'] ?? null)
                ->setLlmqFilter($jsonApiFilter)
                ->setLlmqSort($jsonApiSort)
                ->setLlmqLimit($result['limit'] ?? 50)
            ;

            // Auto-save successful query to memory for future few-shot learning
            $this->saveToMemory(
                $query,
                $result['resource'] ?? null,
                $result['filter'] ?? [],
                $result['sort'] ?? [],
                $result['limit'] ?? 50
            );

            $this->logger->debug('FreeAsso.Llm.naturalQuery.end');
            return $this->createSuccessOkResponse($response);
        } catch (\Throwable $e) {
            $this->logger->error('FreeAsso.Llm.naturalQuery.error: ' . $e->getMessage());
            return $this->createErrorResponse(
                FFCST::ERROR_IN_DATA,
                'Error processing natural language query: ' . $e->getMessage()
            );
        }
    }

    /**
     * List FreeAsso models available for LLM queries
     *
     * GET /v1/asso/llm/models
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getModels(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Llm.getModels.start');

        try {
            $models = $this->buildFreeAssoMetadataMap();

            $response = new \FreeAsso\Model\LlmQuery();
            $response
                ->setLlmqResource(json_encode(array_keys($models)))
                ->setLlmqFilter($models)
            ;

            $this->logger->debug('FreeAsso.Llm.getModels.end');
            return $this->createSuccessOkResponse($response);
        } catch (\Throwable $e) {
            $this->logger->error('FreeAsso.Llm.getModels.error: ' . $e->getMessage());
            return $this->createErrorResponse(
                FFCST::ERROR_IN_DATA,
                'Error listing models: ' . $e->getMessage()
            );
        }
    }

    /**
     * Convert MongoDB-style filter to JSON:API filter format
     *
     * MongoDB:  { "$and": [{ "don_mnt": { "$gt": 100 } }, { "don_status": { "$eq": "OK" } }] }
     * JSON:API: { "don_mnt": { "gt": 100 }, "don_status": { "eq": "OK" } }
     *
     * MongoDB:  { "$or": [{ "cli_lastname": { "$contains": "Martin" } }, { "cli_firstname": { "$eq": "Jean" } }] }
     * JSON:API: { "or": { "cli_lastname": { "contains": "Martin" }, "cli_firstname": { "eq": "Jean" } } }
     *
     * @param array $mongoFilter
     *
     * @return array JSON:API filter format
     */
    protected function mongoToJsonApiFilter(array $mongoFilter): array
    {
        $result = [];

        foreach ($mongoFilter as $key => $value) {
            if ($key === '$and') {
                // $and is the default in JSON:API, flatten into root
                if (is_array($value)) {
                    foreach ($value as $subFilter) {
                        if (is_array($subFilter)) {
                            $converted = $this->mongoToJsonApiFilter($subFilter);
                            $result = array_merge($result, $converted);
                        }
                    }
                }
            } elseif ($key === '$or') {
                // $or becomes "or" key with nested conditions
                $orConditions = [];
                if (is_array($value)) {
                    foreach ($value as $subFilter) {
                        if (is_array($subFilter)) {
                            $converted = $this->mongoToJsonApiFilter($subFilter);
                            $orConditions = array_merge($orConditions, $converted);
                        }
                    }
                }
                $result['or'] = $orConditions;
            } elseif ($key === '$not') {
                // $not becomes "not" key
                if (is_array($value)) {
                    $result['not'] = $this->mongoToJsonApiFilter($value);
                }
            } elseif (strpos($key, '$') === 0) {
                // Any other $ operator at root level — skip or treat as unknown
                continue;
            } else {
                // Field condition: { "field": { "$op": value } } or { "field": scalar }
                if (is_array($value)) {
                    $fieldOps = [];
                    foreach ($value as $mongoOp => $opValue) {
                        $jsonApiOp = $this->mapMongoOpToJsonApi($mongoOp);
                        $fieldOps[$jsonApiOp] = $opValue;
                    }
                    $result[$key] = $fieldOps;
                } else {
                    // Implicit eq
                    $result[$key] = ['eq' => $value];
                }
            }
        }

        return $result;
    }

    /**
     * Map MongoDB operator to JSON:API operator name
     *
     * @param string $mongoOp e.g. '$gt', '$eq', '$contains'
     *
     * @return string JSON:API operator e.g. 'gt', 'eq', 'contains'
     */
    protected function mapMongoOpToJsonApi(string $mongoOp): string
    {
        $mapping = [
            '$eq'         => 'eq',
            '$ne'         => 'neq',
            '$gt'         => 'gt',
            '$gte'        => 'gte',
            '$lt'         => 'ltw',
            '$lte'        => 'ltwe',
            '$in'         => 'in',
            '$nin'        => 'nin',
            '$regex'      => 'contains',
            '$contains'   => 'contains',
            '$ncontains'  => 'ncontains',
            '$startsWith' => 'containsb',
            '$endsWith'   => 'containse',
            '$between'    => 'between',
            '$soundex'    => 'soundex',
            '$exists'     => 'nempty',
        ];
        return $mapping[$mongoOp] ?? ltrim($mongoOp, '$');
    }

    /**
     * Convert MongoDB sort to JSON:API sort string
     *
     * MongoDB:  { "don_ts": -1, "don_mnt": 1 }
     * JSON:API: "-don_ts,don_mnt"
     *
     * @param array $mongoSort
     *
     * @return string JSON:API sort string
     */
    protected function mongoToJsonApiSort(array $mongoSort): string
    {
        $parts = [];
        foreach ($mongoSort as $field => $direction) {
            if ($direction === -1 || $direction === '-1') {
                $parts[] = '-' . $field;
            } else {
                $parts[] = $field;
            }
        }
        return implode(',', $parts);
    }

    /**
     * Build metadata map for FreeAsso models with full field metadata
     *
     * Loads actual field names, types, and descriptions from each model's
     * StorageModel so the LLM knows the real database field names.
     * Enriches with FK fields using dot-notation (e.g., payment_type.ptyp_type).
     *
     * @param \FreeAsso\Service\LlmConfiguration|null $llmConfig
     *
     * @return array
     */
    protected function buildFreeAssoMetadataMap(\FreeAsso\Service\LlmConfiguration $llmConfig = null): array
    {
        // Get resource definitions from centralized config (or fallback)
        if ($llmConfig) {
            $modelDefs = $llmConfig->getResourceDefinitions();
        } else {
            $llmConfig = new \FreeAsso\Service\LlmConfiguration($this->getAppConfig(), $this->logger);
            $modelDefs = $llmConfig->getResourceDefinitions();
        }

        // Enrich each model with compact filterable field metadata
        $logger = ($this->logger instanceof \Psr\Log\AbstractLogger) ? $this->logger : null;
        $metadataGenerator = new \FreeFW\Service\LLMMetadataGenerator(
            $this->getAppConfig(),
            $logger
        );

        $result = [];
        foreach ($modelDefs as $resourceName => $def) {
            try {
                $model = \FreeFW\DI\DI::get($def['class']);
                if ($model) {
                    $metadata = $metadataGenerator->generateModelMetadata($model);
                    // Only keep filterable fields with compact info to reduce prompt size
                    $compactFields = [];
                    foreach (($metadata['fields'] ?? []) as $fname => $finfo) {
                        if (!empty($finfo['filterable'])) {
                            $compact = [
                                'type'        => $finfo['type'] ?? 'string',
                                'description' => $finfo['description'] ?? '',
                                'filterable'  => true,
                            ];
                            if (!empty($finfo['llm_description'])) {
                                $compact['llm_description'] = $finfo['llm_description'];
                            }
                            if (!empty($finfo['filter_aliases'])) {
                                $compact['filter_aliases'] = $finfo['filter_aliases'];
                            }
                            if (!empty($finfo['enum_values'])) {
                                $compact['enum_values'] = $finfo['enum_values'];
                            }
                            $compactFields[$fname] = $compact;
                        }
                    }
                    // Extract relationships (one-to-many) for cross-resource queries
                    $relationships = [];
                    if (method_exists($model, 'getRelationships')) {
                        foreach ($model->getRelationships() as $relName => $relDef) {
                            $relModel = $relDef[\FreeFW\Constants::REL_MODEL] ?? '';
                            // Convert FreeAsso::Model::Donation to FreeAsso_Donation
                            $relResource = str_replace(['::Model::', '::'], ['_', '_'], $relModel);
                            $relationships[$relName] = [
                                'resource' => $relResource,
                                'comment'  => $relDef[\FreeFW\Constants::REL_COMMENT] ?? '',
                            ];
                        }
                    }
                    $resourceMeta = [
                        'title'         => $def['title'],
                        'description'   => $def['description'],
                        'class'         => $def['class'],
                        'fields'        => $compactFields,
                        'relationships' => $relationships,
                    ];
                    // Enrich with FK fields (dot-notation: payment_type.ptyp_type, etc.)
                    $resourceMeta = $llmConfig->enrichMetadataWithFkFields($resourceMeta, $def['class']);
                    // Add synonyms from model's getLlmConfig()
                    $synonyms = $llmConfig->getSynonymsForResource($resourceName);
                    if (!empty($synonyms)) {
                        $resourceMeta['synonyms'] = $synonyms;
                    }
                    $result[$resourceName] = $resourceMeta;
                } else {
                    $result[$resourceName] = $def;
                }
            } catch (\Throwable $e) {
                $this->logger->debug(
                    'Llm.buildFreeAssoMetadataMap: failed for ' . $resourceName . ': ' . $e->getMessage()
                );
                $result[$resourceName] = $def;
            }
        }

        return $result;
    }

    /**
     * Enrich the LLM filter with date context that the LLM may have missed
     *
     * Small local LLMs often drop date conditions from multi-part queries.
     * This post-processor detects temporal keywords and adds the missing date filter.
     *
     * @param string $query Original natural language query
     * @param array $filter MongoDB-style filter from LLM
     * @param string|null $resource Identified resource
     * @param \FreeAsso\Service\LlmConfiguration|null $llmConfig
     *
     * @return array Enriched filter
     */
    protected function enrichFilterWithDateContext(string $query, array $filter, ?string $resource, \FreeAsso\Service\LlmConfiguration $llmConfig = null): array
    {
        $queryLower = mb_strtolower($query);

        // Get date field map from centralized config
        $dateFields = $llmConfig ? $llmConfig->getDateFieldMap() : [
            'FreeAsso_Donation'    => 'don_real_ts',
            'FreeAsso_Sponsorship' => 'spo_from',
            'FreeAsso_Receipt'     => 'rec_ts',
            'FreeAsso_Certificate' => 'cert_ts',
            'FreeAsso_Session'     => 'ses_from',
        ];

        $dateField = $dateFields[$resource] ?? null;
        if (!$dateField) {
            return $filter;
        }

        // Check if the filter already contains the date field
        if ($this->filterContainsField($filter, $dateField)) {
            return $filter;
        }

        // Detect temporal keywords and compute date value
        $dateCondition = null;

        // "this month" / "ce mois" / "du mois" / "mois en cours"
        if (preg_match('/\b(this month|ce mois|du mois|mois en cours|mois ci)\b/i', $queryLower)) {
            $dateCondition = [$dateField => ['$gte' => date('Y-m-01')]];
        }
        // "this year" / "cette année" / "de cette année" / "année en cours"
        elseif (preg_match('/\b(this year|cette ann[ée]e|de l\'ann[ée]e|ann[ée]e en cours)\b/i', $queryLower)) {
            $dateCondition = [$dateField => ['$gte' => date('Y-01-01')]];
        }
        // "today" / "aujourd'hui"
        elseif (preg_match('/\b(today|aujourd\'?hui)\b/i', $queryLower)) {
            $dateCondition = [$dateField => ['$gte' => date('Y-m-d')]];
        }
        // "this week" / "cette semaine"
        elseif (preg_match('/\b(this week|cette semaine)\b/i', $queryLower)) {
            $dateCondition = [$dateField => ['$gte' => date('Y-m-d', strtotime('monday this week'))]];
        }
        // "last N days" / "derniers N jours"
        elseif (preg_match('/\b(?:last|derniers?)\s+(\d+)\s+(?:days|jours)\b/i', $queryLower, $matches)) {
            $days = intval($matches[1]);
            $dateCondition = [$dateField => ['$gte' => date('Y-m-d', strtotime("-{$days} days"))]];
        }
        // "last month" / "mois dernier"
        elseif (preg_match('/\b(last month|mois dernier)\b/i', $queryLower)) {
            $dateCondition = [
                '$and' => [
                    [$dateField => ['$gte' => date('Y-m-01', strtotime('first day of last month'))]],
                    [$dateField => ['$lt' => date('Y-m-01')]],
                ],
            ];
        }

        if (!$dateCondition) {
            return $filter;
        }

        // Merge: wrap existing filter + date condition in $and
        if (empty($filter)) {
            return $dateCondition;
        }

        // If filter already has $and at root, append to it
        if (isset($filter['$and']) && is_array($filter['$and'])) {
            if (isset($dateCondition['$and'])) {
                $filter['$and'] = array_merge($filter['$and'], $dateCondition['$and']);
            } else {
                $filter['$and'][] = $dateCondition;
            }
            return $filter;
        }

        // Otherwise wrap both in $and
        if (isset($dateCondition['$and'])) {
            return ['$and' => array_merge([$filter], $dateCondition['$and'])];
        }
        return ['$and' => [$filter, $dateCondition]];
    }

    /**
     * Check if a MongoDB filter already contains a specific field (recursively)
     *
     * @param array $filter
     * @param string $field
     *
     * @return bool
     */
    protected function filterContainsField(array $filter, string $field): bool
    {
        foreach ($filter as $key => $value) {
            if ($key === $field) {
                return true;
            }
            if (is_array($value)) {
                if (in_array($key, ['$and', '$or'])) {
                    foreach ($value as $sub) {
                        if (is_array($sub) && $this->filterContainsField($sub, $field)) {
                            return true;
                        }
                    }
                } elseif ($this->filterContainsField($value, $field)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Apply default filters from model getLlmConfig() unless user explicitly asks otherwise
     *
     * Reads default_filters from each model's getLlmConfig() via LlmConfiguration.
     * For example, Donation defines don_status=OK unless user says "annulé", "tous les statuts", etc.
     *
     * @param string $query Original natural language query
     * @param array $filter MongoDB-style filter from LLM
     * @param string|null $resource Identified resource
     * @param \FreeAsso\Service\LlmConfiguration|null $llmConfig
     *
     * @return array Enriched filter
     */
    protected function enrichFilterWithDonationStatus(string $query, array $filter, ?string $resource, \FreeAsso\Service\LlmConfiguration $llmConfig = null): array
    {
        if (!$llmConfig || !$resource) {
            return $filter;
        }

        $rules = $llmConfig->getDefaultFilterRules();
        $queryLower = mb_strtolower($query);

        foreach ($rules as $rule) {
            // Only apply rules matching this resource
            if ($rule['resource'] !== $resource) {
                continue;
            }

            $field = $rule['field'];
            $value = $rule['value'];

            // Skip if filter already has this field
            if ($this->filterContainsField($filter, $field)) {
                continue;
            }

            // Skip if user explicitly asks for excluded values
            $excluded = false;
            foreach ($rule['exclude_keywords'] as $kw) {
                if (mb_strpos($queryLower, $kw) !== false) {
                    $excluded = true;
                    break;
                }
            }
            if ($excluded) {
                continue;
            }

            // Add default filter
            $condition = [$field => ['$eq' => $value]];
            if (empty($filter)) {
                $filter = $condition;
            } elseif (isset($filter['$and'])) {
                $filter['$and'][] = $condition;
            } else {
                $filter = ['$and' => [$filter, $condition]];
            }
        }

        return $filter;
    }

    /**
     * Save a successful query to LLM memory for future few-shot learning
     *
     * Avoids duplicates by checking if the same query already exists.
     * If it does, increments the use_count instead.
     *
     * @param string $query Original natural language query
     * @param string|null $resource Identified resource
     * @param array $filter MongoDB-style filter
     * @param array $sort MongoDB-style sort
     * @param int $limit Result limit
     */
    protected function saveToMemory(
        string $query,
        ?string $resource,
        array $filter,
        array $sort,
        int $limit
    ): void {
        try {
            if (empty($resource)) {
                return;
            }
            $memory = \FreeFW\DI\DI::get('FreeFW::Model::LlmMemory');
            if (!$memory) {
                return;
            }
            // Check if this exact query already exists
            $existing = $memory::find([
                'llmm_query' => $query,
                'llmm_activ' => 1,
            ]);
            if ($existing && $existing->count() > 0) {
                // Increment use count on first match
                foreach ($existing as $record) {
                    $record
                        ->setLlmmUseCount(($record->getLlmmUseCount() ?? 0) + 1)
                        ->save();
                    break;
                }
                return;
            }
            // Create new memory
            $newMemory = new \FreeFW\Model\LlmMemory();
            $newMemory
                ->setLlmmQuery($query)
                ->setLlmmResource($resource)
                ->setLlmmFilterJson(!empty($filter) ? json_encode($filter, JSON_UNESCAPED_UNICODE) : null)
                ->setLlmmSortJson(!empty($sort) ? json_encode($sort, JSON_UNESCAPED_UNICODE) : null)
                ->setLlmmLimit($limit)
                ->setLlmmUseCount(1)
                ->setLlmmActiv(true)
            ;
            $newMemory->create();
        } catch (\Throwable $e) {
            $this->logger->debug('Llm.saveToMemory: ' . $e->getMessage());
        }
    }

}
