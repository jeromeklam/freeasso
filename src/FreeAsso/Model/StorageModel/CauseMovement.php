<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseMovement
 *
 * @author jeromeklam
 */
abstract class CauseMovement extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAMV_ID = [
        FFCST::PROPERTY_PRIVATE => 'camv_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAMV_SITE_FROM_ID = [
        FFCST::PROPERTY_PRIVATE => 'camv_site_from_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['from_site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAMV_SITE_TO_ID = [
        FFCST::PROPERTY_PRIVATE => 'camv_site_to_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['to_site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAMV_TS = [
        FFCST::PROPERTY_PRIVATE => 'camv_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAMV_START = [
        FFCST::PROPERTY_PRIVATE => 'camv_start',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAMV_TO = [
        FFCST::PROPERTY_PRIVATE => 'camv_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAMV_COMMENT = [
        FFCST::PROPERTY_PRIVATE => 'camv_comment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAMV_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'camv_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['OK','WAIT','KO','ARCHIVE'],
        FFCST::PROPERTY_DEFAULT => 'WAIT',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_MOVE_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['movement' =>
            [
                'model' => 'FreeAsso::Model::Movement',
                'field' => 'move_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
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

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'camv_id'           => self::$PRP_CAMV_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'cau_id'            => self::$PRP_CAU_ID,
            'camv_site_from_id' => self::$PRP_CAMV_SITE_FROM_ID,
            'camv_site_to_id'   => self::$PRP_CAMV_SITE_TO_ID,
            'camv_ts'           => self::$PRP_CAMV_TS,
            'camv_start'        => self::$PRP_CAMV_START,
            'camv_to'           => self::$PRP_CAMV_TO,
            'camv_comment'      => self::$PRP_CAMV_COMMENT,
            'camv_status'       => self::$PRP_CAMV_STATUS,
            'move_id'           => self::$PRP_MOVE_ID,
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
        return 'asso_cause_movement';
    }
}
