<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseMainType
 *
 * @author jeromeklam
 */
abstract class CauseMainType extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAMT_ID = [
        FFCST::PROPERTY_PRIVATE => 'camt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAMT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'camt_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_MERGE   => 'Espèce',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAMT_FAMILY = [
        FFCST::PROPERTY_PRIVATE => 'camt_family',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => 'ANIMAL',
        FFCST::PROPERTY_ENUM    => ['OTHER','NONE','ANIMAL','FOREST','NATURE','ADMINISTRATIV'],
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'camt_id'     => self::$PRP_CAMT_ID,
            'brk_id'      => self::$PRP_BRK_ID,
            'camt_name'   => self::$PRP_CAMT_NAME,
            'camt_family' => self::$PRP_CAMT_FAMILY,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_main_type';
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
                FFCST::INDEX_FIELDS => ['brk_id', 'camt_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_CAUSE_MAIN_TYPE_NAME_EXISTS
            ],
        ];
    }
}
