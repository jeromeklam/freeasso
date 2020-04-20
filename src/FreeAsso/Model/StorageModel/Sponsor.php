<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Sponsor
 *
 * @author jeromeklam
 */
abstract class Sponsor extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SPON_ID = [
        FFCST::PROPERTY_PRIVATE => 'spon_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK, FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SPON_NAME = [
        FFCST::PROPERTY_PRIVATE => 'spon_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_SPON_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'spon_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPON_SITE = [
        FFCST::PROPERTY_PRIVATE => 'spon_site',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPON_NEWS = [
        FFCST::PROPERTY_PRIVATE => 'spon_news',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SPON_DONATOR = [
        FFCST::PROPERTY_PRIVATE => 'spon_donator',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
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
            'spon_id'      => self::$PRP_SPON_ID,
            'spon_name'    => self::$PRP_SPON_NAME,
            'spon_email'   => self::$PRP_SPON_EMAIL,
            'spon_site'    => self::$PRP_SPON_SITE,
            'spon_news'    => self::$PRP_SPON_NEWS,
            'cli_id'       => self::$PRP_CLI_ID,
            'spon_donator' => self::$PRP_SPON_DONATOR
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'dummy_sponsor';
    }
}
