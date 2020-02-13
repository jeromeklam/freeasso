<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseSickness
 *
 * @author jeromeklam
 */
abstract class CauseSickness extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAUS_ID = [
        FFCST::PROPERTY_PRIVATE => 'caus_id',
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
    protected static $PRP_SICK_ID = [
        FFCST::PROPERTY_PRIVATE => 'sick_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['sickness' =>
            [
                'model' => 'FreeAsso::Model::Sickness',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUS_FROM = [
        FFCST::PROPERTY_PRIVATE => 'caus_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUS_TO = [
        FFCST::PROPERTY_PRIVATE => 'caus_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SANITARY_ID = [
        FFCST::PROPERTY_PRIVATE => 'sanitary_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['sanitary' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUS_DESC = [
        FFCST::PROPERTY_PRIVATE => 'caus_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUS_WHERE = [
        FFCST::PROPERTY_PRIVATE => 'caus_where',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUS_CARE = [
        FFCST::PROPERTY_PRIVATE => 'caus_care',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUS_CARE_DESC = [
        FFCST::PROPERTY_PRIVATE => 'caus_care_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
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
            'caus_id'        => self::$PRP_CAUS_ID,
            'brk_id'         => self::$PRP_BRK_ID,
            'cau_id'         => self::$PRP_CAU_ID,
            'sick_id'        => self::$PRP_SICK_ID,
            'caus_from'      => self::$PRP_CAUS_FROM,
            'caus_to'        => self::$PRP_CAUS_TO,
            'sanitary_id'    => self::$PRP_SANITARY_ID,
            'caus_desc'      => self::$PRP_CAUS_DESC,
            'caus_where'     => self::$PRP_CAUS_WHERE,
            'caus_care'      => self::$PRP_CAUS_CARE,
            'caus_care_desc' => self::$PRP_CAUS_CARE_DESC
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_sickness';
    }
}
