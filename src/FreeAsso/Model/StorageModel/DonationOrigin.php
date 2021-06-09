<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * DonationOrigin
 *
 * @author jeromeklam
 */
abstract class DonationOrigin extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_DONO_ID = [
        FFCST::PROPERTY_PRIVATE => 'dono_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER]
    ];
    protected static $PRP_DONO_TS = [
        FFCST::PROPERTY_PRIVATE => 'dono_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DONO_ORIGIN = [
        FFCST::PROPERTY_PRIVATE => 'dono_origin',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DONO_COMMENTS = [
        FFCST::PROPERTY_PRIVATE => 'dono_comments',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DONO_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'dono_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DONO_MONTH = [
        FFCST::PROPERTY_PRIVATE => 'dono_month',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DONO_DAY = [
        FFCST::PROPERTY_PRIVATE => 'dono_day',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DONO_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'dono_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['OK','PENDING','ERROR'],
        FFCST::PROPERTY_DEFAULT => 'PENDING',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
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
            'dono_id'       => self::$PRP_DONO_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'dono_ts'       => self::$PRP_DONO_TS,
            'dono_origin'   => self::$PRP_DONO_ORIGIN,
            'dono_comments' => self::$PRP_DONO_COMMENTS,
            'dono_year'     => self::$PRP_DONO_YEAR,
            'dono_month'    => self::$PRP_DONO_MONTH,
            'dono_day'      => self::$PRP_DONO_DAY,
            'dono_status'   => self::$PRP_DONO_STATUS,
            'grp_id'        => self::$PRP_GRP_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_donation_origin';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['dono_year', 'dono_month', 'dono_day'];
    }
}
