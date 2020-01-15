<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Client
 *
 * @author jeromeklam
 */
abstract class Client extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CLIC_ID = [
        FFCST::PROPERTY_PRIVATE => 'clic_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['client_category' =>
            [
                'model' => 'FreeAsso::Model::ClientCategory',
                'field' => 'clic_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLIT_ID = [
        FFCST::PROPERTY_PRIVATE => 'clit_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['client_type' =>
            [
                'model' => 'FreeAsso::Model::ClientType',
                'field' => 'clit_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_GENDER = [
        FFCST::PROPERTY_PRIVATE => 'cli_gender',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_FIRSTNAME = [
        FFCST::PROPERTY_PRIVATE => 'cli_firstname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_LASTNAME = [
        FFCST::PROPERTY_PRIVATE => 'cli_lastname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_CP = [
        FFCST::PROPERTY_PRIVATE => 'cli_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'cli_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CNTY_ID = [
        FFCST::PROPERTY_PRIVATE => 'cnty_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['country' =>
            [
                'model' => 'FreeFW::Model::Country',
                'field' => 'cnty_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_ACTIVE = [
        FFCST::PROPERTY_PRIVATE => 'cli_active',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['lang' =>
            [
                'model' => 'FreeFW::Model::Lang',
                'field' => 'lang_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_PREFS = [
        FFCST::PROPERTY_PRIVATE => 'cli_prefs',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_AVATAR = [
        FFCST::PROPERTY_PRIVATE => 'cli_avatar',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_PHONE_HOME = [
        FFCST::PROPERTY_PRIVATE => 'cli_phone_home',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_PHONE_GSM = [
        FFCST::PROPERTY_PRIVATE => 'cli_phone_gsm',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_DESC = [
        FFCST::PROPERTY_PRIVATE => 'cli_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'cli_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_EMAIL_OLD = [
        FFCST::PROPERTY_PRIVATE => 'cli_email_old',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'cli_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_CERTIFICAT = [
        FFCST::PROPERTY_PRIVATE => 'cli_certificat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_EXTERN_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_extern_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_SPONSOR_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_sponsor_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['sponsor' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_string_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'cli_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'cli_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'cli_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'cli_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'cli_bool_4',
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
            'cli_id'         => self::$PRP_CLI_ID,
            'brk_id'         => self::$PRP_BRK_ID,
            'clic_id'        => self::$PRP_CLIC_ID,
            'clit_id'        => self::$PRP_CLIT_ID,
            'cli_gender'     => self::$PRP_CLI_GENDER,
            'cli_firstname'  => self::$PRP_CLI_FIRSTNAME,
            'cli_lastname'   => self::$PRP_CLI_LASTNAME,
            'cli_address1'   => self::$PRP_CLI_ADDRESS1,
            'cli_address2'   => self::$PRP_CLI_ADDRESS2,
            'cli_address3'   => self::$PRP_CLI_ADDRESS3,
            'cli_cp'         => self::$PRP_CLI_CP,
            'cli_town'       => self::$PRP_CLI_TOWN,
            'cnty_id'        => self::$PRP_CNTY_ID,
            'cli_active'     => self::$PRP_CLI_ACTIVE,
            'lang_id'        => self::$PRP_LANG_ID,
            'cli_prefs'      => self::$PRP_CLI_PREFS,
            'cli_avatar'     => self::$PRP_CLI_AVATAR,
            'cli_phone_home' => self::$PRP_CLI_PHONE_HOME,
            'cli_phone_gsm'  => self::$PRP_CLI_PHONE_GSM,
            'cli_desc'       => self::$PRP_CLI_DESC,
            'cli_email'      => self::$PRP_CLI_EMAIL,
            'cli_email_old'  => self::$PRP_CLI_EMAIL_OLD,
            'cli_receipt'    => self::$PRP_CLI_RECEIPT,
            'cli_certificat' => self::$PRP_CLI_CERTIFICAT,
            'cli_extern_id'  => self::$PRP_CLI_EXTERN_ID,
            'cli_sponsor_id' => self::$PRP_CLI_SPONSOR_ID,
            'cli_string_1'   => self::$PRP_CLI_STRING_1,
            'cli_string_2'   => self::$PRP_CLI_STRING_2,
            'cli_string_3'   => self::$PRP_CLI_STRING_3,
            'cli_string_4'   => self::$PRP_CLI_STRING_4,
            'cli_number_1'   => self::$PRP_CLI_NUMBER_1,
            'cli_number_2'   => self::$PRP_CLI_NUMBER_2,
            'cli_number_3'   => self::$PRP_CLI_NUMBER_3,
            'cli_number_4'   => self::$PRP_CLI_NUMBER_4,
            'cli_date_1'     => self::$PRP_CLI_DATE_1,
            'cli_date_2'     => self::$PRP_CLI_DATE_2,
            'cli_date_3'     => self::$PRP_CLI_DATE_3,
            'cli_date_4'     => self::$PRP_CLI_DATE_4,
            'cli_text_1'     => self::$PRP_CLI_TEXT_1,
            'cli_text_2'     => self::$PRP_CLI_TEXT_2,
            'cli_text_3'     => self::$PRP_CLI_TEXT_3,
            'cli_text_4'     => self::$PRP_CLI_TEXT_4,
            'cli_bool_1'     => self::$PRP_CLI_BOOL_1,
            'cli_bool_2'     => self::$PRP_CLI_BOOL_2,
            'cli_bool_3'     => self::$PRP_CLI_BOOL_3,
            'cli_bool_4'     => self::$PRP_CLI_BOOL_4
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'crm_client';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return 'cli_lastname';
    }
}
