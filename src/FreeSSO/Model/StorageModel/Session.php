<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Session
 *
 * @author jeromeklam
 */
abstract class Session extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_SESS_ID = [
        FFCST::PROPERTY_PRIVATE => 'sess_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la session',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'utilisateur de la session',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['user' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::User',
                FFCST::FOREIGN_FIELD => 'user_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SESS_START = [
        FFCST::PROPERTY_PRIVATE => 'sess_start',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de début de la session',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 14:00:00',
    ];
    protected static $PRP_SESS_END = [
        FFCST::PROPERTY_PRIVATE => 'sess_end',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date d\expiration de la session',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 16:00:00',
    ];
    protected static $PRP_SESS_TOUCH = [
        FFCST::PROPERTY_PRIVATE => 'sess_touch',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Date de mise à jour de la session',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 14:02:00',
    ];
    protected static $PRP_SESS_CONTENT = [
        FFCST::PROPERTY_PRIVATE => 'sess_content',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Contenu de la session : serialize, ...',
        FFCST::PROPERTY_SAMPLE  => '...',
    ];
    protected static $PRP_SESS_CLIENT_ADDR = [
        FFCST::PROPERTY_PRIVATE => 'sess_client_addr',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Adresse IP du client',
        FFCST::PROPERTY_SAMPLE  => '192.168.0.1',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'sess_id'          => self::$PRP_SESS_ID,
            'user_id'          => self::$PRP_USER_ID,
            'sess_start'       => self::$PRP_SESS_START,
            'sess_end'         => self::$PRP_SESS_END,
            'sess_touch'       => self::$PRP_SESS_TOUCH,
            'sess_content'     => self::$PRP_SESS_CONTENT,
            'sess_client_addr' => self::$PRP_SESS_CLIENT_ADDR
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_session';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des sessions';
    }
}
