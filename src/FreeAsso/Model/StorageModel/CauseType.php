<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseType
 *
 * @author jeromeklam
 */
abstract class CauseType extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAUT_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::PROPERTY_BROKER]
    ];
    protected static $PRP_CAUT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'caut_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'caut_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_MAX_MNT = [
        FFCST::PROPERTY_PRIVATE => 'caut_max_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_MIN_MNT = [
        FFCST::PROPERTY_PRIVATE => 'caut_min_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_MNT_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'caut_mnt_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_CERTIFICAT = [
        FFCST::PROPERTY_PRIVATE => 'caut_certificat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
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
            'caut_id'         => self::$PRP_CAUT_ID,
            'brk_id'          => self::$PRP_BRK_ID,
            'caut_name'       => self::$PRP_CAUT_NAME,
            'caut_receipt'    => self::$PRP_CAUT_RECEIPT,
            'caut_max_mnt'    => self::$PRP_CAUT_MAX_MNT,
            'caut_min_mnt'    => self::$PRP_CAUT_MIN_MNT,
            'caut_mnt_type'   => self::$PRP_CAUT_MNT_TYPE,
            'caut_certificat' => self::$PRP_CAUT_CERTIFICAT
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_type';
    }
}
