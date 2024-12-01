<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * User
 *
 * @author jeromeklam
 */
abstract class User extends \FreeSSO\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_USER_LOGIN = [
        FFCST::PROPERTY_PRIVATE => 'user_login',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Login de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 'test@free.fr',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_USER_PASSWORD = [
        FFCST::PROPERTY_PRIVATE => 'user_password',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_COMMENT => 'Mot de passe de l\'utilisateur md5',
        FFCST::PROPERTY_SAMPLE  => '36be585be8329e9380b4f769168978e7',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_USER_ACTIVE = [
        FFCST::PROPERTY_PRIVATE => 'user_active',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => false,
        FFCST::PROPERTY_COMMENT => 'Utilisateur actif ?',
        FFCST::PROPERTY_SAMPLE  => false,
    ];
    protected static $PRP_USER_SALT = [
        FFCST::PROPERTY_PRIVATE => 'user_salt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_COMMENT => 'Ajout au mot de passe',
        FFCST::PROPERTY_SAMPLE  => 'd911f73353d1b5fd67fb90b0e1ea7a1f',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_USER_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'user_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Email, en général login',
        FFCST::PROPERTY_SAMPLE  => 'test@free.fr',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_USER_FIRST_NAME = [
        FFCST::PROPERTY_PRIVATE => 'user_first_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Prénom de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 'JOHN',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_USER_LAST_NAME = [
        FFCST::PROPERTY_PRIVATE => 'user_last_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Nom de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 'DOE',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_USER_TITLE = [
        FFCST::PROPERTY_PRIVATE => 'user_title',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['MISTER','MADAM','MISS','OTHER'],
        FFCST::PROPERTY_DEFAULT => 'OTHER',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Civilité de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 'MISTER',
    ];
    protected static $PRP_USER_SCOPE = [
        FFCST::PROPERTY_PRIVATE => 'user_scope',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Roles de l\'utilisateur séparés par ,',
        FFCST::PROPERTY_SAMPLE  => 'ADMIN',
    ];
    protected static $PRP_USER_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'user_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['USER','IP','UUID','ANONYMOUS','REST'],
        FFCST::PROPERTY_DEFAULT => 'USER',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Type de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 'USER',
    ];
    protected static $PRP_USER_IPS = [
        FFCST::PROPERTY_PRIVATE => 'user_ips',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'IPs autorisées séparées par ,',
        FFCST::PROPERTY_SAMPLE  => '[{"value":"192.168.0.1","label":"Mon IP locale"}]',
    ];
    protected static $PRP_USER_LAST_UPDATE = [
        FFCST::PROPERTY_PRIVATE => 'user_last_update',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_COMMENT => 'Dernière mise à jour',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 12:23:23',
    ];
    protected static $PRP_USER_PREFERRED_LANGUAGE = [
        FFCST::PROPERTY_PRIVATE    => 'user_preferred_language',
        FFCST::PROPERTY_TYPE       => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS    => [],
        FFCST::PROPERTY_DEPRECATED => true,
        FFCST::PROPERTY_COMMENT    => 'Language préféré (déprécié)',
        FFCST::PROPERTY_SAMPLE     => 'FR',
    ];
    protected static $PRP_USER_AVATAR = [
        FFCST::PROPERTY_PRIVATE => 'user_avatar',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Avatar',
        FFCST::PROPERTY_SAMPLE  => '3834HHRIEYRGZRBEb...',
    ];
    protected static $PRP_USER_CACHE = [
        FFCST::PROPERTY_PRIVATE => 'user_cache',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Informations de cache',
        FFCST::PROPERTY_SAMPLE  => '{"menu":true}',
    ];
    protected static $PRP_USER_VAL_STRING = [
        FFCST::PROPERTY_PRIVATE => 'user_val_string',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_COMMENT => 'Token de validation du compte md5',
        FFCST::PROPERTY_SAMPLE  => 'ede5cb66d6d987d8624e11eed4009585',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_USER_VAL_END = [
        FFCST::PROPERTY_PRIVATE => 'user_val_end',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_COMMENT => 'Fin de validité du token',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 13:00:00',
    ];
    protected static $PRP_USER_VAL_LOGIN = [
        FFCST::PROPERTY_PRIVATE => 'user_val_login',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_COMMENT => 'Login utilisé pour la validation du compte',
        FFCST::PROPERTY_SAMPLE  => 'test@free.fr',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_USER_CNX = [
        FFCST::PROPERTY_PRIVATE => 'user_cnx',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE],
        FFCST::PROPERTY_COMMENT => 'Paramètres et configuration de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => '{"cnx":"mysql://user..."}',
    ];
    protected static $PRP_USER_EXTERN_CODE = [
        FFCST::PROPERTY_PRIVATE => 'user_extern_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Code externe de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 'TEST',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Langue par défaut de l\'utilisateur',
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
    protected static $PRP_PERMISSIONS = [
        FFCST::PROPERTY_PRIVATE => 'permissions',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'Permissions de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => '{}',
        FFCST::PROPERTY_DEFAULT => '{}',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'user_id'                 => self::$PRP_USER_ID,
            'user_login'              => self::$PRP_USER_LOGIN,
            'user_password'           => self::$PRP_USER_PASSWORD,
            'user_active'             => self::$PRP_USER_ACTIVE,
            'user_salt'               => self::$PRP_USER_SALT,
            'user_email'              => self::$PRP_USER_EMAIL,
            'user_first_name'         => self::$PRP_USER_FIRST_NAME,
            'user_last_name'          => self::$PRP_USER_LAST_NAME,
            'user_title'              => self::$PRP_USER_TITLE,
            'user_scope'              => self::$PRP_USER_SCOPE,
            'user_type'               => self::$PRP_USER_TYPE,
            'user_ips'                => self::$PRP_USER_IPS,
            'user_last_update'        => self::$PRP_USER_LAST_UPDATE,
            'user_preferred_language' => self::$PRP_USER_PREFERRED_LANGUAGE,
            'user_avatar'             => self::$PRP_USER_AVATAR,
            'user_cache'              => self::$PRP_USER_CACHE,
            'user_val_string'         => self::$PRP_USER_VAL_STRING,
            'user_val_end'            => self::$PRP_USER_VAL_END,
            'user_val_login'          => self::$PRP_USER_VAL_LOGIN,
            'user_cnx'                => self::$PRP_USER_CNX,
            'user_extern_code'        => self::$PRP_USER_EXTERN_CODE,
            'lang_id'                 => self::$PRP_LANG_ID,
            'permissions'             => self::$PRP_PERMISSIONS
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_user';
    }
   
    /**
     * Retourne le nom court
     */
    public static function getSourceTitle()
    {
        return 'Utilisateur';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion d\'un utilisateur';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['user_first_name', 'user_last_name'];
    }

    /**
     * Get uniq indexes
     *
     * @return array[]
     */
    public static function getUniqIndexes()
    {
        return [
            'login' => [
                FFCST::INDEX_FIELDS => 'user_login',
                FFCST::INDEX_EXISTS => '6410001',
            ]
        ];
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'brokers' => [
                FFCST::REL_MODEL   => 'FreeSSO::Model::UserBroker',
                FFCST::REL_FIELD   => 'user_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les brokers de l\'utilisateur',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'groups' => [
                FFCST::REL_MODEL   => 'FreeSSO::Model::GroupUser',
                FFCST::REL_FIELD   => 'user_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les groupes de l\'utilisateur',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'config' => [
                FFCST::REL_MODEL   => 'FreeSSO::Model::UserBroker',
                FFCST::REL_FIELD   => 'user_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'La config de l\'utilisateur pour le broker en cours',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'realms' => [
                FFCST::REL_MODEL   => 'FreeSSO::Model::GroupUser',
                FFCST::REL_FIELD   => 'user_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les groupes de l\'utilisateur pour le broker en cours',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
        ];
    }
}
