<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Broker
 *
 * @author jeromeklam
 */
abstract class BrokerSession extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_BRS_ID = [
        FFCST::PROPERTY_PRIVATE => 'brs_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la session du broker',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_KEY = [
        FFCST::PROPERTY_PRIVATE => 'brk_key',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Clef du broker',
        FFCST::PROPERTY_SAMPLE  => 'brk-test',
        FFCST::PROPERTY_MAX     => 32
    ];
    protected static $PRP_BRS_TOKEN = [
        FFCST::PROPERTY_PRIVATE => 'brs_token',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le token du broker',
        FFCST::PROPERTY_SAMPLE  => '40d1034b83df23aadd4a0e16c7ed31fd',
        FFCST::PROPERTY_MAX     => 32
    ];
    protected static $PRP_BRS_SESSION_ID = [
        FFCST::PROPERTY_PRIVATE => 'brs_session_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'La clef de la session SSO',
        FFCST::PROPERTY_SAMPLE  => '80d8f83bde38f7dab2a4cb9f7727046e',
        FFCST::PROPERTY_MAX     => 32
    ];
    protected static $PRP_BRS_CLIENT_ADDRESS = [
        FFCST::PROPERTY_PRIVATE => 'brs_client_address',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'L\'adresse IP du client',
        FFCST::PROPERTY_SAMPLE  => '192.168.0.1',
        FFCST::PROPERTY_MAX     => 50
    ];
    protected static $PRP_BRS_DATE_CREATED = [
        FFCST::PROPERTY_PRIVATE => 'brs_date_created',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_COMMENT => 'La date de création',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 15:00:00',
    ];
    protected static $PRP_BRS_END = [
        FFCST::PROPERTY_PRIVATE => 'brs_end',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'La date d\'expiration',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 15:00:00',
    ];
    protected static $PRP_SESS_ID = [
        FFCST::PROPERTY_PRIVATE => 'sess_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED,FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'L\'identifiant de la session',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['session' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Session',
                FFCST::FOREIGN_FIELD => 'sess_id',
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
            'brs_id'             => self::$PRP_BRS_ID,
            'brk_key'            => self::$PRP_BRK_KEY,
            'brs_token'          => self::$PRP_BRS_TOKEN,
            'brs_session_id'     => self::$PRP_BRS_SESSION_ID,
            'brs_client_address' => self::$PRP_BRS_CLIENT_ADDRESS,
            'brs_date_created'   => self::$PRP_BRS_DATE_CREATED,
            'brs_end'            => self::$PRP_BRS_END,
            'sess_id'            => self::$PRP_SESS_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_broker_session';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des sessions d\'un broker';
    }
}
