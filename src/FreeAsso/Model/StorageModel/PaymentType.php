<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * PaymentType
 *
 * @author jeromeklam
 */
abstract class PaymentType extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_PTYP_ID = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_PTYP_CODE = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_NAME = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_PTYP_NAME_EN = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_name_en',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_PTYP_FROM = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_TO = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_ACCOUNTING = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_accounting',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_RESTRICTION = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_restriction',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['NONE','ONCE','REGULAR'],
        FFCST::PROPERTY_DEFAULT => 'NONE',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['CHECK','BANK','CASH','NATURE', 'OTHER'],
        FFCST::PROPERTY_DEFAULT => 'OTHER',
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
            'ptyp_id'          => self::$PRP_PTYP_ID,
            'brk_id'           => self::$PRP_BRK_ID,
            'ptyp_code'        => self::$PRP_PTYP_CODE,
            'ptyp_name'        => self::$PRP_PTYP_NAME,
            'ptyp_name_en'     => self::$PRP_PTYP_NAME_EN,
            'ptyp_receipt'     => self::$PRP_PTYP_RECEIPT,
            'ptyp_from'        => self::$PRP_PTYP_FROM,
            'ptyp_to'          => self::$PRP_PTYP_TO,
            'ptyp_accounting'  => self::$PRP_PTYP_ACCOUNTING,
            'ptyp_restriction' => self::$PRP_PTYP_RESTRICTION,
            'ptyp_type'        => self::$PRP_PTYP_TYPE,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_payment_type';
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
                FFCST::INDEX_FIELDS => ['brk_id', 'ptyp_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_PAYMENT_TYPE_NAME_EXISTS
            ],
        ];
    }
}
