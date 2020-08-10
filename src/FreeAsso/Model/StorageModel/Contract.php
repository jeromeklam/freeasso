<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Contract
 *
 * @author jeromeklam
 */
abstract class Contract extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_CT_ID = [
        FFCST::PROPERTY_PRIVATE => 'ct_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_CT_CODE = [
        FFCST::PROPERTY_PRIVATE => 'ct_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 20,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['site_id' => 
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'site_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CT_FROM = [
        FFCST::PROPERTY_PRIVATE => 'ct_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_TO = [
        FFCST::PROPERTY_PRIVATE => 'ct_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_DURATION = [
        FFCST::PROPERTY_PRIVATE => 'ct_duration',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 20,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_INSTALL_AMOUNT = [
        FFCST::PROPERTY_PRIVATE => 'ct_install_amount',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_RECUR_AMOUNT = [
        FFCST::PROPERTY_PRIVATE => 'ct_recur_amount',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_ADDRESS_1 = [
        FFCST::PROPERTY_PRIVATE => 'ct_address_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_ADDRESS_2 = [
        FFCST::PROPERTY_PRIVATE => 'ct_address_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_ADDRESS_3 = [
        FFCST::PROPERTY_PRIVATE => 'ct_address_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_CP = [
        FFCST::PROPERTY_PRIVATE => 'ct_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 20,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CT_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'ct_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CNTY_ID = [
        FFCST::PROPERTY_PRIVATE => 'cnty_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['cnty_id' => 
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'cnty_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CTX1_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'ctx1_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['ctx1_cli_id' => 
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'ctx1_cli_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_CTX2_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'ctx2_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['ctx2_cli_id' => 
            [
                FFCST::FOREIGN_MODEL => 'NS::Model::ModelName',
                FFCST::FOREIGN_FIELD => 'ctx2_cli_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'ct_id'             => self::$PRP_CT_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'ct_code'           => self::$PRP_CT_CODE,
            'site_id'           => self::$PRP_SITE_ID,
            'ct_from'           => self::$PRP_CT_FROM,
            'ct_to'             => self::$PRP_CT_TO,
            'ct_duration'       => self::$PRP_CT_DURATION,
            'ct_install_amount' => self::$PRP_CT_INSTALL_AMOUNT,
            'ct_recur_amount'   => self::$PRP_CT_RECUR_AMOUNT,
            'ct_address_1'      => self::$PRP_CT_ADDRESS_1,
            'ct_address_2'      => self::$PRP_CT_ADDRESS_2,
            'ct_address_3'      => self::$PRP_CT_ADDRESS_3,
            'ct_cp'             => self::$PRP_CT_CP,
            'ct_town'           => self::$PRP_CT_TOWN,
            'cnty_id'           => self::$PRP_CNTY_ID,
            'ctx1_cli_id'       => self::$PRP_CTX1_CLI_ID,
            'ctx2_cli_id'       => self::$PRP_CTX2_CLI_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_contract';
    }

    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return '';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return '';
    }
}
