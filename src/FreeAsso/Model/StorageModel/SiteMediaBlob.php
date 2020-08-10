<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseMediaBlob
 *
 * @author jeromeklam
 */
abstract class SiteMediaBlob extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_TITLE = [
        FFCST::PROPERTY_PRIVATE => 'title',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DESC= [
        FFCST::PROPERTY_PRIVATE => 'desc',
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
            'site_id' => self::$PRP_SITE_ID,
            'blob'    => self::$PRP_BLOB,
            'title'   => self::$PRP_TITLE,
            'desc'    => self::$PRP_DESC,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_site_media_blob';
    }
}
