<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ClientCategory
 *
 * @author jeromeklam
 */
abstract class ClientCategory extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CLIC_ID = [
        FFCST::PROPERTY_PRIVATE => 'clic_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CLIC_CODE = [
        FFCST::PROPERTY_PRIVATE => 'clic_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIC_NAME = [
        FFCST::PROPERTY_PRIVATE => 'clic_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Catégorie',
    ];
    protected static $PRP_CLIC_FIELDS = [
        FFCST::PROPERTY_PRIVATE => 'clic_fields',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Champs supplémentaires',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'clic_id'     => self::$PRP_CLIC_ID,
            'brk_id'      => self::$PRP_BRK_ID,
            'clic_code'   => self::$PRP_CLIC_CODE,
            'clic_name'   => self::$PRP_CLIC_NAME,
            'clic_fields' => self::$PRP_CLIC_FIELDS,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'crm_client_category';
    }

    /**
     * Composed index
     *
     * @return string[][]|number[][]
     */
    public static function getUniqIndexes()
    {
        return [
            'name' => [
                FFCST::INDEX_FIELDS => ['brk_id', 'clic_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_CLIENT_CATEGORY_NAME_EXISTS
            ],
        ];
    }
}
