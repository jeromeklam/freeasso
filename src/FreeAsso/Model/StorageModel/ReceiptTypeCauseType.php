<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptTypeCauseType
 *
 * @author jeromeklam
 */
abstract class ReceiptTypeCauseType extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_RTCT_ID = [
        FFCST::PROPERTY_PRIVATE => 'rtct_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_TITLE   => 'Id',
        FFCST::PROPERTY_COMMENT => 'Identifiant',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_CAUT_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Type de cause',
        FFCST::PROPERTY_COMMENT => 'Type de cause',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['cause_type' => 
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::CauseType',
                FFCST::FOREIGN_FIELD => 'caut_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_RETT_ID = [
        FFCST::PROPERTY_PRIVATE => 'rett_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Type de reçu',
        FFCST::PROPERTY_COMMENT => 'Type de reçu',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['receipt_type' => 
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::ReceiptType',
                FFCST::FOREIGN_FIELD => 'rett_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_RTCT_ONCE = [
        FFCST::PROPERTY_PRIVATE => 'rtct_once',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Ponctuel',
        FFCST::PROPERTY_COMMENT => 'Ponctuel',
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_RTCT_REGULAR = [
        FFCST::PROPERTY_PRIVATE => 'rtct_regular',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Régulier',
        FFCST::PROPERTY_COMMENT => 'Régulier',
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_SAMPLE  => 123,
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'rtct_id'      => self::$PRP_RTCT_ID,
            'caut_id'      => self::$PRP_CAUT_ID,
            'rett_id'      => self::$PRP_RETT_ID,
            'rtct_once'    => self::$PRP_RTCT_ONCE,
            'rtct_regular' => self::$PRP_RTCT_REGULAR
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_receipt_type_cause_type';
    }

    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Liens types de reçus';
    }

    /**
     * Get object description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Liens types de reçus';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['rtct_once', 'rtct_regular'];
    }
}
