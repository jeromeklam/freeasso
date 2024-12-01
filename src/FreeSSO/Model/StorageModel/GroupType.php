<?php
namespace FreeSSO\Model\StorageModel;

use \FreeFW\Constants as FFCST;
use \FreeSSO\ErrorCodes as SsoErrors;

/**
 * GroupType
 *
 * @author jeromeklam
 */
abstract class GroupType extends \FreeSSO\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_GRPT_ID = [
        FFCST::PROPERTY_PRIVATE => 'grpt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du type de groupe',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_GRPT_CODE = [
        FFCST::PROPERTY_PRIVATE => 'grpt_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Code court',
        FFCST::PROPERTY_SAMPLE  => 'TYPE1',
        FFCST::PROPERTY_MAX     => 20,
    ];
    protected static $PRP_GRPT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'grpt_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Nom du type de groupe',
        FFCST::PROPERTY_SAMPLE  => 'Mon type 1',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_GRPT_FROM = [
        FFCST::PROPERTY_PRIVATE => 'grpt_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Début de validitée',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01 14:00:23',
    ];
    protected static $PRP_GRPT_TO = [
        FFCST::PROPERTY_PRIVATE => 'grpt_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Fin de validitée',
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
            'grpt_id'   => self::$PRP_GRPT_ID,
            'grpt_code' => self::$PRP_GRPT_CODE,
            'grpt_name' => self::$PRP_GRPT_NAME,
            'grpt_from' => self::$PRP_GRPT_FROM,
            'grpt_to'   => self::$PRP_GRPT_TO
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'sso_group_type';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceTitle()
    {
        return 'Type de groupe';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion des types de groupes';
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
                FFCST::INDEX_FIELDS => 'grpt_code',
                FFCST::INDEX_EXISTS => SsoErrors::ERROR_GROUPTYPE_CODE_EXISTS
            ]
        ];
    }
}
