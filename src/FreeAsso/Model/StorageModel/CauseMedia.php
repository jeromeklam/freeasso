<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseMedia
 *
 * @author jeromeklam
 */
abstract class CauseMedia extends \FreeFW\Core\StorageModel
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
    protected static $PRP_CAUM_ID = [
        FFCST::PROPERTY_PRIVATE => 'caum_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAUM_CODE = [
        FFCST::PROPERTY_PRIVATE => 'caum_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUM_TYPE = [
        FFCST::PROPERTY_PRIVATE => 'caum_type',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_CAUM_TS = [
        FFCST::PROPERTY_PRIVATE => 'caum_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUM_FROM = [
        FFCST::PROPERTY_PRIVATE => 'caum_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUM_TO = [
        FFCST::PROPERTY_PRIVATE => 'caum_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUM_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'caum_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE]
    ];
    protected static $PRP_CAUM_SHORT_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'caum_short_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUM_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'caum_blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_JSONIGNORE]
    ];
    protected static $PRP_CAUM_SHORT_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'caum_short_blob',
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
    protected static $PRP_CAUM_ORDER = [
        FFCST::PROPERTY_PRIVATE => 'caum_order',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAUM_TITLE = [
        FFCST::PROPERTY_PRIVATE => 'caum_title',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
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
            'caum_id'         => self::$PRP_CAUM_ID,
            'cau_id'          => self::$PRP_CAU_ID,
            'brk_id'          => self::$PRP_BRK_ID,
            'caum_code'       => self::$PRP_CAUM_CODE,
            'caum_type'       => self::$PRP_CAUM_TYPE,
            'caum_ts'         => self::$PRP_CAUM_TS,
            'caum_from'       => self::$PRP_CAUM_FROM,
            'caum_to'         => self::$PRP_CAUM_TO,
            'caum_text'       => self::$PRP_CAUM_TEXT,
            'caum_short_text' => self::$PRP_CAUM_SHORT_TEXT,
            'caum_blob'       => self::$PRP_CAUM_BLOB,
            'caum_short_blob' => self::$PRP_CAUM_SHORT_BLOB,
            'lang_id'         => self::$PRP_LANG_ID,
            'caum_order'      => self::$PRP_CAUM_ORDER,
            'caum_title'      => self::$PRP_CAUM_TITLE
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_media';
    }
}
