<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseGrowth
 *
 * @author jeromeklam
 */
abstract class CauseGrowth extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_GROW_ID = [
        FFCST::PROPERTY_PRIVATE => 'grow_id',
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
    protected static $PRP_GROW_TS = [
        FFCST::PROPERTY_PRIVATE => 'grow_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_GROW_WEIGHT = [
        FFCST::PROPERTY_PRIVATE => 'grow_weight',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_GROW_HEIGHT = [
        FFCST::PROPERTY_PRIVATE => 'grow_height',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'grow_id'     => self::$PRP_GROW_ID,
            'brk_id'      => self::$PRP_BRK_ID,
            'cau_id'      => self::$PRP_CAU_ID,
            'grow_ts'     => self::$PRP_GROW_TS,
            'grow_weight' => self::$PRP_GROW_WEIGHT,
            'grow_height' => self::$PRP_GROW_HEIGHT
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_growth';
    }
}
