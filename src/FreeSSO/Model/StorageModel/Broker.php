<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Broker
 *
 * @author jeromeklam
 */
abstract class Broker extends \FreeSSO\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du broker',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_DOM_ID = [
        FFCST::PROPERTY_PRIVATE => 'dom_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du domaine principal',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['domain' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Domain',
                FFCST::FOREIGN_FIELD => 'dom_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_BRK_KEY = [
        FFCST::PROPERTY_PRIVATE => 'brk_key',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'La clef du broker: son code, un md5, ...',
        FFCST::PROPERTY_SAMPLE  => 'app-test',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_BRK_NAME = [
        FFCST::PROPERTY_PRIVATE => 'brk_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le nom du broker',
        FFCST::PROPERTY_SAMPLE  => 'Mon broker test',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_BRK_CERTIFICATE = [
        FFCST::PROPERTY_PRIVATE => 'brk_certificate',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le certificat du broker : md5 ou +',
        FFCST::PROPERTY_SAMPLE  => '8ba1f94d6924f62611462e50d6b52df5',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_BRK_ACTIVE = [
        FFCST::PROPERTY_PRIVATE => 'brk_active',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le broker est-il actif ?',
        FFCST::PROPERTY_SAMPLE  => true,
    ];
    protected static $PRP_BRK_TS = [
        FFCST::PROPERTY_PRIVATE => 'brk_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La date de création',
        FFCST::PROPERTY_SAMPLE  => '2020-05-01 12:00:00',
    ];
    protected static $PRP_BRK_API_SCOPE = [
        FFCST::PROPERTY_PRIVATE => 'brk_api_scope',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Les restrictions d\'usages, séparées par, vide pour tout authoriser',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_BRK_USERS_SCOPE = [
        FFCST::PROPERTY_PRIVATE => 'brk_users_scope',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT =>
            'Les restrictions des types d\'utilisateurs, ' .
            'séparées par, vide pour tout authoriser',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_BRK_AUTH = [
        FFCST::PROPERTY_PRIVATE => 'brk_auth',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Les types d\'authorisations séparées par , vide ne permet pas de se connecter',
        FFCST::PROPERTY_SAMPLE  => 'JWT,HAWK',
    ];
    protected static $PRP_BRK_IPS = [
        FFCST::PROPERTY_PRIVATE => 'brk_ips',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Les restrictions d\'IPs au format json, vide pour tout authoriser',
        FFCST::PROPERTY_SAMPLE  => '[{"value":"192.168.0.1","label":"Mon IP locale"}]',
    ];
    protected static $PRP_BRK_SAME_IP = [
        FFCST::PROPERTY_PRIVATE => 'brk_same_ip',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => true,
        FFCST::PROPERTY_COMMENT => 'L\'IP de la connexion est à vérifier ?',
        FFCST::PROPERTY_SAMPLE  => true,
    ];
    protected static $PRP_BRK_CONFIG = [
        FFCST::PROPERTY_PRIVATE => 'brk_config',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La configuration spécifique du broker',
        FFCST::PROPERTY_SAMPLE  =>
            '{"site" : {"url": "http://localhost:6075"}, ' .
            '"email": {"from-email" : "support@test.fr"}}',
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Le groupe principal de rattachement',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['group' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_BRK_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'brk_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['EXTERN','LINK','MANUAL','TECH'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le type de broker',
        FFCST::PROPERTY_SAMPLE  => 'MANUAL'
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'brk_id'          => self::$PRP_BRK_ID,
            'dom_id'          => self::$PRP_DOM_ID,
            'brk_key'         => self::$PRP_BRK_KEY,
            'brk_name'        => self::$PRP_BRK_NAME,
            'brk_certificate' => self::$PRP_BRK_CERTIFICATE,
            'brk_active'      => self::$PRP_BRK_ACTIVE,
            'brk_ts'          => self::$PRP_BRK_TS,
            'brk_api_scope'   => self::$PRP_BRK_API_SCOPE,
            'brk_users_scope' => self::$PRP_BRK_USERS_SCOPE,
            'brk_auth'        => self::$PRP_BRK_AUTH,
            'brk_ips'         => self::$PRP_BRK_IPS,
            'brk_same_ip'     => self::$PRP_BRK_SAME_IP,
            'brk_config'      => self::$PRP_BRK_CONFIG,
            'grp_id'          => self::$PRP_GRP_ID,
            'brk_type'        => self::$PRP_BRK_TYPE
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_broker';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion d\'un broker (accès)';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['brk_key', 'brk_name'];
    }

    /**
     * Get uniq indexes
     *
     * @return array[]
     */
    public static function getUniqIndexes()
    {
        return [
            'key' => [
                FFCST::INDEX_FIELDS => 'brk_key',
                FFCST::INDEX_EXISTS => '6410010',
            ],
            'name' => [
                FFCST::INDEX_FIELDS => 'brk_name',
                FFCST::INDEX_EXISTS => '6410011',
            ]
        ];
    }
}
