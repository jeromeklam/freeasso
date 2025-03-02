<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * GroupUser
 *
 * @author jeromeklam
 */
abstract class GroupUser extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_GRU_ID = [
        FFCST::PROPERTY_PRIVATE => 'gru_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du lien',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du groupe',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['group' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
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
    protected static $PRP_FCT_ID = [
        FFCST::PROPERTY_PRIVATE => 'fct_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la fonction',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['job_function' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::JobFunction',
                FFCST::FOREIGN_FIELD => 'fct_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_GRU_SCOPE = [
        FFCST::PROPERTY_PRIVATE => 'gru_scope',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Rôles spécifiques de l\'utilisateur pour ce groupe, séparés par ,',
        FFCST::PROPERTY_SAMPLE  => 'ADMIN',
    ];
    protected static $PRP_GRU_TEL1 = [
        FFCST::PROPERTY_PRIVATE => 'gru_tel1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Téléphone 1',
        FFCST::PROPERTY_SAMPLE  => '0033 06 ...',
        FFCST::PROPERTY_MAX     => 20
    ];
    protected static $PRP_GRU_TEL2 = [
        FFCST::PROPERTY_PRIVATE => 'gru_tel2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Téléphone 2',
        FFCST::PROPERTY_SAMPLE  => '0033 06 ...',
        FFCST::PROPERTY_MAX     => 20
    ];
    protected static $PRP_GRU_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'gru_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Email',
        FFCST::PROPERTY_SAMPLE  => 'test@free.fr',
        FFCST::PROPERTY_MAX     => 255
    ];
    protected static $PRP_GRU_FROM = [
        FFCST::PROPERTY_PRIVATE => 'gru_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Début de validité',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 13:00:00',
    ];
    protected static $PRP_GRU_TO = [
        FFCST::PROPERTY_PRIVATE => 'gru_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Fin de validité',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 13:00:00',
    ];
    protected static $PRP_GRU_ACTIV = [
        FFCST::PROPERTY_PRIVATE => 'gru_activ',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Actif',
        FFCST::PROPERTY_SAMPLE  => true,
        FFCST::PROPERTY_DEFAULT => false,
    ];
    protected static $PRP_GRU_TS = [
        FFCST::PROPERTY_PRIVATE => 'gru_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de création',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 13:00:00',
    ];
    protected static $PRP_GRU_EXTERN_ID = [
        FFCST::PROPERTY_PRIVATE => 'gru_extern_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Identifiant externe',
        FFCST::PROPERTY_SAMPLE  => '3245',
        FFCST::PROPERTY_MAX     => 80
    ];
    protected static $PRP_GRU_INFORMATIONS = [
        FFCST::PROPERTY_PRIVATE => 'gru_informations',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Informations générales libres',
        FFCST::PROPERTY_SAMPLE  => '...',
    ];
    protected static $PRP_GRU_RGPD = [
        FFCST::PROPERTY_PRIVATE => 'gru_rgpd',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Informations liées au RGPD',
        FFCST::PROPERTY_SAMPLE  => '{"last_validation":"2020-04-01"}',
    ];
    protected static $PRP_GRU_PERMISIONS = [
        FFCST::PROPERTY_PRIVATE => 'gru_permissions',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Droits d\'accès',
        FFCST::PROPERTY_SAMPLE  => '{"donation":"rwx"}',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'gru_id'           => self::$PRP_GRU_ID,
            'grp_id'           => self::$PRP_GRP_ID,
            'user_id'          => self::$PRP_USER_ID,
            'fct_id'           => self::$PRP_FCT_ID,
            'gru_scope'        => self::$PRP_GRU_SCOPE,
            'gru_tel1'         => self::$PRP_GRU_TEL1,
            'gru_tel2'         => self::$PRP_GRU_TEL2,
            'gru_email'        => self::$PRP_GRU_EMAIL,
            'gru_from'         => self::$PRP_GRU_FROM,
            'gru_to'           => self::$PRP_GRU_TO,
            'gru_activ'        => self::$PRP_GRU_ACTIV,
            'gru_ts'           => self::$PRP_GRU_TS,
            'gru_extern_id'    => self::$PRP_GRU_EXTERN_ID,
            'gru_informations' => self::$PRP_GRU_INFORMATIONS,
            'gru_rgpd'         => self::$PRP_GRU_RGPD,
            'gru_permissions'  => self::$PRP_GRU_PERMISIONS
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_group_user';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des liens utilisateurs / groupes';
    }
}
