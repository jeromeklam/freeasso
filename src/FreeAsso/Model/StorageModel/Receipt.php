<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Receipt
 *
 * @author jeromeklam
 */
abstract class Receipt extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_REC_ID = [
        FFCST::PROPERTY_PRIVATE => 'rec_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_RETT_ID = [
        FFCST::PROPERTY_PRIVATE => 'rett_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['receipt_type' =>
            [
                'model' => 'FreeAsso::Model::ReceiptType',
                'field' => 'rett_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_REC_MODE = [
        FFCST::PROPERTY_PRIVATE => 'rec_mode',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_REC_TS = [
        FFCST::PROPERTY_PRIVATE => 'rec_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_REC_GEN_TS = [
        FFCST::PROPERTY_PRIVATE => 'rec_gen_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_PRINT_TS = [
        FFCST::PROPERTY_PRIVATE => 'rec_print_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'rec_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_NUMBER = [
        FFCST::PROPERTY_PRIVATE => 'rec_number',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_MNT = [
        FFCST::PROPERTY_PRIVATE => 'rec_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_REC_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'rec_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_REC_FULLNAME = [
        FFCST::PROPERTY_PRIVATE => 'rec_fullname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'rec_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'rec_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'rec_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_CP = [
        FFCST::PROPERTY_PRIVATE => 'rec_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'rec_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CNTY_ID = [
        FFCST::PROPERTY_PRIVATE => 'cnty_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['country' =>
            [
                'model' => 'FreeFW::Model::Country',
                'field' => 'cnty_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['lang' =>
            [
                'model' => 'FreeFW::Model::Lang',
                'field' => 'lang_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_REC_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'rec_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_REC_SEND_METHOD = [
        FFCST::PROPERTY_PRIVATE => 'rec_send_method',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['EMAIL','MANUAL','UNKNOWN'],
        FFCST::PROPERTY_DEFAULT => 'EMAIL',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_REC_MNT_LETTER = [
        FFCST::PROPERTY_PRIVATE => 'rec_mnt_letter',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_FILE_ID = [
        FFCST::PROPERTY_PRIVATE => 'file_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['file' =>
            [
                'model' => 'FreeAsso::Model::File',
                'field' => 'file_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
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
            'rec_id'          => self::$PRP_REC_ID,
            'brk_id'          => self::$PRP_BRK_ID,
            'cli_id'          => self::$PRP_CLI_ID,
            'rett_id'         => self::$PRP_RETT_ID,
            'rec_mode'        => self::$PRP_REC_MODE,
            'rec_ts'          => self::$PRP_REC_TS,
            'rec_gen_ts'      => self::$PRP_REC_GEN_TS,
            'rec_print_ts'    => self::$PRP_REC_PRINT_TS,
            'rec_year'        => self::$PRP_REC_YEAR,
            'rec_number'      => self::$PRP_REC_NUMBER,
            'rec_mnt'         => self::$PRP_REC_MNT,
            'rec_money'       => self::$PRP_REC_MONEY,
            'rec_fullname'    => self::$PRP_REC_FULLNAME,
            'rec_address1'    => self::$PRP_REC_ADDRESS1,
            'rec_address2'    => self::$PRP_REC_ADDRESS2,
            'rec_address3'    => self::$PRP_REC_ADDRESS3,
            'rec_cp'          => self::$PRP_REC_CP,
            'rec_town'        => self::$PRP_REC_TOWN,
            'cnty_id'         => self::$PRP_CNTY_ID,
            'lang_id'         => self::$PRP_LANG_ID,
            'rec_email'       => self::$PRP_REC_EMAIL,
            'rec_send_method' => self::$PRP_REC_SEND_METHOD,
            'rec_mnt_letter'  => self::$PRP_REC_MNT_LETTER,
            'file_id'         => self::$PRP_FILE_ID,
            'grp_id'          => self::$PRP_GRP_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_receipt';
    }
}
