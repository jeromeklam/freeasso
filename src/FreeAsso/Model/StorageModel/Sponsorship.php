<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Sponsorship
 *
 * @author jeromeklam
 */
abstract class Sponsorship extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SPO_ID = [
        FFCST::PROPERTY_PRIVATE => 'spo_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SPO_FROM = [
        FFCST::PROPERTY_PRIVATE => 'spo_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW
    ];
    protected static $PRP_SPO_TO = [
        FFCST::PROPERTY_PRIVATE => 'spo_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPO_MNT = [
        FFCST::PROPERTY_PRIVATE => 'spo_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SPO_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'spo_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SPO_FREQ = [
        FFCST::PROPERTY_PRIVATE => 'spo_freq',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['MONTH','YEAR','OTHER'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => 'MONTH',
    ];
    protected static $PRP_SPO_FREQ_WHEN = [
        FFCST::PROPERTY_PRIVATE => 'spo_freq_when',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPO_FREQ_DETAIL = [
        FFCST::PROPERTY_PRIVATE => 'spo_freq_detail',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PTYP_ID = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['payment_type' =>
            [
                'model' => 'FreeAsso::Model::PaymentType',
                'field' => 'ptyp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SPO_SPONSORS = [
        FFCST::PROPERTY_PRIVATE => 'spo_sponsors',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPO_DISPLAY_SITE = [
        FFCST::PROPERTY_PRIVATE => 'spo_display_site',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_SPO_SEND_NEWS = [
        FFCST::PROPERTY_PRIVATE => 'spo_send_news',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK,FFCST::OPTION_GROUP],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_CURRENT_GROUP,
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SPO_MNT_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'spo_mnt_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SPO_MONEY_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'spo_money_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SPO_FREQ_WHEN_CPL = [
        FFCST::PROPERTY_PRIVATE => 'spo_freq_when_cpl',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPO_ADD_FIRST = [
        FFCST::PROPERTY_PRIVATE => 'spo_add_first',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'spo_id'            => self::$PRP_SPO_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'cau_id'            => self::$PRP_CAU_ID,
            'cli_id'            => self::$PRP_CLI_ID,
            'spo_from'          => self::$PRP_SPO_FROM,
            'spo_to'            => self::$PRP_SPO_TO,
            'spo_mnt'           => self::$PRP_SPO_MNT,
            'spo_money'         => self::$PRP_SPO_MONEY,
            'spo_freq'          => self::$PRP_SPO_FREQ,
            'spo_freq_when'     => self::$PRP_SPO_FREQ_WHEN,
            'spo_freq_detail'   => self::$PRP_SPO_FREQ_DETAIL,
            'ptyp_id'           => self::$PRP_PTYP_ID,
            'spo_sponsors'      => self::$PRP_SPO_SPONSORS,
            'spo_display_site'  => self::$PRP_SPO_DISPLAY_SITE,
            'spo_send_news'     => self::$PRP_SPO_SEND_NEWS,
            'grp_id'            => self::$PRP_GRP_ID,
            'spo_mnt_input'     => self::$PRP_SPO_MNT_INPUT,
            'spo_money_input'   => self::$PRP_SPO_MONEY_INPUT,
            'spo_freq_when_cpl' => self::$PRP_SPO_FREQ_WHEN_CPL,
            'spo_add_first'     => self::$PRP_SPO_ADD_FIRST,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_sponsorship';
    }

    /**
     * Get object short name
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Parrainage';
    }

    /**
     * Get default includes for merge datas
     *
     * @return array
     */
    public static function getDefaultMergeIncludes()
    {
        return ['cause', 'client'];
    }

        /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'donations' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Donation',
                FFCST::REL_FIELD   => 'spo_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les dons pour le parrainage',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK
            ],
        ];
    }
}
