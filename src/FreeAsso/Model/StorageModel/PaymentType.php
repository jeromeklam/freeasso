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
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_PTYP_FROM = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_TO = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
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
            'ptyp_id'      => self::$PRP_PTYP_ID,
            'brk_id'       => self::$PRP_BRK_ID,
            'ptyp_code'    => self::$PRP_PTYP_CODE,
            'ptyp_name'    => self::$PRP_PTYP_NAME,
            'ptyp_receipt' => self::$PRP_PTYP_RECEIPT,
            'ptyp_from'    => self::$PRP_PTYP_FROM,
            'ptyp_to'      => self::$PRP_PTYP_TO
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
}
