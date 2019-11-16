<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Cause
 *
 * @author jeromeklam
 */
abstract class Cause extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAUT_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause_type' => 
            [
                'model' => 'FreeAsso::Model::CauseType',
                'field' => 'caut_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_NAME = [
        FFCST::PROPERTY_PRIVATE => 'cau_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_DESC = [
        FFCST::PROPERTY_PRIVATE => 'cau_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_FROM = [
        FFCST::PROPERTY_PRIVATE => 'cau_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_TO = [
        FFCST::PROPERTY_PRIVATE => 'cau_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_PUBLIC = [
        FFCST::PROPERTY_PRIVATE => 'cau_public',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cau_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_CODE = [
        FFCST::PROPERTY_PRIVATE => 'cau_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_FAMILY = [
        FFCST::PROPERTY_PRIVATE => 'cau_family',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
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
            'cau_id'     => self::$PRP_CAU_ID,
            'brk_id'     => self::$PRP_BRK_ID,
            'caut_id'    => self::$PRP_CAUT_ID,
            'cau_name'   => self::$PRP_CAU_NAME,
            'cau_desc'   => self::$PRP_CAU_DESC,
            'cau_from'   => self::$PRP_CAU_FROM,
            'cau_to'     => self::$PRP_CAU_TO,
            'cau_public' => self::$PRP_CAU_PUBLIC,
            'site_id'    => self::$PRP_SITE_ID,
            'cau_mnt'    => self::$PRP_CAU_MNT,
            'cau_code'   => self::$PRP_CAU_CODE,
            'cau_family' => self::$PRP_CAU_FAMILY
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause';
    }
}
