<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * UserBroker
 *
 * @author jeromeklam
 */
abstract class UserBroker extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_UBRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du lien',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du broker',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['broker' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Broker',
                FFCST::FOREIGN_FIELD => 'brk_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['user' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::User',
                FFCST::FOREIGN_FIELD => 'user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_UBRK_TS = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date de création',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 13:00:00',
    ];
    protected static $PRP_UBRK_PARTNER_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_partner_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Type, code du partenaire',
        FFCST::PROPERTY_SAMPLE  => 'GOOGLE',
        FFCST::PROPERTY_MAX     => 20
    ];
    protected static $PRP_UBRK_PARTNER_ID = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_partner_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Identifiant chez le partenaire',
        FFCST::PROPERTY_SAMPLE  => '123',
        FFCST::PROPERTY_MAX     => 20
    ];
    protected static $PRP_UBRK_AUTH_METHOD = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_auth_method',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Méthode de lien avec le partenaire',
        FFCST::PROPERTY_SAMPLE  => 'OAUTH',
        FFCST::PROPERTY_MAX     => 20
    ];
    protected static $PRP_UBRK_AUTH_DATAS = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_auth_datas',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Données du partenaire',
        FFCST::PROPERTY_SAMPLE  => '{"scope":"auth"}',
    ];
    protected static $PRP_UBRK_END = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_end',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date d\'expiration du partenaire',
        FFCST::PROPERTY_SAMPLE  => null,
    ];
    protected static $PRP_UBRK_CONFIG = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_config',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Configuration spécifique',
        FFCST::PROPERTY_SAMPLE  => '{}',
    ];
    protected static $PRP_UBRK_CACHE = [
        FFCST::PROPERTY_PRIVATE => 'ubrk_cache',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Cache de données',
        FFCST::PROPERTY_SAMPLE  => '{}',
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du groupe par défaut',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['group' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'ubrk_id'           => self::$PRP_UBRK_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'user_id'           => self::$PRP_USER_ID,
            'ubrk_ts'           => self::$PRP_UBRK_TS,
            'ubrk_partner_type' => self::$PRP_UBRK_PARTNER_TYPE,
            'ubrk_partner_id'   => self::$PRP_UBRK_PARTNER_ID,
            'ubrk_auth_method'  => self::$PRP_UBRK_AUTH_METHOD,
            'ubrk_auth_datas'   => self::$PRP_UBRK_AUTH_DATAS,
            'ubrk_end'          => self::$PRP_UBRK_END,
            'ubrk_config'       => self::$PRP_UBRK_CONFIG,
            'ubrk_cache'        => self::$PRP_UBRK_CACHE,
            'grp_id'            => self::$PRP_GRP_ID,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_user_broker';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des liens utilisateurs / brokers';
    }
}
