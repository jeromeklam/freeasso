<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Movement
 *
 * @author jeromeklam
 */
abstract class Movement extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_MOVE_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_MOVE_FROM_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_from_site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['from_site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_MOVE_TO_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_to_site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['to_site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_MOVE_TR_NAME = [
        FFCST::PROPERTY_PRIVATE => 'move_tr_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TR_NUM = [
        FFCST::PROPERTY_PRIVATE => 'move_tr_num',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TR_NUM2 = [
        FFCST::PROPERTY_PRIVATE => 'move_tr_num2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM = [
        FFCST::PROPERTY_PRIVATE => 'move_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_MOVE_FROM_EMPTY = [
        FFCST::PROPERTY_PRIVATE => 'move_from_empty',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'move_from_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'OTHER',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_from_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['from_client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_MOVE_FROM_NUM = [
        FFCST::PROPERTY_PRIVATE => 'move_from_num',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NAME = [
        FFCST::PROPERTY_PRIVATE => 'move_from_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_ADDRESS = [
        FFCST::PROPERTY_PRIVATE => 'move_from_address',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_CP = [
        FFCST::PROPERTY_PRIVATE => 'move_from_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'move_from_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'move_from_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'move_from_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'move_from_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'move_from_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NUMBER_5 = [
        FFCST::PROPERTY_PRIVATE => 'move_from_number_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_FROM_NUMBER_6 = [
        FFCST::PROPERTY_PRIVATE => 'move_from_number_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO = [
        FFCST::PROPERTY_PRIVATE => 'move_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_MOVE_TO_EMPTY = [
        FFCST::PROPERTY_PRIVATE => 'move_to_empty',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'move_to_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'OTHER',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'move_to_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['to_client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_MOVE_TO_NUM = [
        FFCST::PROPERTY_PRIVATE => 'move_to_num',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NAME = [
        FFCST::PROPERTY_PRIVATE => 'move_to_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_ADDRESS = [
        FFCST::PROPERTY_PRIVATE => 'move_to_address',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_CP = [
        FFCST::PROPERTY_PRIVATE => 'move_to_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'move_to_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'move_to_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'move_to_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'move_to_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'move_to_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NUMBER_5 = [
        FFCST::PROPERTY_PRIVATE => 'move_to_number_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TO_NUMBER_6 = [
        FFCST::PROPERTY_PRIVATE => 'move_to_number_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NAME_1 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_name_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NUM_1 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_num_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NAME_2 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_name_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NUM_2 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_num_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NAME_3 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_name_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NUM_3 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_num_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NAME_4 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_name_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_GROUP_NUM_4 = [
        FFCST::PROPERTY_PRIVATE => 'move_group_num_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_DESC = [
        FFCST::PROPERTY_PRIVATE => 'move_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'move_blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_MOVE_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'move_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => 'OTHER',
    ];
    protected static $PRP_MOVE_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'move_status',
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
            'move_id'            => self::$PRP_MOVE_ID,
            'brk_id'             => self::$PRP_BRK_ID,
            'move_from_site_id'  => self::$PRP_MOVE_FROM_SITE_ID,
            'move_to_site_id'    => self::$PRP_MOVE_TO_SITE_ID,
            'move_tr_name'       => self::$PRP_MOVE_TR_NAME,
            'move_tr_num'        => self::$PRP_MOVE_TR_NUM,
            'move_tr_num2'       => self::$PRP_MOVE_TR_NUM2,
            'move_from'          => self::$PRP_MOVE_FROM,
            'move_from_empty'    => self::$PRP_MOVE_FROM_EMPTY,
            'move_from_type'     => self::$PRP_MOVE_FROM_TYPE,
            'move_from_cli_id'   => self::$PRP_MOVE_FROM_CLI_ID,
            'move_from_num'      => self::$PRP_MOVE_FROM_NUM,
            'move_from_name'     => self::$PRP_MOVE_FROM_NAME,
            'move_from_address'  => self::$PRP_MOVE_FROM_ADDRESS,
            'move_from_cp'       => self::$PRP_MOVE_FROM_CP,
            'move_from_town'     => self::$PRP_MOVE_FROM_TOWN,
            'move_from_number_1' => self::$PRP_MOVE_FROM_NUMBER_1,
            'move_from_number_2' => self::$PRP_MOVE_FROM_NUMBER_2,
            'move_from_number_3' => self::$PRP_MOVE_FROM_NUMBER_3,
            'move_from_number_4' => self::$PRP_MOVE_FROM_NUMBER_4,
            'move_from_number_5' => self::$PRP_MOVE_FROM_NUMBER_5,
            'move_from_number_6' => self::$PRP_MOVE_FROM_NUMBER_6,
            'move_to'            => self::$PRP_MOVE_TO,
            'move_to_empty'      => self::$PRP_MOVE_TO_EMPTY,
            'move_to_type'       => self::$PRP_MOVE_TO_TYPE,
            'move_to_cli_id'     => self::$PRP_MOVE_TO_CLI_ID,
            'move_to_num'        => self::$PRP_MOVE_TO_NUM,
            'move_to_name'       => self::$PRP_MOVE_TO_NAME,
            'move_to_address'    => self::$PRP_MOVE_TO_ADDRESS,
            'move_to_cp'         => self::$PRP_MOVE_TO_CP,
            'move_to_town'       => self::$PRP_MOVE_TO_TOWN,
            'move_to_number_1'   => self::$PRP_MOVE_TO_NUMBER_1,
            'move_to_number_2'   => self::$PRP_MOVE_TO_NUMBER_2,
            'move_to_number_3'   => self::$PRP_MOVE_TO_NUMBER_3,
            'move_to_number_4'   => self::$PRP_MOVE_TO_NUMBER_4,
            'move_to_number_5'   => self::$PRP_MOVE_TO_NUMBER_5,
            'move_to_number_6'   => self::$PRP_MOVE_TO_NUMBER_6,
            'move_group_name_1'  => self::$PRP_MOVE_GROUP_NAME_1,
            'move_group_num_1'   => self::$PRP_MOVE_GROUP_NUM_1,
            'move_group_name_2'  => self::$PRP_MOVE_GROUP_NAME_2,
            'move_group_num_2'   => self::$PRP_MOVE_GROUP_NUM_2,
            'move_group_name_3'  => self::$PRP_MOVE_GROUP_NAME_3,
            'move_group_num_3'   => self::$PRP_MOVE_GROUP_NUM_3,
            'move_group_name_4'  => self::$PRP_MOVE_GROUP_NAME_4,
            'move_group_num_4'   => self::$PRP_MOVE_GROUP_NUM_4,
            'move_desc'          => self::$PRP_MOVE_DESC,
            'move_blob'          => self::$PRP_MOVE_BLOB,
            'move_type'          => self::$PRP_MOVE_TYPE,
            'move_status'        => self::$PRP_MOVE_STATUS,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_movement';
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'movements' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::CauseMovement',
                FFCST::REL_FIELD   => 'move_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les causes du mouvement',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'causes' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Cause',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_NONE,
                FFCST::REL_COMMENT => 'Technique pour la création',
            ]
        ];
    }
}
