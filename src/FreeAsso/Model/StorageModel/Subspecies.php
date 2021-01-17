<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Subspecies
 *
 * @author jeromeklam
 */
abstract class Subspecies extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_SSPE_ID = [
        FFCST::PROPERTY_PRIVATE => 'sspe_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'L\'identifiant de la sous-espèce',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER],
        FFCST::PROPERTY_COMMENT => 'Identifiant du broker, pour restriction',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_SPE_ID = [
        FFCST::PROPERTY_PRIVATE => 'spe_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'L\'identifiant de l\'espèce',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['species' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::Species',
                FFCST::FOREIGN_FIELD => 'spe_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_SSPE_NAME = [
        FFCST::PROPERTY_PRIVATE => 'sspe_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Le nom de la sous-espèce',
        FFCST::PROPERTY_MAX     => 255,
        FFCST::PROPERTY_SAMPLE  => 'Labrador',
    ];
    protected static $PRP_SSPE_SCIENTIFIC = [
        FFCST::PROPERTY_PRIVATE => 'sspe_scientific',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Le nom scientifique de la sous-espèce',
        FFCST::PROPERTY_MAX     => 255,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_SSPE_FROM = [
        FFCST::PROPERTY_PRIVATE => 'sspe_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La date de début de validité',
    ];
    protected static $PRP_SSPE_TO = [
        FFCST::PROPERTY_PRIVATE => 'sspe_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La date de fin de validité',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'sspe_id'         => self::$PRP_SSPE_ID,
            'brk_id'          => self::$PRP_BRK_ID,
            'spe_id'          => self::$PRP_SPE_ID,
            'sspe_name'       => self::$PRP_SSPE_NAME,
            'sspe_scientific' => self::$PRP_SSPE_SCIENTIFIC,
            'sspe_from'       => self::$PRP_SSPE_FROM,
            'sspe_to'         => self::$PRP_SSPE_TO,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_subspecies';
    }

    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return 'La gestion des sous-espèces';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['sspe_name', 'sspe_scientific'];
    }

    /**
     * Composed index
     *
     * @return string[][]|number[][]
     */
    public static function getUniqIndexes()
    {
        return [
            'name' => [
                FFCST::INDEX_FIELDS => ['brk_id', 'sspe_name'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_SUBSPECIES_NAME_EXISTS
            ],
            'code' => [
                FFCST::INDEX_FIELDS => ['brk_id', 'sspe_scientific'],
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_SUBSPECIES_SCIENTIFIC_EXISTS
            ]
        ];
    }
}
