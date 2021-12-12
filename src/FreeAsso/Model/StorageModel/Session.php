<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Session
 *
 * @author jeromeklam
 */
abstract class Session extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SESS_ID = [
        FFCST::PROPERTY_PRIVATE => 'sess_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_SESS_NAME = [
        FFCST::PROPERTY_PRIVATE => 'sess_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_EXERCICE = [
        FFCST::PROPERTY_PRIVATE => 'sess_exercice',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SESS_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'sess_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'sess_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SESS_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'sess_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SESS_MONTH = [
        FFCST::PROPERTY_PRIVATE => 'sess_month',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED,FFCST::OPTION_GROUP],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_CURRENT_GROUP,
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SESS_VERIF = [
        FFCST::PROPERTY_PRIVATE => 'sess_verif',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['NONE','DONE','CLEANING','PENDING','ERROR'],
        FFCST::PROPERTY_DEFAULT => 'NONE',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SESS_VERIF_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'sess_verif_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
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
            'sess_id'         => self::$PRP_SESS_ID,
            'brk_id'          => self::$PRP_BRK_ID,
            'sess_name'       => self::$PRP_SESS_NAME,
            'sess_exercice'   => self::$PRP_SESS_EXERCICE,
            'sess_status'     => self::$PRP_SESS_STATUS,
            'sess_type'       => self::$PRP_SESS_TYPE,
            'sess_year'       => self::$PRP_SESS_YEAR,
            'sess_month'      => self::$PRP_SESS_MONTH,
            'grp_id'          => self::$PRP_GRP_ID,
            'sess_verif'      => self::$PRP_SESS_VERIF,
            'sess_verif_text' => self::$PRP_SESS_VERIF_TEXT,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_session';
    }

    /**
     * Get short name
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Session';
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
                FFCST::INDEX_FIELDS => ['grp_id', 'sess_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_SESSION_NAME_EXISTS
            ]
        ];
    }
}
