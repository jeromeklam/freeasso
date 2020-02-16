<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Item
 *
 * @author jeromeklam
 */
abstract class Item extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_ITEM_ID = [
        FFCST::PROPERTY_PRIVATE => 'item_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_ITEM_NAME = [
        FFCST::PROPERTY_PRIVATE => 'item_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_CODE = [
        FFCST::PROPERTY_PRIVATE => 'item_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_BARCODE = [
        FFCST::PROPERTY_PRIVATE => 'item_barcode',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_FROM = [
        FFCST::PROPERTY_PRIVATE => 'item_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_TO = [
        FFCST::PROPERTY_PRIVATE => 'item_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_DESC = [
        FFCST::PROPERTY_PRIVATE => 'item_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_STOCK = [
        FFCST::PROPERTY_PRIVATE => 'item_stock',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_ITEM_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'item_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_ITEM_MARK = [
        FFCST::PROPERTY_PRIVATE => 'item_mark',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_COLOR = [
        FFCST::PROPERTY_PRIVATE => 'item_color',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_WEIGHT = [
        FFCST::PROPERTY_PRIVATE => 'item_weight',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_WIDTH = [
        FFCST::PROPERTY_PRIVATE => 'item_width',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_HEIGHT = [
        FFCST::PROPERTY_PRIVATE => 'item_height',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_DEPTH = [
        FFCST::PROPERTY_PRIVATE => 'item_depth',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_DANGEROUS = [
        FFCST::PROPERTY_PRIVATE => 'item_dangerous',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_ITEM_QTE = [
        FFCST::PROPERTY_PRIVATE => 'item_qte',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_MIN_QTE = [
        FFCST::PROPERTY_PRIVATE => 'item_min_qte',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_DISPOSITION = [
        FFCST::PROPERTY_PRIVATE => 'item_disposition',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_STO_UNIT_ID = [
        FFCST::PROPERTY_PRIVATE => 'item_sto_unit_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['stock_unit' =>
            [
                'model' => 'FreeAsso::Model::Unit',
                'field' => 'unit_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_ITEM_STO_QTE = [
        FFCST::PROPERTY_PRIVATE => 'item_sto_qte',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_ITEM_CONTENT_UNIT_ID = [
        FFCST::PROPERTY_PRIVATE => 'item_content_unit_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['content_unit' =>
            [
                'model' => 'FreeAsso::Model::Unit',
                'field' => 'unit_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_ITEM_CONTENT_QTE = [
        FFCST::PROPERTY_PRIVATE => 'item_content_qte',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_FAM_ID = [
        FFCST::PROPERTY_PRIVATE => 'fam_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['family' =>
            [
                'model' => 'FreeAsso::Model::Family',
                'field' => 'fam_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_ITEM_ORDER = [
        FFCST::PROPERTY_PRIVATE => 'item_order',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DEFAULT_PROVIDER_ID = [
        FFCST::PROPERTY_PRIVATE => 'default_provider_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['default_provider' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
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
            'item_id'              => self::$PRP_ITEM_ID,
            'brk_id'               => self::$PRP_BRK_ID,
            'item_name'            => self::$PRP_ITEM_NAME,
            'item_code'            => self::$PRP_ITEM_CODE,
            'item_barcode'         => self::$PRP_ITEM_BARCODE,
            'item_from'            => self::$PRP_ITEM_FROM,
            'item_to'              => self::$PRP_ITEM_TO,
            'item_desc'            => self::$PRP_ITEM_DESC,
            'item_stock'           => self::$PRP_ITEM_STOCK,
            'item_type'            => self::$PRP_ITEM_TYPE,
            'item_mark'            => self::$PRP_ITEM_MARK,
            'item_color'           => self::$PRP_ITEM_COLOR,
            'item_weight'          => self::$PRP_ITEM_WEIGHT,
            'item_width'           => self::$PRP_ITEM_WIDTH,
            'item_height'          => self::$PRP_ITEM_HEIGHT,
            'item_depth'           => self::$PRP_ITEM_DEPTH,
            'item_dangerous'       => self::$PRP_ITEM_DANGEROUS,
            'item_qte'             => self::$PRP_ITEM_QTE,
            'item_min_qte'         => self::$PRP_ITEM_MIN_QTE,
            'item_disposition'     => self::$PRP_ITEM_DISPOSITION,
            'item_sto_unit_id'     => self::$PRP_ITEM_STO_UNIT_ID,
            'item_sto_qte'         => self::$PRP_ITEM_STO_QTE,
            'item_content_unit_id' => self::$PRP_ITEM_CONTENT_UNIT_ID,
            'item_content_qte'     => self::$PRP_ITEM_CONTENT_QTE,
            'fam_id'               => self::$PRP_FAM_ID,
            'item_order'           => self::$PRP_ITEM_ORDER,
            'default_provider_id'  => self::$PRP_DEFAULT_PROVIDER_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sto_item';
    }
}
