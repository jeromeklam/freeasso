<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Alert
 *
 * @author jeromeklam
 */
abstract class Alert extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_ALERT_ID = [
        FFCST::PROPERTY_PRIVATE => 'alert_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_ALERT_FROM = [
        FFCST::PROPERTY_PRIVATE => 'alert_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ALERT_TO = [
        FFCST::PROPERTY_PRIVATE => 'alert_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ALERT_TS = [
        FFCST::PROPERTY_PRIVATE => 'alert_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ALERT_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'alert_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ALERT_ACTIV = [
        FFCST::PROPERTY_PRIVATE => 'alert_activ',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ALERT_PRIORITY = [
        FFCST::PROPERTY_PRIVATE => 'alert_priority',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    
    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'alert_id'       => self::$PRP_ALERT_ID,
            'site_id'        => self::$PRP_SITE_ID,
            'cau_id'         => self::$PRP_CAU_ID,
            'cli_id'         => self::$PRP_CLI_ID,
            'brk_id'         => self::$PRP_BRK_ID,
            'alert_from'     => self::$PRP_ALERT_FROM,
            'alert_to'       => self::$PRP_ALERT_TO,
            'alert_ts'       => self::$PRP_ALERT_TS,
            'alert_text'     => self::$PRP_ALERT_TEXT,
            'alert_activ'    => self::$PRP_ALERT_ACTIV,
            'alert_priority' => self::$PRP_ALERT_PRIORITY,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'crm_alert';
    }
}
