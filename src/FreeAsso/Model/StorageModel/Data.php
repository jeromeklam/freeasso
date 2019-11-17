<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Data
 *
 * @author jeromeklam
 */
abstract class Data extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_DATA_ID = [
        FFCST::PROPERTY_PRIVATE => 'data_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DATA_NAME = [
        FFCST::PROPERTY_PRIVATE => 'data_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DATA_CODE = [
        FFCST::PROPERTY_PRIVATE => 'data_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DATA_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'data_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DATA_FROM = [
        FFCST::PROPERTY_PRIVATE => 'data_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DATA_TO = [
        FFCST::PROPERTY_PRIVATE => 'data_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DATA_CONTENT = [
        FFCST::PROPERTY_PRIVATE => 'data_content',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'data_id'      => self::$PRP_DATA_ID,
            'brk_id'       => self::$PRP_BRK_ID,
            'data_name'    => self::$PRP_DATA_NAME,
            'data_code'    => self::$PRP_DATA_CODE,
            'data_type'    => self::$PRP_DATA_TYPE,
            'data_from'    => self::$PRP_DATA_FROM,
            'data_to'      => self::$PRP_DATA_TO,
            'data_content' => self::$PRP_DATA_CONTENT
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_data';
    }
}
