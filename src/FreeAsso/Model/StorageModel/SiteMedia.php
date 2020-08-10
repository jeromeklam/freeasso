<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * SiteMedia
 *
 * @author jeromeklam
 */
abstract class SiteMedia extends \FreeFW\Core\StorageModel
{

    /**
     * Type de media
     * @var string
     */
    const TYPE_PHOTO = 'PHOTO';
    const TYPE_HTML  = 'HTML';
    const TYPE_NEWS  = 'NEWS';
    const TYPE_OTHER = 'OTHER';

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_SITM_ID = [
        FFCST::PROPERTY_PRIVATE => 'sitm_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_SITM_CODE = [
        FFCST::PROPERTY_PRIVATE => 'sitm_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITM_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'sitm_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SITM_TS = [
        FFCST::PROPERTY_PRIVATE => 'sitm_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_FROM = [
        FFCST::PROPERTY_PRIVATE => 'sitm_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_TO = [
        FFCST::PROPERTY_PRIVATE => 'sitm_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'sitm_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_SHORT_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'sitm_short_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'sitm_blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_SHORT_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'sitm_short_blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['lang' =>
            [
                'model' => 'FreeFW::Model::lang',
                'field' => 'lang_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITM_ORDER = [
        FFCST::PROPERTY_PRIVATE => 'sitm_order',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_TITLE = [
        FFCST::PROPERTY_PRIVATE => 'sitm_title',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITM_DESC = [
        FFCST::PROPERTY_PRIVATE => 'sitm_desc',
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
            'sitm_id'         => self::$PRP_SITM_ID,
            'site_id'         => self::$PRP_SITE_ID,
            'brk_id'          => self::$PRP_BRK_ID,
            'sitm_code'       => self::$PRP_SITM_CODE,
            'sitm_type'       => self::$PRP_SITM_TYPE,
            'sitm_ts'         => self::$PRP_SITM_TS,
            'sitm_from'       => self::$PRP_SITM_FROM,
            'sitm_to'         => self::$PRP_SITM_TO,
            'sitm_text'       => self::$PRP_SITM_TEXT,
            'sitm_short_text' => self::$PRP_SITM_SHORT_TEXT,
            'sitm_blob'       => self::$PRP_SITM_BLOB,
            'sitm_short_blob' => self::$PRP_SITM_SHORT_BLOB,
            'lang_id'         => self::$PRP_LANG_ID,
            'sitm_order'      => self::$PRP_SITM_ORDER,
            'sitm_title'      => self::$PRP_SITM_TITLE,
            'sitm_desc'       => self::$PRP_SITM_DESC
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_site_media';
    }
}
