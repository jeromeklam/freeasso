<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseLink
 *
 * @author jeromeklam
 */
abstract class CauseLink extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAUL_ID = [
        FFCST::PROPERTY_PRIVATE => 'caul_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_FROM_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'from_cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_TO_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'to_cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUL_FROM = [
        FFCST::PROPERTY_PRIVATE => 'caul_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUL_TO = [
        FFCST::PROPERTY_PRIVATE => 'caul_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAULT_ID = [
        FFCST::PROPERTY_PRIVATE => 'cault_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
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
            'caul_id'     => self::$PRP_CAUL_ID,
            'from_cau_id' => self::$PRP_FROM_CAU_ID,
            'to_cau_id'   => self::$PRP_TO_CAU_ID,
            'caul_from'   => self::$PRP_CAUL_FROM,
            'caul_to'     => self::$PRP_CAUL_TO,
            'cault_id'    => self::$PRP_CAULT_ID,
            'grp_id'      => self::$PRP_GRP_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_link';
    }
}
