<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptDonation
 *
 * @author jeromeklam
 */
abstract class ReceiptDonation extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_RDO_ID = [
        FFCST::PROPERTY_PRIVATE => 'rdo_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_REC_ID = [
        FFCST::PROPERTY_PRIVATE => 'rec_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['receipt' =>
            [
                'model' => 'FreeAsso::Model::Receipt',
                'field' => 'rec_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_ID = [
        FFCST::PROPERTY_PRIVATE => 'don_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['donation' =>
            [
                'model' => 'FreeAsso::Model::Donation',
                'field' => 'don_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_RDO_DESC = [
        FFCST::PROPERTY_PRIVATE => 'rdo_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_RDO_TS = [
        FFCST::PROPERTY_PRIVATE => 'rdo_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_RDO_MNT = [
        FFCST::PROPERTY_PRIVATE => 'rdo_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_RDO_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'rdo_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_PTYP_ID = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['payment_type' =>
            [
                'model' => 'FreeAsso::Model::PaymentType',
                'field' => 'ptyp_id',
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
            'rdo_id'    => self::$PRP_RDO_ID,
            'brk_id'    => self::$PRP_BRK_ID,
            'rec_id'    => self::$PRP_REC_ID,
            'don_id'    => self::$PRP_DON_ID,
            'rdo_desc'  => self::$PRP_RDO_DESC,
            'rdo_ts'    => self::$PRP_RDO_TS,
            'rdo_mnt'   => self::$PRP_RDO_MNT,
            'rdo_money' => self::$PRP_RDO_MONEY,
            'ptyp_id'   => self::$PRP_PTYP_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_receipt_donation';
    }
}
