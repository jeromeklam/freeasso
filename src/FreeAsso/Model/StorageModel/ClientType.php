<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ClientType
 *
 * @author jeromeklam
 */
abstract class ClientType extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CLIT_ID = [
        FFCST::PROPERTY_PRIVATE => 'clit_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CLIT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'clit_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CLIT_CODE = [
        FFCST::PROPERTY_PRIVATE => 'clit_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'clit_string_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'clit_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'clit_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'clit_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'clit_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'clit_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'clit_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'clit_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'clit_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'clit_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'clit_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'clit_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'clit_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'clit_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'clit_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'clit_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'clit_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'clit_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'clit_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLIT_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'clit_bool_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
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
            'clit_id'       => self::$PRP_CLIT_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'clit_name'     => self::$PRP_CLIT_NAME,
            'clit_code'     => self::$PRP_CLIT_CODE,
            'clit_string_1' => self::$PRP_CLIT_STRING_1,
            'clit_string_2' => self::$PRP_CLIT_STRING_2,
            'clit_string_3' => self::$PRP_CLIT_STRING_3,
            'clit_string_4' => self::$PRP_CLIT_STRING_4,
            'clit_number_1' => self::$PRP_CLIT_NUMBER_1,
            'clit_number_2' => self::$PRP_CLIT_NUMBER_2,
            'clit_number_3' => self::$PRP_CLIT_NUMBER_3,
            'clit_number_4' => self::$PRP_CLIT_NUMBER_4,
            'clit_date_1'   => self::$PRP_CLIT_DATE_1,
            'clit_date_2'   => self::$PRP_CLIT_DATE_2,
            'clit_date_3'   => self::$PRP_CLIT_DATE_3,
            'clit_date_4'   => self::$PRP_CLIT_DATE_4,
            'clit_text_1'   => self::$PRP_CLIT_TEXT_1,
            'clit_text_2'   => self::$PRP_CLIT_TEXT_2,
            'clit_text_3'   => self::$PRP_CLIT_TEXT_3,
            'clit_text_4'   => self::$PRP_CLIT_TEXT_4,
            'clit_bool_1'   => self::$PRP_CLIT_BOOL_1,
            'clit_bool_2'   => self::$PRP_CLIT_BOOL_2,
            'clit_bool_3'   => self::$PRP_CLIT_BOOL_3,
            'clit_bool_4'   => self::$PRP_CLIT_BOOL_4
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'crm_client_type';
    }
}
