<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Group
 *
 * @author jeromeklam
 */
abstract class Group extends \FreeSSO\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du groupe',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_GRPT_ID = [
        FFCST::PROPERTY_PRIVATE => 'grpt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du type de groupe',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['group_type' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::GroupType',
                FFCST::FOREIGN_FIELD => 'grpt_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_GRP_CODE = [
        FFCST::PROPERTY_PRIVATE => 'grp_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le code court du groupe',
        FFCST::PROPERTY_SAMPLE  => 'GRP1',
        FFCST::PROPERTY_MAX     => 20,
    ];
    protected static $PRP_GRP_NAME = [
        FFCST::PROPERTY_PRIVATE => 'grp_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le nom du groupe',
        FFCST::PROPERTY_SAMPLE  => 'Mon groupe 1',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_GRP_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'grp_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La première ligne d\'adresse',
        FFCST::PROPERTY_SAMPLE  => '1 Rue test',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_GRP_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'grp_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La seconde ligne d\'adresse',
        FFCST::PROPERTY_SAMPLE  => 'A côté de l\'église',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_GRP_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'grp_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La troisième ligne d\'adresse',
        FFCST::PROPERTY_SAMPLE  => 'Cedex 20',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_GRP_CP = [
        FFCST::PROPERTY_PRIVATE => 'grp_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le code postal',
        FFCST::PROPERTY_SAMPLE  => '12345',
        FFCST::PROPERTY_MAX     => 20,
    ];
    protected static $PRP_GRP_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'grp_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La ville',
        FFCST::PROPERTY_SAMPLE  => 'Jolieville',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_CNTY_ID = [
        FFCST::PROPERTY_PRIVATE => 'cnty_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'L\'identifiant du pays',
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_COUNTRY,
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['country' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeFW::Model::Country',
                FFCST::FOREIGN_FIELD => 'cnty_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'L\'identifiant de la langue par défaut pour ce groupe',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_LANG,
        FFCST::PROPERTY_FK      => ['lang' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeFW::Model::Lang',
                FFCST::FOREIGN_FIELD => 'lang_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_GRP_FROM = [
        FFCST::PROPERTY_PRIVATE => 'grp_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Début de validité',
        FFCST::PROPERTY_SAMPLE  => '2020-01-01 12:00:00',
    ];
    protected static $PRP_GRP_TO = [
        FFCST::PROPERTY_PRIVATE => 'grp_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Fin de validité',
        FFCST::PROPERTY_SAMPLE  => '2021-01-01 12:00:00',
    ];
    protected static $PRP_GRP_PARENT_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_parent_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'L\'identifiant du groupe parent',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['parent' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_GRP_MONEY_CODE = [
        FFCST::PROPERTY_PRIVATE => 'grp_money_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['EUR','USD','CHF','GBD','IDR'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le code de la monnaie de stockage',
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_SAMPLE  => 'EUR',
    ];
    protected static $PRP_GRP_MONEY_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'grp_money_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['EUR','USD','CHF','GBD','IDR'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le code de la monnaie de saisie',
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_SAMPLE  => 'EUR',
    ];
    protected static $PRP_GRP_LOGO = [
        FFCST::PROPERTY_PRIVATE => 'grp_logo',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le logo',
        FFCST::PROPERTY_SAMPLE  => '1HKJUYSQDGSQJ1dqdsqjhSDKq...',
    ];
    protected static $PRP_GRP_EMAIL_HEADER = [
        FFCST::PROPERTY_PRIVATE => 'grp_email_header',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_HTML,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'L\'en-tête de page de correspondance',
        FFCST::PROPERTY_SAMPLE  => '<p>Mairie de Jolieville</p>',
    ];
    protected static $PRP_GRP_EMAIL_FOOTER = [
        FFCST::PROPERTY_PRIVATE => 'grp_email_footer',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_HTML,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le pied de page de correspondance',
        FFCST::PROPERTY_SAMPLE  => '<p>Le maire</p>',
    ];
    protected static $PRP_GRP_SIGN = [
        FFCST::PROPERTY_PRIVATE => 'grp_sign',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_HTML,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La signature',
        FFCST::PROPERTY_SAMPLE  => '<p>Signature</p>',
    ];
    protected static $PRP_GRP_REALM_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_realm_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'L\identifiant du domaine principal, par défaut soi-même',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['realm' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_GRP_CONFIG = [
        FFCST::PROPERTY_PRIVATE => 'grp_config',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La configuration au format json',
        FFCST::PROPERTY_SAMPLE  => '{"site-public","https://mairie-joliville.fr"}',
    ];
    protected static $PRP_GRP_PHONE = [
        FFCST::PROPERTY_PRIVATE => 'grp_phone',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le numéro de téléphone',
        FFCST::PROPERTY_SAMPLE  => '01 01 01 01 01',
    ];
    protected static $PRP_GRP_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'grp_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'L\'email',
        FFCST::PROPERTY_SAMPLE  => 'support@jolieville.fr',
    ];
    protected static $PRP_GRP_SITE_URL = [
        FFCST::PROPERTY_PRIVATE => 'grp_site_url',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'L\'url du site public',
        FFCST::PROPERTY_SAMPLE  => 'https://jolieville.fr',
    ];
    protected static $PRP_GRP_EMAIL_PAYMENT = [
        FFCST::PROPERTY_PRIVATE => 'grp_email_payment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Conditions de paiement',
        FFCST::PROPERTY_SAMPLE  => '<p>...</p>',
    ];
    protected static $PRP_GRP_LINE_ADDRESS = [
        FFCST::PROPERTY_PRIVATE => 'grp_line_address',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'Adresse sur une ligne',
        FFCST::PROPERTY_SAMPLE  => '56, ....',
    ];
    protected static $PRP_GRP_DIG_SIGN = [
        FFCST::PROPERTY_PRIVATE => 'grp_dig_sign',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Signature digitale',
        FFCST::PROPERTY_SAMPLE  => '1HKJUYSQDGSQJ1dqdsqjhSDKq...',
    ];
    protected static $PRP_GRP_SIRET = [
        FFCST::PROPERTY_PRIVATE => 'grp_siret',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Siret',
        FFCST::PROPERTY_SAMPLE  => '....',
    ];
    protected static $PRP_GRP_SIRET_CPL = [
        FFCST::PROPERTY_PRIVATE => 'grp_siret_cpl',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Complément du Siret',
        FFCST::PROPERTY_SAMPLE  => '....',
    ];
    protected static $PRP_GRP_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'grp_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_HTML,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Texte reçus',
        FFCST::PROPERTY_SAMPLE  => '....',
    ];
    protected static $PRP_GRP_DIG_SIGN2 = [
        FFCST::PROPERTY_PRIVATE => 'grp_dig_sign2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Signature digitale 2',
        FFCST::PROPERTY_SAMPLE  => '1HKJUYSQDGSQJ1dqdsqjhSDKq...',
    ];
    protected static $PRP_GRP_SIGN2 = [
        FFCST::PROPERTY_PRIVATE => 'grp_sign2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_HTML,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La signature 2',
        FFCST::PROPERTY_SAMPLE  => '<p>Signature</p>',
    ];
    protected static $PRP_GRP_COG = [
        FFCST::PROPERTY_PRIVATE => 'grp_cog',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Code COG',
        FFCST::PROPERTY_SAMPLE  => '99100',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'grp_id'            => self::$PRP_GRP_ID,
            'grpt_id'           => self::$PRP_GRPT_ID,
            'grp_code'          => self::$PRP_GRP_CODE,
            'grp_name'          => self::$PRP_GRP_NAME,
            'grp_address1'      => self::$PRP_GRP_ADDRESS1,
            'grp_address2'      => self::$PRP_GRP_ADDRESS2,
            'grp_address3'      => self::$PRP_GRP_ADDRESS3,
            'grp_cp'            => self::$PRP_GRP_CP,
            'grp_town'          => self::$PRP_GRP_TOWN,
            'cnty_id'           => self::$PRP_CNTY_ID,
            'lang_id'           => self::$PRP_LANG_ID,
            'grp_from'          => self::$PRP_GRP_FROM,
            'grp_to'            => self::$PRP_GRP_TO,
            'grp_parent_id'     => self::$PRP_GRP_PARENT_ID,
            'grp_money_code'    => self::$PRP_GRP_MONEY_CODE,
            'grp_money_input'   => self::$PRP_GRP_MONEY_INPUT,
            'grp_logo'          => self::$PRP_GRP_LOGO,
            'grp_email_header'  => self::$PRP_GRP_EMAIL_HEADER,
            'grp_email_footer'  => self::$PRP_GRP_EMAIL_FOOTER,
            'grp_sign'          => self::$PRP_GRP_SIGN,
            'grp_realm_id'      => self::$PRP_GRP_REALM_ID,
            'grp_config'        => self::$PRP_GRP_CONFIG,
            'grp_phone'         => self::$PRP_GRP_PHONE,
            'grp_email'         => self::$PRP_GRP_EMAIL,
            'grp_site_url'      => self::$PRP_GRP_SITE_URL,
            'grp_email_payment' => self::$PRP_GRP_EMAIL_PAYMENT,
            'grp_line_address'  => self::$PRP_GRP_LINE_ADDRESS,
            'grp_dig_sign'      => self::$PRP_GRP_DIG_SIGN,
            'grp_siret'         => self::$PRP_GRP_SIRET,
            'grp_siret_cpl'     => self::$PRP_GRP_SIRET_CPL,
            'grp_receipt'       => self::$PRP_GRP_RECEIPT,
            'grp_sign2'         => self::$PRP_GRP_SIGN2,
            'grp_dig_sign2'     => self::$PRP_GRP_DIG_SIGN2,
            'grp_cog'           => self::$PRP_GRP_COG,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_group';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceTitle()
    {
        return 'Groupe';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des groupes';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['grp_name', 'grp_code'];
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'users' => [
                FFCST::REL_MODEL   => 'FreeSSO::Model::GroupUser',
                FFCST::REL_FIELD   => 'grp_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les utilisateurs du groupe',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ]
        ];
    }
}
