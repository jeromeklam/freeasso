<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Site
 *
 * @author jeromeklam
 */
abstract class Site extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_SITT_ID = [
        FFCST::PROPERTY_PRIVATE => 'sitt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['site_type' =>
            [
                'model' => 'FreeAsso::Model::SiteType',
                'field' => 'sitt_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITE_NAME = [
        FFCST::PROPERTY_PRIVATE => 'site_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITE_CODE = [
        FFCST::PROPERTY_PRIVATE => 'site_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'site_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'site_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'site_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_CP = [
        FFCST::PROPERTY_PRIVATE => 'site_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'site_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_OWNER_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'owner_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['owner' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SANIT_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'sanit_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['sanitary' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_PARENT_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'parent_site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['parent_site_id' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITE_AREA = [
        FFCST::PROPERTY_PRIVATE => 'site_area',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_POSITION = [
        FFCST::PROPERTY_PRIVATE => 'site_position',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_PLOTS = [
        FFCST::PROPERTY_PRIVATE => 'site_plots',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_LEFT = [
        FFCST::PROPERTY_PRIVATE => 'site_left',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_RIGHT = [
        FFCST::PROPERTY_PRIVATE => 'site_right',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_LEVEL = [
        FFCST::PROPERTY_PRIVATE => 'site_level',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_COORD = [
        FFCST::PROPERTY_PRIVATE => 'site_coord',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_CODE_EX = [
        FFCST::PROPERTY_PRIVATE => 'site_code_ex',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DESC = [
        FFCST::PROPERTY_PRIVATE => 'site_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT_HTML,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_STRING_5 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_STRING_6 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_5 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_6 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_6',
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
            'site_id'        => self::$PRP_SITE_ID,
            'brk_id'         => self::$PRP_BRK_ID,
            'sitt_id'        => self::$PRP_SITT_ID,
            'site_name'      => self::$PRP_SITE_NAME,
            'site_code'      => self::$PRP_SITE_CODE,
            'site_address1'  => self::$PRP_SITE_ADDRESS1,
            'site_address2'  => self::$PRP_SITE_ADDRESS2,
            'site_address3'  => self::$PRP_SITE_ADDRESS3,
            'site_cp'        => self::$PRP_SITE_CP,
            'site_town'      => self::$PRP_SITE_TOWN,
            'owner_cli_id'   => self::$PRP_OWNER_CLI_ID,
            'sanit_cli_id'   => self::$PRP_SANIT_CLI_ID,
            'parent_site_id' => self::$PRP_PARENT_SITE_ID,
            'site_area'      => self::$PRP_SITE_AREA,
            'site_position'  => self::$PRP_SITE_POSITION,
            'site_plots'     => self::$PRP_SITE_PLOTS,
            'site_left'      => self::$PRP_SITE_LEFT,
            'site_right'     => self::$PRP_SITE_RIGHT,
            'site_level'     => self::$PRP_SITE_LEVEL,
            'site_string_1'  => self::$PRP_SITE_STRING_1,
            'site_string_2'  => self::$PRP_SITE_STRING_2,
            'site_string_3'  => self::$PRP_SITE_STRING_3,
            'site_string_4'  => self::$PRP_SITE_STRING_4,
            'site_number_1'  => self::$PRP_SITE_NUMBER_1,
            'site_number_2'  => self::$PRP_SITE_NUMBER_2,
            'site_number_3'  => self::$PRP_SITE_NUMBER_3,
            'site_number_4'  => self::$PRP_SITE_NUMBER_4,
            'site_date_1'    => self::$PRP_SITE_DATE_1,
            'site_date_2'    => self::$PRP_SITE_DATE_2,
            'site_date_3'    => self::$PRP_SITE_DATE_3,
            'site_date_4'    => self::$PRP_SITE_DATE_4,
            'site_text_1'    => self::$PRP_SITE_TEXT_1,
            'site_text_2'    => self::$PRP_SITE_TEXT_2,
            'site_text_3'    => self::$PRP_SITE_TEXT_3,
            'site_text_4'    => self::$PRP_SITE_TEXT_4,
            'site_bool_1'    => self::$PRP_SITE_BOOL_1,
            'site_bool_2'    => self::$PRP_SITE_BOOL_2,
            'site_bool_3'    => self::$PRP_SITE_BOOL_3,
            'site_bool_4'    => self::$PRP_SITE_BOOL_4,
            'site_coord'     => self::$PRP_SITE_COORD,
            'site_code_ex'   => self::$PRP_SITE_CODE_EX,
            'site_desc'      => self::$PRP_SITE_DESC,
            'site_string_5'  => self::$PRP_SITE_STRING_5,
            'site_string_6'  => self::$PRP_SITE_STRING_6,
            'site_number_5'  => self::$PRP_SITE_NUMBER_5,
            'site_number_6'  => self::$PRP_SITE_NUMBER_6,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_site';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return 'site_name';
    }
}
