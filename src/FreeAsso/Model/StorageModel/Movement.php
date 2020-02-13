<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Movement
 *
 * @author jeromeklam
 */
abstract class Movement extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_MOVE_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_MOVE_FROM = [
        FFCST::PROPERTY_PRIVATE => 'move_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO = [
        FFCST::PROPERTY_PRIVATE => 'move_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_FROM_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_from_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TO_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_to_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
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
            'move_id'      => self::$PRP_MOVE_ID,
            'brk_id'       => self::$PRP_BRK_ID,
            'move_from'    => self::$PRP_MOVE_FROM,
            'move_to'      => self::$PRP_MOVE_TO,
            'site_from_id' => self::$PRP_SITE_FROM_ID,
            'site_to_id'   => self::$PRP_SITE_TO_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_movement';
    }
}
