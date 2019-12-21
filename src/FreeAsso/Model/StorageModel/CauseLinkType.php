<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseLinkType
 *
 * @author jeromeklam
 */
abstract class CauseLinkType extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAULT_ID = [
        FFCST::PROPERTY_PRIVATE => 'cault_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_CAULT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'cault_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_REF_CAULT_ID = [
        FFCST::PROPERTY_PRIVATE => 'ref_cault_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAULT_FAMILY = [
        FFCST::PROPERTY_PRIVATE => 'cault_family',
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
            'cault_id'     => self::$PRP_CAULT_ID,
            'cault_name'   => self::$PRP_CAULT_NAME,
            'ref_cault_id' => self::$PRP_REF_CAULT_ID,
            'brk_id'       => self::$PRP_BRK_ID,
            'cault_family' => self::$PRP_CAULT_FAMILY
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_link_type';
    }
}
