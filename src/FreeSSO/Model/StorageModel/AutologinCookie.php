<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * AutologinCookie
 *
 * @author jeromeklam
 */
abstract class AutologinCookie extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_AUTO_COOKIE = [
        FFCST::PROPERTY_PRIVATE => 'auto_cookie',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Identifiant du cookie',
        FFCST::PROPERTY_SAMPLE  => '78hgapn89hGiskshsg7T',
        FFCST::PROPERTY_MAX     => 128,
    ];
    protected static $PRP_USER_ID = [
        FFCST::PROPERTY_PRIVATE => 'user_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Identifiant de l\'utilisateur',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_AUTO_IP = [
        FFCST::PROPERTY_PRIVATE => 'auto_ip',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'IP de la demande',
        FFCST::PROPERTY_SAMPLE  => '192.168.0.1',
        FFCST::PROPERTY_MAX     => 32,
    ];
    protected static $PRP_AUTO_TS = [
        FFCST::PROPERTY_PRIVATE => 'auto_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La date de la demande',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 14:00:00',
    ];
    protected static $PRP_AUTO_EXPIRE = [
        FFCST::PROPERTY_PRIVATE => 'auto_expire',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La date d\'expiration',
        FFCST::PROPERTY_SAMPLE  => '2021-04-01 14:00:00',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'user_id'     => self::$PRP_USER_ID,
            'auto_cookie' => self::$PRP_AUTO_COOKIE,
            'auto_ip'     => self::$PRP_AUTO_IP,
            'auto_ts'     => self::$PRP_AUTO_TS,
            'auto_expire' => self::$PRP_AUTO_EXPIRE
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_autologin_cookie';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des cookies d\'autologin';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return 'auto_cookie';
    }
}
