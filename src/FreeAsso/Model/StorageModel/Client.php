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
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => 'MISTER',
        FFCST::PROPERTY_MAX     => 10,
    ];
    protected static $PRP_CLI_FIRSTNAME = [
        FFCST::PROPERTY_PRIVATE => 'cli_firstname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_LASTNAME = [
        FFCST::PROPERTY_PRIVATE => 'cli_lastname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'cli_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'cli_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_CP = [
        FFCST::PROPERTY_PRIVATE => 'cli_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 20,
    ];
    protected static $PRP_CLI_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'cli_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CNTY_ID = [
        FFCST::PROPERTY_PRIVATE => 'cnty_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_COUNTRY,
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
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_LANG,
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
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_PHONE_GSM = [
        FFCST::PROPERTY_PRIVATE => 'cli_phone_gsm',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CLI_DESC = [
        FFCST::PROPERTY_PRIVATE => 'cli_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'cli_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_CLI_EMAIL_2 = [
        FFCST::PROPERTY_PRIVATE => 'cli_email_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_CLI_EMAIL_REFUSED = [
        FFCST::PROPERTY_PRIVATE => 'cli_email_refused',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_CLI_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'cli_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_CERTIFICAT = [
        FFCST::PROPERTY_PRIVATE => 'cli_certificat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_EXTERN_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_extern_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_MAX     => 20,
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
    protected static $PRP_LAST_DON_ID = [
        FFCST::PROPERTY_PRIVATE => 'last_don_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['last_donation' =>
            [
                'model' => 'FreeAsso::Model::Donation',
                'field' => 'don_id',
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
    protected static $PRP_CLI_DISPLAY_SITE = [
        FFCST::PROPERTY_PRIVATE => 'cli_display_site',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_CLI_SEND_NEWS = [
        FFCST::PROPERTY_PRIVATE => 'cli_send_news',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_CLI_COORD = [
        FFCST::PROPERTY_PRIVATE => 'cli_coord',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_SIREN = [
        FFCST::PROPERTY_PRIVATE => 'cli_siren',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_SIRET = [
        FFCST::PROPERTY_PRIVATE => 'cli_siret',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PARENT_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'parent_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['parent_client' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::Client',
                FFCST::FOREIGN_FIELD => 'cli_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CLI_SANIT = [
        FFCST::PROPERTY_PRIVATE => 'cli_sanit',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Vétérinaire sanitaire',
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_FULLNAME = [
        FFCST::PROPERTY_PRIVATE => 'cli_fullname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'Nom complet',
        FFCST::PROPERTY_DEFAULT => '',
    ];
    protected static $PRP_CLI_SOCIAL_REASON = [
        FFCST::PROPERTY_PRIVATE => 'cli_social_reason',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Raison social',
        FFCST::PROPERTY_DEFAULT => '',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return  [
            'cli_id'            => self::$PRP_CLI_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'clic_id'           => self::$PRP_CLIC_ID,
            'clit_id'           => self::$PRP_CLIT_ID,
            'cli_gender'        => self::$PRP_CLI_GENDER,
            'cli_firstname'     => self::$PRP_CLI_FIRSTNAME,
            'cli_lastname'      => self::$PRP_CLI_LASTNAME,
            'cli_address1'      => self::$PRP_CLI_ADDRESS1,
            'cli_address2'      => self::$PRP_CLI_ADDRESS2,
            'cli_address3'      => self::$PRP_CLI_ADDRESS3,
            'cli_cp'            => self::$PRP_CLI_CP,
            'cli_town'          => self::$PRP_CLI_TOWN,
            'cnty_id'           => self::$PRP_CNTY_ID,
            'cli_active'        => self::$PRP_CLI_ACTIVE,
            'lang_id'           => self::$PRP_LANG_ID,
            'cli_prefs'         => self::$PRP_CLI_PREFS,
            'cli_avatar'        => self::$PRP_CLI_AVATAR,
            'cli_phone_home'    => self::$PRP_CLI_PHONE_HOME,
            'cli_phone_gsm'     => self::$PRP_CLI_PHONE_GSM,
            'cli_desc'          => self::$PRP_CLI_DESC,
            'cli_email'         => self::$PRP_CLI_EMAIL,
            'cli_email_2'       => self::$PRP_CLI_EMAIL_2,
            'cli_email_refused' => self::$PRP_CLI_EMAIL_REFUSED,
            'cli_receipt'       => self::$PRP_CLI_RECEIPT,
            'cli_certificat'    => self::$PRP_CLI_CERTIFICAT,
            'cli_extern_id'     => self::$PRP_CLI_EXTERN_ID,
            'cli_sponsor_id'    => self::$PRP_CLI_SPONSOR_ID,
            'last_don_id'       => self::$PRP_LAST_DON_ID,
            'cli_string_1'      => self::$PRP_CLI_STRING_1,
            'cli_string_2'      => self::$PRP_CLI_STRING_2,
            'cli_string_3'      => self::$PRP_CLI_STRING_3,
            'cli_string_4'      => self::$PRP_CLI_STRING_4,
            'cli_number_1'      => self::$PRP_CLI_NUMBER_1,
            'cli_number_2'      => self::$PRP_CLI_NUMBER_2,
            'cli_number_3'      => self::$PRP_CLI_NUMBER_3,
            'cli_number_4'      => self::$PRP_CLI_NUMBER_4,
            'cli_date_1'        => self::$PRP_CLI_DATE_1,
            'cli_date_2'        => self::$PRP_CLI_DATE_2,
            'cli_date_3'        => self::$PRP_CLI_DATE_3,
            'cli_date_4'        => self::$PRP_CLI_DATE_4,
            'cli_text_1'        => self::$PRP_CLI_TEXT_1,
            'cli_text_2'        => self::$PRP_CLI_TEXT_2,
            'cli_text_3'        => self::$PRP_CLI_TEXT_3,
            'cli_text_4'        => self::$PRP_CLI_TEXT_4,
            'cli_bool_1'        => self::$PRP_CLI_BOOL_1,
            'cli_bool_2'        => self::$PRP_CLI_BOOL_2,
            'cli_bool_3'        => self::$PRP_CLI_BOOL_3,
            'cli_bool_4'        => self::$PRP_CLI_BOOL_4,
            'cli_display_site'  => self::$PRP_CLI_DISPLAY_SITE,
            'cli_send_news'     => self::$PRP_CLI_SEND_NEWS,
            'cli_coord'         => self::$PRP_CLI_COORD,
            'cli_siren'         => self::$PRP_CLI_SIREN,
            'cli_siret'         => self::$PRP_CLI_SIRET,
            'parent_cli_id'     => self::$PRP_PARENT_CLI_ID,
            'cli_sanit'         => self::$PRP_CLI_SANIT,
            'grp_id'            => self::$PRP_GRP_ID,
            'cli_fullname'      => self::$PRP_CLI_FULLNAME,
            'cli_social_reason' => self::$PRP_CLI_SOCIAL_REASON
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
        return ['cli_lastname', 'cli_firstname', 'cli_email'];
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'donations' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Donation',
                FFCST::REL_FIELD   => 'cli_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les dons du client',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK,
                FFCST::REL_EXISTS => '6680005',
            ],
            'sponsorships' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Sponsorship',
                FFCST::REL_FIELD   => 'cli_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les parrainages du client',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK
            ],
            'contact1' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Contract',
                FFCST::REL_FIELD   => 'ctx1_cli_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Contact 1 du contrat',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK
            ],
            'contact2' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Contract',
                FFCST::REL_FIELD   => 'ctx2_cli_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Contact 2 du contrat',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK
            ]
        ];
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
                FFCST::INDEX_FIELDS => 'cli_lastname',
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_CLIENT_NAME_EXISTS
            ]
        ];
    }
}
