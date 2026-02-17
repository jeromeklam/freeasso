<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * LlmQuery - Fake model for LLM natural language query input/output
 *
 * @author jeromeklam
 */
abstract class LlmQuery extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_LLMQ_QUERY = [
        FFCST::PROPERTY_PRIVATE => 'llmq_query',
        FFCST::PROPERTY_PUBLIC  => 'query',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Natural language query from the user',
        FFCST::PROPERTY_SAMPLE  => 'donations over 100 euros this month',
    ];
    protected static $PRP_LLMQ_RESOURCE = [
        FFCST::PROPERTY_PRIVATE => 'llmq_resource',
        FFCST::PROPERTY_PUBLIC  => 'resource',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Identified resource name (e.g. FreeAsso_Donation)',
        FFCST::PROPERTY_SAMPLE  => 'FreeAsso_Donation',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_LLMQ_FILTER = [
        FFCST::PROPERTY_PRIVATE => 'llmq_filter',
        FFCST::PROPERTY_PUBLIC  => 'filter',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'MongoDB-style filter object',
        FFCST::PROPERTY_SAMPLE  => '{"don_mnt":{"$gt":100}}',
    ];
    protected static $PRP_LLMQ_SORT = [
        FFCST::PROPERTY_PRIVATE => 'llmq_sort',
        FFCST::PROPERTY_PUBLIC  => 'sort',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Sort object (1=ASC, -1=DESC)',
        FFCST::PROPERTY_SAMPLE  => '{"don_ts":-1}',
    ];
    protected static $PRP_LLMQ_LIMIT = [
        FFCST::PROPERTY_PRIVATE => 'llmq_limit',
        FFCST::PROPERTY_PUBLIC  => 'limit',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Maximum number of results',
        FFCST::PROPERTY_SAMPLE  => 50,
        FFCST::PROPERTY_DEFAULT => 50,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'llmq_query'    => self::$PRP_LLMQ_QUERY,
            'llmq_resource' => self::$PRP_LLMQ_RESOURCE,
            'llmq_filter'   => self::$PRP_LLMQ_FILTER,
            'llmq_sort'     => self::$PRP_LLMQ_SORT,
            'llmq_limit'    => self::$PRP_LLMQ_LIMIT,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'dummy_llm_query';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Fake model for LLM natural language query input/output';
    }
}
