<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Domain
 *
 * @author jeromeklam
 */
abstract class Domain extends \FreeSSO\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_DOM_ID = [
        FFCST::PROPERTY_PRIVATE => 'dom_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du domaine',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_DOM_KEY = [
        FFCST::PROPERTY_PRIVATE => 'dom_key',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MD5,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Clef',
        FFCST::PROPERTY_SAMPLE  => 'test.fr',
    ];
    protected static $PRP_DOM_NAME = [
        FFCST::PROPERTY_PRIVATE => 'dom_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Nom du domaine',
        FFCST::PROPERTY_SAMPLE  => 'Test',
    ];
    protected static $PRP_DOM_CONCURRENT_USER = [
        FFCST::PROPERTY_PRIVATE => 'dom_concurrent_user',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Nombre de connexions concurrentes d\'un même utilisateur autorisées, 0=illimité',
        FFCST::PROPERTY_SAMPLE  => 0,
        FFCST::PROPERTY_DEFAULT  => 0,
    ];
    protected static $PRP_DOM_MAINTAIN_SECONDS = [
        FFCST::PROPERTY_PRIVATE => 'dom_maintain_seconds',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Durée de ping de la connexion en secondes, 0=illimité',
        FFCST::PROPERTY_SAMPLE  => 55,
        FFCST::PROPERTY_DEFAULT  => 55,
    ];
    protected static $PRP_DOM_SESSION_MINUTES = [
        FFCST::PROPERTY_PRIVATE => 'dom_session_minutes',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Durée de maintien de la connexion en minutes, 0=valeur par défaut=60',
        FFCST::PROPERTY_SAMPLE  => 120,
        FFCST::PROPERTY_DEFAULT  => 60,
    ];
    protected static $PRP_DOM_SITES = [
        FFCST::PROPERTY_PRIVATE => 'dom_sites',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Liste des urls/domaines autorisés à se connecter',
        FFCST::PROPERTY_SAMPLE  => '{"domain":"test.fr","url":"https://montest.fr"}',
        FFCST::PROPERTY_DEFAULT  => null,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'dom_id'               => self::$PRP_DOM_ID,
            'dom_key'              => self::$PRP_DOM_KEY,
            'dom_name'             => self::$PRP_DOM_NAME,
            'dom_concurrent_user'  => self::$PRP_DOM_CONCURRENT_USER,
            'dom_maintain_seconds' => self::$PRP_DOM_MAINTAIN_SECONDS,
            'dom_session_minutes'  => self::$PRP_DOM_SESSION_MINUTES,
            'dom_sites'            => self::$PRP_DOM_SITES
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_domain';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des domaines';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['dom_key', 'dom_name'];
    }
}
