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
            // Get Ollama config
            $config = $this->getAppConfig();
            $ollamaUrl = $config->get('llm:ollama_url', 'http://localhost:11434');
            $ollamaModel = $config->get('llm:ollama_model', 'llama3.1:8b');

            // Create Ollama provider
            $ollamaTimeout = intval($config->get('llm:ollama_timeout', 300));
            $provider = new \FreeFW\Service\Llm\Providers\OllamaProvider($ollamaUrl, $ollamaModel);
            $provider->setTimeout($ollamaTimeout);
            if (!$provider->isAvailable()) {
                return $this->createErrorResponse(
                    FFCST::ERROR_IN_DATA,
                    'LLM provider (Ollama) is not available'
                );
            }

            // Create QueryParser
            $parser = new \FreeFW\Service\Llm\QueryParser($provider, $config, $this->logger);

            // Build FreeAsso-specific model metadata
            $modelMetadataMap = $this->buildFreeAssoMetadataMap();
            $parser->setAvailableResources($modelMetadataMap);

            // Inject few-shot examples for better accuracy
            $parser->setExamples($this->getFewShotExamples());

            // Parse natural language to MongoDB-style query
            $result = $parser->parseNaturalLanguage($query, $modelMetadataMap);

            // Post-process: enrich filter with date context the LLM may have missed
            $result['filter'] = $this->enrichFilterWithDateContext($query, $result['filter'] ?? [], $result['resource'] ?? null);

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
     *
     * @return array
     */
    protected function buildFreeAssoMetadataMap(): array
    {
        $modelDefs = [
            'FreeAsso_Donation' => [
                'title' => 'Dons',
                'description' => 'Dons / donations (montants, transactions). Use for: "dons", "donations", "versements", "gifts". NOT for people/donateurs.',
                'class' => 'FreeAsso::Model::Donation',
            ],
            'FreeAsso_Client' => [
                'title' => 'Personnes / Donateurs',
                'description' => 'Personnes, donateurs, parrains, contacts (people). Use for: "donateurs", "donneur", "donors", "parrains", "sponsors", "clients", "personnes", "membres", "contacts".',
                'class' => 'FreeAsso::Model::Client',
            ],
            'FreeAsso_Cause' => [
                'title' => 'Causes',
                'description' => 'Animals, forest areas, or other causes that can be sponsored',
                'class' => 'FreeAsso::Model::Cause',
            ],
            'FreeAsso_Sponsorship' => [
                'title' => 'Parrainages',
                'description' => 'Recurring sponsorship contracts between a client and a cause',
                'class' => 'FreeAsso::Model::Sponsorship',
            ],
            'FreeAsso_Receipt' => [
                'title' => 'Reçus',
                'description' => 'Tax receipts issued to donors',
                'class' => 'FreeAsso::Model::Receipt',
            ],
            'FreeAsso_Certificate' => [
                'title' => 'Certificats',
                'description' => 'Sponsorship certificates for donors',
                'class' => 'FreeAsso::Model::Certificate',
            ],
            'FreeAsso_Session' => [
                'title' => 'Sessions',
                'description' => 'Accounting sessions for grouping donations',
                'class' => 'FreeAsso::Model::Session',
            ],
            'FreeAsso_Site' => [
                'title' => 'Sites',
                'description' => 'Physical locations where causes are housed (regions, islands, sanctuaries)',
                'class' => 'FreeAsso::Model::Site',
            ],
            'FreeAsso_CauseType' => [
                'title' => 'Types de cause',
                'description' => 'Classification types for causes (e.g., Soutien, Parrainage)',
                'class' => 'FreeAsso::Model::CauseType',
            ],
            'FreeAsso_PaymentType' => [
                'title' => 'Types de paiement',
                'description' => 'Payment methods (bank transfer, check, PayPal, etc.)',
                'class' => 'FreeAsso::Model::PaymentType',
            ],
        ];

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
                    $result[$resourceName] = [
                        'title'       => $def['title'],
                        'description' => $def['description'],
                        'class'       => $def['class'],
                        'fields'      => $compactFields,
                    ];
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
     *
     * @return array Enriched filter
     */
    protected function enrichFilterWithDateContext(string $query, array $filter, ?string $resource): array
    {
        $queryLower = mb_strtolower($query);

        // Map resources to their main date field
        $dateFields = [
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

    /**
     * Get few-shot examples for the LLM prompt
     *
     * These examples train the LLM to produce correct field names,
     * proper JSON format, and accurate operator usage.
     *
     * @return array
     */
    protected function getFewShotExamples(): array
    {
        return [
            // Simple amount filter
            [
                'query' => 'dons de plus de 100 euros',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => ['don_mnt' => ['$gt' => 100]],
                    'sort' => ['don_real_ts' => -1],
                    'limit' => 50,
                ],
            ],
            // Date range (this month)
            [
                'query' => 'dons de ce mois',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => ['don_real_ts' => ['$gte' => date('Y-m-01')]],
                    'sort' => ['don_real_ts' => -1],
                    'limit' => 50,
                ],
            ],
            // Amount + date combined (this month)
            [
                'query' => 'dons de plus de 100 euros ce mois',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => [
                        '$and' => [
                            ['don_mnt' => ['$gt' => 100]],
                            ['don_real_ts' => ['$gte' => date('Y-m-01')]],
                        ],
                    ],
                    'sort' => ['don_real_ts' => -1],
                    'limit' => 50,
                ],
            ],
            // Amount + date combined (this year)
            [
                'query' => 'donations over 50 euros this year',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => [
                        '$and' => [
                            ['don_mnt' => ['$gt' => 50]],
                            ['don_real_ts' => ['$gte' => date('Y-01-01')]],
                        ],
                    ],
                    'sort' => ['don_real_ts' => -1],
                    'limit' => 50,
                ],
            ],
            // Combined conditions
            [
                'query' => 'dons validés de plus de 50 euros',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => [
                        '$and' => [
                            ['don_status' => ['$eq' => 'OK']],
                            ['don_mnt' => ['$gt' => 50]],
                        ],
                    ],
                    'sort' => ['don_mnt' => -1],
                    'limit' => 50,
                ],
            ],
            // Text search on person
            [
                'query' => 'personnes dont le nom contient Martin',
                'response' => [
                    'resource' => 'FreeAsso_Client',
                    'filter' => ['cli_lastname' => ['$contains' => 'Martin']],
                    'sort' => ['cli_lastname' => 1],
                    'limit' => 50,
                ],
            ],
            // Causes / animals
            [
                'query' => 'toutes les causes actives',
                'response' => [
                    'resource' => 'FreeAsso_Cause',
                    'filter' => ['cau_to' => ['$exists' => false]],
                    'sort' => ['cau_name' => 1],
                    'limit' => 50,
                ],
            ],
            // Sponsorships with amount
            [
                'query' => 'parrainages de plus de 20 euros par mois',
                'response' => [
                    'resource' => 'FreeAsso_Sponsorship',
                    'filter' => ['spo_mnt' => ['$gt' => 20]],
                    'sort' => ['spo_mnt' => -1],
                    'limit' => 50,
                ],
            ],
            // Top N with sort
            [
                'query' => 'les 10 plus gros dons',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => [],
                    'sort' => ['don_mnt' => -1],
                    'limit' => 10,
                ],
            ],
            // OR condition
            [
                'query' => 'personnes de Paris ou Lyon',
                'response' => [
                    'resource' => 'FreeAsso_Client',
                    'filter' => [
                        '$or' => [
                            ['cli_town' => ['$eq' => 'Paris']],
                            ['cli_town' => ['$eq' => 'Lyon']],
                        ],
                    ],
                    'sort' => ['cli_lastname' => 1],
                    'limit' => 50,
                ],
            ],
            // Receipts by year
            [
                'query' => 'reçus fiscaux de 2025',
                'response' => [
                    'resource' => 'FreeAsso_Receipt',
                    'filter' => ['rec_year' => ['$eq' => '2025']],
                    'sort' => ['rec_ts' => -1],
                    'limit' => 50,
                ],
            ],
            // Donations between amounts
            [
                'query' => 'dons entre 50 et 200 euros',
                'response' => [
                    'resource' => 'FreeAsso_Donation',
                    'filter' => [
                        '$and' => [
                            ['don_mnt' => ['$gte' => 50]],
                            ['don_mnt' => ['$lte' => 200]],
                        ],
                    ],
                    'sort' => ['don_mnt' => -1],
                    'limit' => 50,
                ],
            ],
        ];
    }
}
