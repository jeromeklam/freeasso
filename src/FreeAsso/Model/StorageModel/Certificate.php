<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Certificate
 *
 * @author jeromeklam
 */
abstract class Certificate extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CERT_ID = [
        FFCST::PROPERTY_PRIVATE => 'cert_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CERT_TS = [
        FFCST::PROPERTY_PRIVATE => 'cert_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
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
    protected static $PRP_CERT_GEN_TS = [
        FFCST::PROPERTY_PRIVATE => 'cert_gen_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_PRINT_TS = [
        FFCST::PROPERTY_PRIVATE => 'cert_print_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_FULLNAME = [
        FFCST::PROPERTY_PRIVATE => 'cert_fullname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'cert_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'cert_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'cert_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_CP = [
        FFCST::PROPERTY_PRIVATE => 'cert_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'cert_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
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
    protected static $PRP_CERT_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'cert_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_INPUT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cert_input_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_INPUT_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'cert_input_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_OUTPUT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cert_output_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_OUTPUT_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'cert_output_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_COMMENT = [
        FFCST::PROPERTY_PRIVATE => 'cert_comment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_DATA1 = [
        FFCST::PROPERTY_PRIVATE => 'cert_data1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_DATA2 = [
        FFCST::PROPERTY_PRIVATE => 'cert_data2',
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
    protected static $PRP_CERT_UNIT_UNIT = [
        FFCST::PROPERTY_PRIVATE => 'cert_unit_unit',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_UNIT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cert_unit_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MONETARY,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CERT_UNIT_BASE = [
        FFCST::PROPERTY_PRIVATE => 'cert_unit_base',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
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
            'cert_id'           => self::$PRP_CERT_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'cert_ts'           => self::$PRP_CERT_TS,
            'cli_id'            => self::$PRP_CLI_ID,
            'cert_gen_ts'       => self::$PRP_CERT_GEN_TS,
            'cert_print_ts'     => self::$PRP_CERT_PRINT_TS,
            'cert_fullname'     => self::$PRP_CERT_FULLNAME,
            'cert_address1'     => self::$PRP_CERT_ADDRESS1,
            'cert_address2'     => self::$PRP_CERT_ADDRESS2,
            'cert_address3'     => self::$PRP_CERT_ADDRESS3,
            'cert_cp'           => self::$PRP_CERT_CP,
            'cert_town'         => self::$PRP_CERT_TOWN,
            'lang_id'           => self::$PRP_LANG_ID,
            'cnty_id'           => self::$PRP_CNTY_ID,
            'cert_email'        => self::$PRP_CERT_EMAIL,
            'cert_input_mnt'    => self::$PRP_CERT_INPUT_MNT,
            'cert_input_money'  => self::$PRP_CERT_INPUT_MONEY,
            'cert_output_mnt'   => self::$PRP_CERT_OUTPUT_MNT,
            'cert_output_money' => self::$PRP_CERT_OUTPUT_MONEY,
            'cert_comment'      => self::$PRP_CERT_COMMENT,
            'cert_data1'        => self::$PRP_CERT_DATA1,
            'cert_data2'        => self::$PRP_CERT_DATA2,
            'file_id'           => self::$PRP_FILE_ID,
            'cert_unit_unit'    => self::$PRP_CERT_UNIT_UNIT,
            'cert_unit_mnt'     => self::$PRP_CERT_UNIT_MNT,
            'cert_unit_base'    => self::$PRP_CERT_UNIT_BASE,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_certificate';
    }
}
