<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseType
 *
 * @author jeromeklam
 */
abstract class CauseType extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAUT_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAMT_ID = [
        FFCST::PROPERTY_PRIVATE => 'camt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause_main_type' =>
            [
                'model' => 'FreeAsso::Model::CauseMainType',
                'field' => 'camt_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'caut_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_PATTERN = [
        FFCST::PROPERTY_PRIVATE => 'caut_pattern',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_MASK = [
        FFCST::PROPERTY_PRIVATE => 'caut_mask',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_RECEIPT = [
        FFCST::PROPERTY_PRIVATE => 'caut_receipt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_MAX_MNT = [
        FFCST::PROPERTY_PRIVATE => 'caut_max_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MONETARY,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_MIN_MNT = [
        FFCST::PROPERTY_PRIVATE => 'caut_min_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MONETARY,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'caut_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_MNT_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'caut_mnt_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_CERTIFICAT = [
        FFCST::PROPERTY_PRIVATE => 'caut_certificat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_DONATION = [
        FFCST::PROPERTY_PRIVATE => 'caut_donation',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_ONCE_DURATION = [
        FFCST::PROPERTY_PRIVATE => 'caut_once_duration',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_REGULAR_DURATION = [
        FFCST::PROPERTY_PRIVATE => 'caut_regular_duration',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_NEWS = [
        FFCST::PROPERTY_PRIVATE => 'caut_news',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_FAMILY = [
        FFCST::PROPERTY_PRIVATE => 'caut_family',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => 'ANIMAL',
        FFCST::PROPERTY_ENUM    => ['OTHER','NONE','ANIMAL','FOREST','NATURE','ADMINISTRATIV'],
    ];
    protected static $PRP_CAUT_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'caut_string_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'caut_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'caut_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'caut_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'caut_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'caut_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'caut_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'caut_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'caut_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'caut_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'caut_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'caut_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'caut_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'caut_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'caut_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'caut_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'caut_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'caut_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'caut_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'caut_bool_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUT_MAX_WEIGHT = [
        FFCST::PROPERTY_PRIVATE => 'caut_max_weight',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_MAX_HEIGHT = [
        FFCST::PROPERTY_PRIVATE => 'caut_max_height',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_GROWTH_FREQ = [
        FFCST::PROPERTY_PRIVATE => 'caut_growth_freq',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_GROWTH_GRAPH = [
        FFCST::PROPERTY_PRIVATE => 'caut_growth_graph',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUT_REC_EDI_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_rec_edi_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['receipt_edition' =>
            [
                'model' => 'FreeFW::Model::Edition',
                'field' => 'edi_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUT_CERT_EDI_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_cert_edi_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['certificate_edition' =>
            [
                'model' => 'FreeFW::Model::Edition',
                'field' => 'edi_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUT_IDENT_EDI_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_ident_edi_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['identity_edition' =>
            [
                'model' => 'FreeFW::Model::Edition',
                'field' => 'edi_id',
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
            'caut_id'               => self::$PRP_CAUT_ID,
            'brk_id'                => self::$PRP_BRK_ID,
            'camt_id'               => self::$PRP_CAMT_ID,
            'caut_name'             => self::$PRP_CAUT_NAME,
            'caut_pattern'          => self::$PRP_CAUT_PATTERN,
            'caut_mask'             => self::$PRP_CAUT_MASK,
            'caut_receipt'          => self::$PRP_CAUT_RECEIPT,
            'caut_max_mnt'          => self::$PRP_CAUT_MAX_MNT,
            'caut_min_mnt'          => self::$PRP_CAUT_MIN_MNT,
            'caut_mnt_type'         => self::$PRP_CAUT_MNT_TYPE,
            'caut_money'            => self::$PRP_CAUT_MONEY,
            'caut_certificat'       => self::$PRP_CAUT_CERTIFICAT,
            'caut_donation'         => self::$PRP_CAUT_DONATION,
            'caut_once_duration'    => self::$PRP_CAUT_ONCE_DURATION,
            'caut_regular_duration' => self::$PRP_CAUT_REGULAR_DURATION,
            'caut_news'             => self::$PRP_CAUT_NEWS,
            'caut_family'           => self::$PRP_CAUT_FAMILY,
            'caut_string_1'         => self::$PRP_CAUT_STRING_1,
            'caut_string_2'         => self::$PRP_CAUT_STRING_2,
            'caut_string_3'         => self::$PRP_CAUT_STRING_3,
            'caut_string_4'         => self::$PRP_CAUT_STRING_4,
            'caut_number_1'         => self::$PRP_CAUT_NUMBER_1,
            'caut_number_2'         => self::$PRP_CAUT_NUMBER_2,
            'caut_number_3'         => self::$PRP_CAUT_NUMBER_3,
            'caut_number_4'         => self::$PRP_CAUT_NUMBER_4,
            'caut_date_1'           => self::$PRP_CAUT_DATE_1,
            'caut_date_2'           => self::$PRP_CAUT_DATE_2,
            'caut_date_3'           => self::$PRP_CAUT_DATE_3,
            'caut_date_4'           => self::$PRP_CAUT_DATE_4,
            'caut_text_1'           => self::$PRP_CAUT_TEXT_1,
            'caut_text_2'           => self::$PRP_CAUT_TEXT_2,
            'caut_text_3'           => self::$PRP_CAUT_TEXT_3,
            'caut_text_4'           => self::$PRP_CAUT_TEXT_4,
            'caut_bool_1'           => self::$PRP_CAUT_BOOL_1,
            'caut_bool_2'           => self::$PRP_CAUT_BOOL_2,
            'caut_bool_3'           => self::$PRP_CAUT_BOOL_3,
            'caut_bool_4'           => self::$PRP_CAUT_BOOL_4,
            'caut_max_weight'       => self::$PRP_CAUT_MAX_WEIGHT,
            'caut_max_height'       => self::$PRP_CAUT_MAX_HEIGHT,
            'caut_growth_freq'      => self::$PRP_CAUT_GROWTH_FREQ,
            'caut_growth_graph'     => self::$PRP_CAUT_GROWTH_GRAPH,
            'caut_rec_edi_id'       => self::$PRP_CAUT_REC_EDI_ID,
            'caut_cert_edi_id'      => self::$PRP_CAUT_CERT_EDI_ID,
            'caut_ident_edi_id'     => self::$PRP_CAUT_IDENT_EDI_ID,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_type';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return 'caut_name';
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
                FFCST::INDEX_FIELDS => ['brk_id', 'caut_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_CAUSE_TYPE_NAME_EXISTS
            ],
        ];
    }
}
