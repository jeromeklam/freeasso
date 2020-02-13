<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Sickness
 *
 * @author jeromeklam
 */
abstract class Sickness extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SICK_ID = [
        FFCST::PROPERTY_PRIVATE => 'sick_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_SICK_NAME = [
        FFCST::PROPERTY_PRIVATE => 'sick_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SICK_DESC = [
        FFCST::PROPERTY_PRIVATE => 'sick_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SICK_DURATION = [
        FFCST::PROPERTY_PRIVATE => 'sick_duration',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SICK_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'sick_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SICK_FREQ = [
        FFCST::PROPERTY_PRIVATE => 'sick_freq',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SICK_SPREAD = [
        FFCST::PROPERTY_PRIVATE => 'sick_spread',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
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
            'sick_id'       => self::$PRP_SICK_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'sick_name'     => self::$PRP_SICK_NAME,
            'sick_desc'     => self::$PRP_SICK_DESC,
            'sick_duration' => self::$PRP_SICK_DURATION,
            'sick_type'     => self::$PRP_SICK_TYPE,
            'sick_freq'     => self::$PRP_SICK_FREQ,
            'sick_spread'   => self::$PRP_SICK_SPREAD
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_sickness';
    }
}
