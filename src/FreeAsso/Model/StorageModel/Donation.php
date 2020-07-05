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
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_GROUP]
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
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_ASK_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_ask_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_REAL_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_real_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_END_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_end_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
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
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'don_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_MNT_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'don_mnt_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_MONEY_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'don_money_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
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
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_DSTAT = [
        FFCST::PROPERTY_PRIVATE => 'don_dstat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
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
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['certificate' =>
            [
                'model' => 'FreeAsso::Model::Certificate',
                'field' => 'cert_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_SPONSORS = [
        FFCST::PROPERTY_PRIVATE => 'don_sponsors',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_DISPLAY_SITE = [
        FFCST::PROPERTY_PRIVATE => 'don_display_site',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DONO_ID = [
        FFCST::PROPERTY_PRIVATE => 'dono_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['origin' =>
            [
                'model' => 'FreeAsso::Model::DonationOrigin',
                'field' => 'dono_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SESS_ID = [
        FFCST::PROPERTY_PRIVATE => 'sess_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['session' =>
            [
                'model' => 'FreeAsso::Model::Session',
                'field' => 'sess_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_REAL_TS_YEAR = [
        FFCST::PROPERTY_PRIVATE  => 'don_real_ts_year',
        FFCST::PROPERTY_TYPE     => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS  => [FFCST::OPTION_FUNCTION],
        FFCST::PROPERTY_FUNCTION => [\FreeFW\Storage\Storage::FUNCTION_YEAR => 'don_real_ts']
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
            'grp_id'           => self::$PRP_GRP_ID,
            'cli_id'           => self::$PRP_CLI_ID,
            'cau_id'           => self::$PRP_CAU_ID,
            'spo_id'           => self::$PRP_SPO_ID,
            'don_desc'         => self::$PRP_DON_DESC,
            'don_ts'           => self::$PRP_DON_TS,
            'don_ask_ts'       => self::$PRP_DON_ASK_TS,
            'don_real_ts'      => self::$PRP_DON_REAL_TS,
            'don_end_ts'       => self::$PRP_DON_END_TS,
            'don_status'       => self::$PRP_DON_STATUS,
            'don_mnt'          => self::$PRP_DON_MNT,
            'don_money'        => self::$PRP_DON_MONEY,
            'don_mnt_input'    => self::$PRP_DON_MNT_INPUT,
            'don_money_input'  => self::$PRP_DON_MONEY_INPUT,
            'ptyp_id'          => self::$PRP_PTYP_ID,
            'don_comment'      => self::$PRP_DON_COMMENT,
            'don_dstat'        => self::$PRP_DON_DSTAT,
            'rec_id'           => self::$PRP_REC_ID,
            'cert_id'          => self::$PRP_CERT_ID,
            'don_sponsors'     => self::$PRP_DON_SPONSORS,
            'don_display_site' => self::$PRP_DON_DISPLAY_SITE,
            'dono_id'          => self::$PRP_DONO_ID,
            'sess_id'          => self::$PRP_SESS_ID,
            'don_real_ts_year' => self::$PRP_DON_REAL_TS_YEAR,
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
