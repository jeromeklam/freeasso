<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;
use \FreeSSO\ErrorCodes as SsoErrors;

/**
 * JobFunction
 *
 * @author jeromeklam
 */
abstract class JobFunction extends \FreeSSO\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_FCT_ID = [
        FFCST::PROPERTY_PRIVATE => 'fct_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant de la fonction',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_FCT_CODE = [
        FFCST::PROPERTY_PRIVATE => 'fct_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Code',
        FFCST::PROPERTY_SAMPLE  => 'ADMIN',
        FFCST::PROPERTY_MAX     => 20,
    ];
    protected static $PRP_FCT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'fct_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Nom',
        FFCST::PROPERTY_SAMPLE  => 'Administrateur',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_FCT_FROM = [
        FFCST::PROPERTY_PRIVATE => 'fct_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Début de validité',
        FFCST::PROPERTY_SAMPLE  => '2020-01-01 15:00:00',
    ];
    protected static $PRP_FCT_TO = [
        FFCST::PROPERTY_PRIVATE => 'fct_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Fin de validité',
        FFCST::PROPERTY_SAMPLE  => null,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'fct_id'   => self::$PRP_FCT_ID,
            'fct_code' => self::$PRP_FCT_CODE,
            'fct_name' => self::$PRP_FCT_NAME,
            'fct_from' => self::$PRP_FCT_FROM,
            'fct_to'   => self::$PRP_FCT_TO
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_job_function';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des fonctions';
    }

    /**
     * Get uniq indexes
     *
     * @return array[]
     */
    public static function getUniqIndexes()
    {
        return [
            'code' => [
                FFCST::INDEX_FIELDS => 'fct_code',
                FFCST::INDEX_EXISTS => SsoErrors::ERROR_JOBFUNCTION_CODE_EXISTS
            ]
        ];
    }
}
