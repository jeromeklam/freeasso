<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * SiteTypeData
 *
 * @author jeromeklam
 */
abstract class SiteTypeData extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SITTD_ID = [
        FFCST::PROPERTY_PRIVATE => 'sittd_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_SITT_ID = [
        FFCST::PROPERTY_PRIVATE => 'sitt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['site_type' =>
            [
                'model' => 'FreeAsso::Model::SiteType',
                'field' => 'sitt_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DATA_ID = [
        FFCST::PROPERTY_PRIVATE => 'data_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['data' =>
            [
                'model' => 'FreeAsso::Model::Data',
                'field' => 'data_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITTD_VALUE = [
        FFCST::PROPERTY_PRIVATE => 'sittd_value',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITTD_POSITION = [
        FFCST::PROPERTY_PRIVATE => 'sittd_position',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITTD_FROM = [
        FFCST::PROPERTY_PRIVATE => 'sittd_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITTD_TO = [
        FFCST::PROPERTY_PRIVATE => 'sittd_to',
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
            'sittd_id'       => self::$PRP_SITTD_ID,
            'sitt_id'        => self::$PRP_SITT_ID,
            'data_id'        => self::$PRP_DATA_ID,
            'sittd_value'    => self::$PRP_SITTD_VALUE,
            'sittd_position' => self::$PRP_SITTD_POSITION,
            'sittd_from'     => self::$PRP_SITTD_FROM,
            'sittd_to'       => self::$PRP_SITTD_TO
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_site_type_data';
    }
}
