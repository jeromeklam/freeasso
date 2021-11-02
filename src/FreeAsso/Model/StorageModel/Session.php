<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Session
 *
 * @author jeromeklam
 */
abstract class Session extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SESS_ID = [
        FFCST::PROPERTY_PRIVATE => 'sess_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_SESS_NAME = [
        FFCST::PROPERTY_PRIVATE => 'sess_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_EXERCICE = [
        FFCST::PROPERTY_PRIVATE => 'sess_exercice',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'sess_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'sess_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'sess_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SESS_MONTH = [
        FFCST::PROPERTY_PRIVATE => 'sess_month',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
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
            'sess_id'       => self::$PRP_SESS_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'sess_name'     => self::$PRP_SESS_NAME,
            'sess_exercice' => self::$PRP_SESS_EXERCICE,
            'sess_status'   => self::$PRP_SESS_STATUS,
            'sess_type'     => self::$PRP_SESS_TYPE,
            'sess_year'     => self::$PRP_SESS_YEAR,
            'sess_month'    => self::$PRP_SESS_MONTH,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_session';
    }

    /**
     * Composed index
     *
     * @return string[][]|number[][]
     */
    public static function getUniqIndexes()
    {
        return [
            'name' => [
                FFCST::INDEX_FIELDS => ['brk_id', 'sess_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_SESSION_NAME_EXISTS
            ]
        ];
    }
}
