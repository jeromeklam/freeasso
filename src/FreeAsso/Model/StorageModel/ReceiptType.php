<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptType
 *
 * @author jeromeklam
 */
abstract class ReceiptType extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_RETT_ID = [
        FFCST::PROPERTY_PRIVATE => 'rett_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_TITLE   => 'Id.',
        FFCST::PROPERTY_COMMENT => 'Identifiant',
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER],
        FFCST::PROPERTY_TITLE   => 'Broker',
        FFCST::PROPERTY_COMMENT => 'Broker',
    ];
    protected static $PRP_RETT_NAME = [
        FFCST::PROPERTY_PRIVATE => 'rett_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Nom',
        FFCST::PROPERTY_COMMENT => 'Nom',
    ];
    protected static $PRP_RETT_LAST_NUMBER = [
        FFCST::PROPERTY_PRIVATE => 'rett_last_number',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Dernier',
        FFCST::PROPERTY_COMMENT => 'Dernier numéro',
    ];
    protected static $PRP_RETT_REGEX = [
        FFCST::PROPERTY_PRIVATE => 'rett_regex',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Expression',
        FFCST::PROPERTY_COMMENT => 'Expression régulière',
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK,FFCST::OPTION_GROUP],
        FFCST::PROPERTY_TITLE   => 'Groupe',
        FFCST::PROPERTY_COMMENT => 'Groupe',
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_RETT_START_ONE = [
        FFCST::PROPERTY_PRIVATE => 'rett_start_one',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_TITLE   => 'Démarre à 1',
        FFCST::PROPERTY_COMMENT => 'Démarre à 1',
    ];

    /**
     * Get title
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Types reçu';
    }

    /**
     * Get comment
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Gestion des types de reçu';
    }

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'rett_id'          => self::$PRP_RETT_ID,
            'brk_id'           => self::$PRP_BRK_ID,
            'rett_name'        => self::$PRP_RETT_NAME,
            'rett_last_number' => self::$PRP_RETT_LAST_NUMBER,
            'rett_regex'       => self::$PRP_RETT_REGEX,
            'grp_id'           => self::$PRP_GRP_ID,
            'rett_start_one'   => self::$PRP_RETT_START_ONE,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_receipt_type';
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'settings' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::ReceiptTypeCauseType',
                FFCST::REL_FIELD   => 'rett_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les liens vers les types de cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE,
            ],
        ];
    }
}
