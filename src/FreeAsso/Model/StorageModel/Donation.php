<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Donation
 *
 * @author jeromeklam
 */
abstract class Donation extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_DON_ID = [
        FFCST::PROPERTY_PRIVATE => 'don_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SPO_ID = [
        FFCST::PROPERTY_PRIVATE => 'spo_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['sponsorship' =>
            [
                'model' => 'FreeAsso::Model::Sponsorship',
                'field' => 'spo_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_DESC = [
        FFCST::PROPERTY_PRIVATE => 'don_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'don_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_MNT = [
        FFCST::PROPERTY_PRIVATE => 'don_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_ID = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['payment_type' =>
            [
                'model' => 'FreeAsso::Model::PaymentType',
                'field' => 'ptyp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_COMMENT = [
        FFCST::PROPERTY_PRIVATE => 'don_comment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_DSTAT = [
        FFCST::PROPERTY_PRIVATE => 'don_dstat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_ID = [
        FFCST::PROPERTY_PRIVATE => 'rec_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_ID = [
        FFCST::PROPERTY_PRIVATE => 'cert_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_SPONSORS = [
        FFCST::PROPERTY_PRIVATE => 'don_sponsors',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_DISPLAY_SITE = [
        FFCST::PROPERTY_PRIVATE => 'don_display_site',
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
            'don_id'           => self::$PRP_DON_ID,
            'brk_id'           => self::$PRP_BRK_ID,
            'cli_id'           => self::$PRP_CLI_ID,
            'cau_id'           => self::$PRP_CAU_ID,
            'spo_id'           => self::$PRP_SPO_ID,
            'don_desc'         => self::$PRP_DON_DESC,
            'don_ts'           => self::$PRP_DON_TS,
            'don_status'       => self::$PRP_DON_STATUS,
            'don_mnt'          => self::$PRP_DON_MNT,
            'ptyp_id'          => self::$PRP_PTYP_ID,
            'don_comment'      => self::$PRP_DON_COMMENT,
            'don_dstat'        => self::$PRP_DON_DSTAT,
            'rec_id'           => self::$PRP_REC_ID,
            'cert_id'          => self::$PRP_CERT_ID,
            'don_sponsors'     => self::$PRP_DON_SPONSORS,
            'don_display_site' => self::$PRP_DON_DISPLAY_SITE
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_donation';
    }
}
