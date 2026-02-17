<?php

namespace FreeAsso\Service;

use \FreeFW\Constants as FFCST;

/**
 * LLM Configuration Service
 *
 * Centralizes all LLM-related rules by reading from each model's getLlmConfig():
 * - Resource definitions (models queryable by LLM)
 * - Few-shot examples (aggregated from models, date placeholders resolved)
 * - Post-processor rules (date fields, default filters)
 * - Synonyms (user terms → filter values)
 * - FK field discovery (auto-reads StorageModel for dot-notation paths)
 *
 * @author jeromeklam
 */
class LlmConfiguration extends \FreeFW\Core\Service
{

    /**
     * Model class map: resource name => [title, class]
     *
     * This is the only hardcoded part. Keywords, description, etc. come from getLlmConfig().
     *
     * @var array
     */
    protected static $MODEL_MAP = [
        'FreeAsso_Donation' => [
            'title' => 'Dons',
            'class' => 'FreeAsso::Model::Donation',
        ],
        'FreeAsso_Client' => [
            'title' => 'Personnes / Donateurs',
            'class' => 'FreeAsso::Model::Client',
        ],
        'FreeAsso_Cause' => [
            'title' => 'Causes',
            'class' => 'FreeAsso::Model::Cause',
        ],
        'FreeAsso_Sponsorship' => [
            'title' => 'Parrainages',
            'class' => 'FreeAsso::Model::Sponsorship',
        ],
        'FreeAsso_Receipt' => [
            'title' => 'Reçus',
            'class' => 'FreeAsso::Model::Receipt',
        ],
        'FreeAsso_Certificate' => [
            'title' => 'Certificats',
            'class' => 'FreeAsso::Model::Certificate',
        ],
        'FreeAsso_Session' => [
            'title' => 'Sessions',
            'class' => 'FreeAsso::Model::Session',
        ],
        'FreeAsso_Site' => [
            'title' => 'Sites',
            'class' => 'FreeAsso::Model::Site',
        ],
        'FreeAsso_CauseType' => [
            'title' => 'Types de cause',
            'class' => 'FreeAsso::Model::CauseType',
        ],
        'FreeAsso_PaymentType' => [
            'title' => 'Types de paiement',
            'class' => 'FreeAsso::Model::PaymentType',
        ],
    ];

    /**
     * Cached LLM configs per resource (loaded once from models)
     * @var array|null
     */
    protected $llmConfigsCache = null;

    /**
     * Load getLlmConfig() from all models (cached)
     *
     * @return array resource => llmConfig array
     */
    protected function loadAllLlmConfigs(): array
    {
        if ($this->llmConfigsCache !== null) {
            return $this->llmConfigsCache;
        }
        $this->llmConfigsCache = [];
        foreach (self::$MODEL_MAP as $resourceName => $def) {
            try {
                $model = \FreeFW\DI\DI::get($def['class']);
                if ($model && method_exists($model, 'getLlmConfig')) {
                    $this->llmConfigsCache[$resourceName] = $model::getLlmConfig();
                } else {
                    $this->llmConfigsCache[$resourceName] = [];
                }
            } catch (\Throwable $e) {
                $this->llmConfigsCache[$resourceName] = [];
            }
        }
        return $this->llmConfigsCache;
    }

    /**
     * Get resource definitions for LLM queries
     *
     * Reads description/keywords from each model's getLlmConfig().
     *
     * @return array Map of resource name => [title, description, class, keywords]
     */
    public function getResourceDefinitions(): array
    {
        $configs = $this->loadAllLlmConfigs();
        $result = [];
        foreach (self::$MODEL_MAP as $resourceName => $def) {
            $llmCfg = $configs[$resourceName] ?? [];
            $result[$resourceName] = [
                'title'       => $def['title'],
                'description' => $llmCfg['description'] ?? $def['title'],
                'class'       => $def['class'],
                'keywords'    => $llmCfg['keywords'] ?? [],
            ];
        }
        return $result;
    }

    /**
     * Get few-shot examples aggregated from all models
     *
     * Reads 'examples' from each model's getLlmConfig() and resolves date placeholders:
     * - %%MONTH_START%% → current month start (Y-m-01)
     * - %%YEAR_START%% → current year start (Y-01-01)
     *
     * @return array Array of ['query' => ..., 'response' => ['resource' => ..., 'filter' => ..., ...]]
     */
    public function getFewShotExamples(): array
    {
        $configs = $this->loadAllLlmConfigs();
        $examples = [];
        $monthStart = date('Y-m-01');
        $yearStart = date('Y-01-01');
        foreach ($configs as $resourceName => $llmCfg) {
            if (empty($llmCfg['examples'])) {
                continue;
            }
            foreach ($llmCfg['examples'] as $ex) {
                $response = [
                    'resource' => $resourceName,
                    'filter'   => $ex['filter'] ?? [],
                    'sort'     => $ex['sort'] ?? [],
                    'limit'    => $ex['limit'] ?? 50,
                ];
                if (isset($ex['include'])) {
                    $response['include'] = $ex['include'];
                }
                // Resolve date placeholders in the response
                $response = $this->resolveDatePlaceholders($response, $monthStart, $yearStart);
                $examples[] = [
                    'query'    => $ex['query'],
                    'response' => $response,
                ];
            }
        }
        return $examples;
    }

    /**
     * Recursively resolve date placeholders in an array
     *
     * @param mixed $data
     * @param string $monthStart
     * @param string $yearStart
     *
     * @return mixed
     */
    protected function resolveDatePlaceholders($data, string $monthStart, string $yearStart)
    {
        if (is_string($data)) {
            $data = str_replace('%%MONTH_START%%', $monthStart, $data);
            $data = str_replace('%%YEAR_START%%', $yearStart, $data);
            return $data;
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->resolveDatePlaceholders($value, $monthStart, $yearStart);
            }
        }
        return $data;
    }

    /**
     * Get date field map for post-processor
     *
     * Reads 'date_field' from each model's getLlmConfig().
     *
     * @return array resource => date field name
     */
    public function getDateFieldMap(): array
    {
        $configs = $this->loadAllLlmConfigs();
        $map = [];
        foreach ($configs as $resourceName => $llmCfg) {
            if (!empty($llmCfg['date_field'])) {
                $map[$resourceName] = $llmCfg['date_field'];
            }
        }
        return $map;
    }

    /**
     * Get default filter rules for post-processor
     *
     * Reads 'default_filters' from each model's getLlmConfig().
     * Returns a generalized structure that can apply to any resource.
     *
     * @return array Array of ['resource' => resourceName, 'field' => ..., 'value' => ..., 'exclude_keywords' => [...]]
     */
    public function getDefaultFilterRules(): array
    {
        $configs = $this->loadAllLlmConfigs();
        $rules = [];
        foreach ($configs as $resourceName => $llmCfg) {
            if (empty($llmCfg['default_filters'])) {
                continue;
            }
            foreach ($llmCfg['default_filters'] as $field => $fieldRules) {
                $rules[] = [
                    'resource'         => $resourceName,
                    'field'            => $field,
                    'value'            => $fieldRules['value'] ?? null,
                    'exclude_keywords' => $fieldRules['exclude_keywords'] ?? [],
                ];
            }
        }
        return $rules;
    }

    /**
     * Get synonyms for a specific resource
     *
     * Reads 'synonyms' from the model's getLlmConfig().
     * Returns: ['en nature' => ['field' => 'payment_type.ptyp_type', 'op' => '$eq', 'value' => 'NATURE'], ...]
     *
     * @param string $resource Resource name (e.g., 'FreeAsso_Donation')
     *
     * @return array
     */
    public function getSynonymsForResource(string $resource): array
    {
        $configs = $this->loadAllLlmConfigs();
        return $configs[$resource]['synonyms'] ?? [];
    }

    /**
     * Discover FK fields from a StorageModel and return them with dot-notation paths
     *
     * Reads PROPERTY_FK definitions from the model's properties, then loads the related
     * model's filterable fields, returning them as fk_alias.field_name.
     *
     * @param string $resourceClass Model class in DI format (e.g., 'FreeAsso::Model::Donation')
     *
     * @return array ['payment_type.ptyp_type' => ['type'=>'select', 'description'=>'...', ...], ...]
     */
    public function getFkFields(string $resourceClass): array
    {
        $fkFields = [];

        try {
            $model = \FreeFW\DI\DI::get($resourceClass);
            if (!$model) {
                return [];
            }

            $properties = $model->getModelDescriptionProperties();

            foreach ($properties as $propName => $propDef) {
                $options = $propDef[FFCST::PROPERTY_OPTIONS] ?? [];
                if (!isset($propDef[FFCST::PROPERTY_FK])) {
                    continue;
                }
                if (!in_array(FFCST::OPTION_FK, $options)) {
                    continue;
                }

                foreach ($propDef[FFCST::PROPERTY_FK] as $fkAlias => $fkDef) {
                    $relModelClass = $fkDef[FFCST::FOREIGN_MODEL] ?? $fkDef['model'] ?? null;
                    if (!$relModelClass) {
                        continue;
                    }

                    // Skip system FKs (group, broker, SSO)
                    if (strpos($relModelClass, 'FreeSSO::') === 0 || strpos($relModelClass, 'FreeFW::') === 0) {
                        continue;
                    }

                    try {
                        $relModel = \FreeFW\DI\DI::get($relModelClass);
                        if (!$relModel) {
                            continue;
                        }

                        $relProperties = $relModel->getModelDescriptionProperties();
                        foreach ($relProperties as $relFieldName => $relFieldDef) {
                            $relOptions = $relFieldDef[FFCST::PROPERTY_OPTIONS] ?? [];

                            // Skip PK, FK, broker, group, local, function fields
                            if (in_array(FFCST::OPTION_PK, $relOptions) ||
                                in_array(FFCST::OPTION_FK, $relOptions) ||
                                in_array(FFCST::OPTION_BROKER, $relOptions) ||
                                in_array(FFCST::OPTION_GROUP, $relOptions) ||
                                in_array(FFCST::OPTION_LOCAL, $relOptions) ||
                                in_array(FFCST::OPTION_FUNCTION, $relOptions)) {
                                continue;
                            }

                            $relType = $relFieldDef[FFCST::PROPERTY_TYPE] ?? FFCST::TYPE_STRING;

                            // Skip blob/text (not useful for filtering)
                            if ($relType === FFCST::TYPE_BLOB || $relType === FFCST::TYPE_TEXT) {
                                continue;
                            }

                            $dotPath = $fkAlias . '.' . $relFieldName;
                            $fieldInfo = [
                                'type' => $relType,
                                'description' => $relFieldDef[FFCST::PROPERTY_COMMENT] ?? $relFieldDef[FFCST::PROPERTY_TITLE] ?? '',
                                'filterable' => true,
                            ];

                            if (isset($relFieldDef[FFCST::PROPERTY_LLM_DESC])) {
                                $fieldInfo['llm_description'] = $relFieldDef[FFCST::PROPERTY_LLM_DESC];
                            }
                            if (isset($relFieldDef[FFCST::PROPERTY_ENUM])) {
                                $fieldInfo['enum_values'] = $relFieldDef[FFCST::PROPERTY_ENUM];
                            }

                            $fkFields[$dotPath] = $fieldInfo;
                        }
                    } catch (\Throwable $e) {
                        // Related model not loadable, skip
                        continue;
                    }
                }
            }
        } catch (\Throwable $e) {
            // Model not loadable, return empty
        }

        return $fkFields;
    }

    /**
     * Enrich metadata with FK fields using dot-notation
     *
     * Adds FK-related filterable fields to the metadata 'fields' array.
     *
     * @param array $metadata Existing metadata with 'fields' key
     * @param string $resourceClass Model class in DI format
     *
     * @return array Enriched metadata
     */
    public function enrichMetadataWithFkFields(array $metadata, string $resourceClass): array
    {
        $fkFields = $this->getFkFields($resourceClass);
        if (!empty($fkFields)) {
            $metadata['fields'] = array_merge($metadata['fields'] ?? [], $fkFields);
        }
        return $metadata;
    }
}
