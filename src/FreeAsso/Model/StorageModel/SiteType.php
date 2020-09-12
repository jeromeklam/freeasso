<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * SiteType
 *
 * @author jeromeklam
 */
abstract class SiteType extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SITT_ID = [
        FFCST::PROPERTY_PRIVATE => 'sitt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_SITT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'sitt_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_PATTERN = [
        FFCST::PROPERTY_PRIVATE => 'sitt_pattern',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITT_MASK = [
        FFCST::PROPERTY_PRIVATE => 'sitt_mask',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITT_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_5 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_6 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_7 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_7',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_STRING_8 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_string_8',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_NUMBER_5 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_number_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_NUMBER_6 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_number_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'sitt_bool_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITT_CODE = [
        FFCST::PROPERTY_PRIVATE => 'sitt_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
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
            'sitt_id'       => self::$PRP_SITT_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'sitt_name'     => self::$PRP_SITT_NAME,
            'sitt_pattern'  => self::$PRP_SITT_PATTERN,
            'sitt_mask'     => self::$PRP_SITT_MASK,
            'sitt_string_1' => self::$PRP_SITT_STRING_1,
            'sitt_string_2' => self::$PRP_SITT_STRING_2,
            'sitt_string_3' => self::$PRP_SITT_STRING_3,
            'sitt_string_4' => self::$PRP_SITT_STRING_4,
            'sitt_string_5' => self::$PRP_SITT_STRING_5,
            'sitt_string_6' => self::$PRP_SITT_STRING_6,
            'sitt_string_7' => self::$PRP_SITT_STRING_7,
            'sitt_string_8' => self::$PRP_SITT_STRING_8,
            'sitt_number_1' => self::$PRP_SITT_NUMBER_1,
            'sitt_number_2' => self::$PRP_SITT_NUMBER_2,
            'sitt_number_3' => self::$PRP_SITT_NUMBER_3,
            'sitt_number_4' => self::$PRP_SITT_NUMBER_4,
            'sitt_number_5' => self::$PRP_SITT_NUMBER_5,
            'sitt_number_6' => self::$PRP_SITT_NUMBER_6,
            'sitt_date_1'   => self::$PRP_SITT_DATE_1,
            'sitt_date_2'   => self::$PRP_SITT_DATE_2,
            'sitt_date_3'   => self::$PRP_SITT_DATE_3,
            'sitt_date_4'   => self::$PRP_SITT_DATE_4,
            'sitt_text_1'   => self::$PRP_SITT_TEXT_1,
            'sitt_text_2'   => self::$PRP_SITT_TEXT_2,
            'sitt_text_3'   => self::$PRP_SITT_TEXT_3,
            'sitt_text_4'   => self::$PRP_SITT_TEXT_4,
            'sitt_bool_1'   => self::$PRP_SITT_BOOL_1,
            'sitt_bool_2'   => self::$PRP_SITT_BOOL_2,
            'sitt_bool_3'   => self::$PRP_SITT_BOOL_3,
            'sitt_bool_4'   => self::$PRP_SITT_BOOL_4,
            'sitt_code'     => self::$PRP_SITT_CODE,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_site_type';
    }

    /**
     * Get uniq indexes
     *
     * @return array[]
     */
    public static function getUniqIndexes()
    {
        return [
            'name' => [
                FFCST::INDEX_FIELDS => 'sitt_name',
                FFCST::INDEX_EXISTS => \FreeFW\Constants::ERROR_UNIQINDEX,
            ]
        ];
    }
}
