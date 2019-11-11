<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Site
 *
 * @author jeromeklam
 */
abstract class Site extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_SITE_NAME = [
        FFCST::PROPERTY_PRIVATE => 'site_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'site_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'site_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'site_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_CP = [
        FFCST::PROPERTY_PRIVATE => 'site_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'site_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::PROPERTY_BROKER]
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'site_id'       => self::$PRP_SITE_ID,
            'site_name'     => self::$PRP_SITE_NAME,
            'site_address1' => self::$PRP_SITE_ADDRESS1,
            'site_address2' => self::$PRP_SITE_ADDRESS2,
            'site_address3' => self::$PRP_SITE_ADDRESS3,
            'site_cp'       => self::$PRP_SITE_CP,
            'site_town'     => self::$PRP_SITE_TOWN,
            'brk_id'        => self::$PRP_BRK_ID
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_site';
    }
}
