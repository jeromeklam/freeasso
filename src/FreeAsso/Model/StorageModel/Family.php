<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Family
 *
 * @author jeromeklam
 */
abstract class Family extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_FAM_ID = [
        FFCST::PROPERTY_PRIVATE => 'fam_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_FAM_NAME = [
        FFCST::PROPERTY_PRIVATE => 'fam_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_FAM_DESC = [
        FFCST::PROPERTY_PRIVATE => 'fam_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_FAM_PARENT_ID = [
        FFCST::PROPERTY_PRIVATE => 'fam_parent_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK, FFCST::OPTION_NESTED_PARENT_ID],
        FFCST::PROPERTY_FK      => ['parent' =>
            [
                'model' => 'FreeAsso::Model::Family',
                'field' => 'fam_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_FAM_POSITION = [
        FFCST::PROPERTY_PRIVATE => 'fam_position',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_NESTED_POSITION],
    ];
    protected static $PRP_FAM_LEFT = [
        FFCST::PROPERTY_PRIVATE => 'fam_left',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_NESTED_LEFT]
    ];
    protected static $PRP_FAM_RIGHT = [
        FFCST::PROPERTY_PRIVATE => 'fam_right',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_NESTED_RIGHT]
    ];
    protected static $PRP_FAM_LEVEL = [
        FFCST::PROPERTY_PRIVATE => 'fam_level',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_NESTED_LEVEL]
    ];
    protected static $PRP_FAM_CODE_INT = [
        FFCST::PROPERTY_PRIVATE => 'fam_code_int',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'fam_id'        => self::$PRP_FAM_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'fam_name'      => self::$PRP_FAM_NAME,
            'fam_desc'      => self::$PRP_FAM_DESC,
            'fam_parent_id' => self::$PRP_FAM_PARENT_ID,
            'fam_position'  => self::$PRP_FAM_POSITION,
            'fam_left'      => self::$PRP_FAM_LEFT,
            'fam_right'     => self::$PRP_FAM_RIGHT,
            'fam_level'     => self::$PRP_FAM_LEVEL,
            'fam_code_int'  => self::$PRP_FAM_CODE_INT
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sto_family';
    }
}
