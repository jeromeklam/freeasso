<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * PasswordToken
 *
 * @author jeromeklam
 */
abstract class PasswordToken extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_PTOK_ID = [
        FFCST::PROPERTY_PRIVATE => 'ptok_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du token',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_PTOK_TOKEN = [
        FFCST::PROPERTY_PRIVATE => 'ptok_token',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le token',
        FFCST::PROPERTY_SAMPLE  => '7671759596ca7bd9664f08aa3dd79039',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_PTOK_USED = [
        FFCST::PROPERTY_PRIVATE => 'ptok_used',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Utilisé',
        FFCST::PROPERTY_SAMPLE  => true,
        FFCST::PROPERTY_DEFAULT => false,
    ];
    protected static $PRP_PTOK_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'ptok_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Adresse email du demandeur',
        FFCST::PROPERTY_SAMPLE  => 'test@free.fr',
        FFCST::PROPERTY_MAX     => 255,
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
    protected static $PRP_PTOK_REQUEST_IP = [
        FFCST::PROPERTY_PRIVATE => 'ptok_request_ip',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Adresse IP lors de la demande',
        FFCST::PROPERTY_SAMPLE  => '192.168.0.1',
        FFCST::PROPERTY_MAX     => 50,
    ];
    protected static $PRP_PTOK_RESOLVE_IP = [
        FFCST::PROPERTY_PRIVATE => 'ptok_resolve_ip',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Adresse IP lors de l\'utilisation',
        FFCST::PROPERTY_SAMPLE  => '192.168.0.1',
        FFCST::PROPERTY_MAX     => 50,
    ];
    protected static $PRP_PTOK_END = [
        FFCST::PROPERTY_PRIVATE => 'ptok_end',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Date d\'expiration',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 15:45:00',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'ptok_id'         => self::$PRP_PTOK_ID,
            'ptok_token'      => self::$PRP_PTOK_TOKEN,
            'ptok_used'       => self::$PRP_PTOK_USED,
            'ptok_email'      => self::$PRP_PTOK_EMAIL,
            'user_id'         => self::$PRP_USER_ID,
            'ptok_request_ip' => self::$PRP_PTOK_REQUEST_IP,
            'ptok_resolve_ip' => self::$PRP_PTOK_RESOLVE_IP,
            'ptok_end'        => self::$PRP_PTOK_END
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_password_token';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des tokens de changement de mot de passe';
    }
}
