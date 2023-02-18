<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptGeneration
 *
 * @author jeromeklam
 */
abstract class ReceiptGeneration extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_RECG_ID = [
        FFCST::PROPERTY_PRIVATE => 'recg_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_TITLE   => 'Id.',
        FFCST::PROPERTY_COMMENT => 'Identifiant',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_BROKER],
        FFCST::PROPERTY_TITLE   => 'Broker',
        FFCST::PROPERTY_COMMENT => 'Broker',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_RECG_NAME = [
        FFCST::PROPERTY_PRIVATE => 'recg_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Nom',
        FFCST::PROPERTY_COMMENT => 'Nom',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_RECG_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'recg_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Année',
        FFCST::PROPERTY_COMMENT => 'Année',
        FFCST::PROPERTY_SAMPLE  => 2020,
    ];
    protected static $PRP_RECG_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'recg_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['WAITING','PENDING','DONE','ERROR','NONE'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Status',
        FFCST::PROPERTY_COMMENT => 'Status',
        FFCST::PROPERTY_DEFAULT => 'NONE',
        FFCST::PROPERTY_MAX     => 7,
        FFCST::PROPERTY_SAMPLE  => 'WAITING',
    ];
    protected static $PRP_RECG_SAVE = [
        FFCST::PROPERTY_PRIVATE => 'recg_save',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_JSON,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Svg',
        FFCST::PROPERTY_COMMENT => 'Sauvegarde',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED,FFCST::OPTION_GROUP],
        FFCST::PROPERTY_TITLE   => 'Groupe',
        FFCST::PROPERTY_COMMENT => 'Groupe',
        FFCST::PROPERTY_SAMPLE  => 123,
        FFCST::PROPERTY_FK      => ['group' => 
            [
                FFCST::FOREIGN_MODEL => 'FreeSSO::Model::Group',
                FFCST::FOREIGN_FIELD => 'grp_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT,
            ]
        ],
    ];
    protected static $PRP_EDI_ID = [
        FFCST::PROPERTY_PRIVATE => 'edi_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['edition' =>
            [
                'model' => 'FreeFW::Model::Edition',
                'field' => 'edi_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_EMAIL_ID = [
        FFCST::PROPERTY_PRIVATE => 'email_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['email' =>
            [
                'model' => 'FreeFW::Model::Email',
                'field' => 'email_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_RECG_GEN = [
        FFCST::PROPERTY_PRIVATE => 'recg_gen',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Généré le',
        FFCST::PROPERTY_COMMENT => 'Date de génération',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_RECG_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'recg_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Emails le',
        FFCST::PROPERTY_COMMENT => 'Emails envoyés le',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_RECG_NO_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'recg_no_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Imprimés le',
        FFCST::PROPERTY_COMMENT => 'Imprimés lé',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_CLIC_ID = [
        FFCST::PROPERTY_PRIVATE => 'clic_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Catégorie',
        FFCST::PROPERTY_FK      => ['client_category' =>
            [
                'model' => 'FreeAsso::Model::ClientCategory',
                'field' => 'clic_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'recg_id'       => self::$PRP_RECG_ID,
            'brk_id'        => self::$PRP_BRK_ID,
            'recg_name'     => self::$PRP_RECG_NAME,
            'recg_year'     => self::$PRP_RECG_YEAR,
            'recg_status'   => self::$PRP_RECG_STATUS,
            'recg_save'     => self::$PRP_RECG_SAVE,
            'grp_id'        => self::$PRP_GRP_ID,
            'edi_id'        => self::$PRP_EDI_ID,
            'email_id'      => self::$PRP_EMAIL_ID,
            'recg_gen'      => self::$PRP_RECG_GEN,
            'recg_email'    => self::$PRP_RECG_EMAIL,
            'recg_no_email' => self::$PRP_RECG_NO_EMAIL,
            'clic_id'       => self::$PRP_CLIC_ID,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_receipt_generation';
    }

    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Génération';
    }

    /**
     * Get object description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return 'Génération';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return 'recg_name';
    }
}
