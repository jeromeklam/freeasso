<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Cause
 *
 * @author jeromeklam
 */
abstract class Cause extends \FreeAsso\Model\StorageModel\Base
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'Identifiant de la cause',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'Restriction broker',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER]
    ];
    protected static $PRP_CAUT_ID = [
        FFCST::PROPERTY_PRIVATE => 'caut_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'Le type de cause',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['cause_type' =>
            [
                'model' => 'FreeAsso::Model::CauseType',
                'field' => 'caut_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_NAME = [
        FFCST::PROPERTY_PRIVATE => 'cau_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_COMMENT => 'Le nom de la cause',
        FFCST::PROPERTY_TITLE   => 'Nom',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_DESC = [
        FFCST::PROPERTY_PRIVATE => 'cau_desc',
        FFCST::PROPERTY_COMMENT => 'La description de la cause',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_HTML,
        FFCST::PROPERTY_TITLE   => 'Description',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_FROM = [
        FFCST::PROPERTY_PRIVATE => 'cau_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_COMMENT => 'Date de début de validité',
        FFCST::PROPERTY_TITLE   => 'Entrée',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_TO = [
        FFCST::PROPERTY_PRIVATE => 'cau_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_COMMENT => 'Date de fin de validité',
        FFCST::PROPERTY_TITLE   => 'Sortie',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_PUBLIC = [
        FFCST::PROPERTY_PRIVATE => 'cau_public',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_COMMENT => 'Cause publique ?',
        FFCST::PROPERTY_TITLE   => 'Publique',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_CAU_AVAILABLE = [
        FFCST::PROPERTY_PRIVATE => 'cau_available',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_COMMENT => 'La cause est disponible',
        FFCST::PROPERTY_TITLE   => 'Valide',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
    ];
    protected static $PRP_SSPE_ID = [
        FFCST::PROPERTY_PRIVATE => 'sspe_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'L\'espèce',
        FFCST::PROPERTY_TITLE   => 'Espèce',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['subspecies' =>
            [
                'model' => 'FreeAsso::Model::Subspecies',
                'field' => 'sspe_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'Le site de rattachement',
        FFCST::PROPERTY_TITLE   => 'Site',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['site' =>
            [
                'model' => 'FreeAsso::Model::Site',
                'field' => 'site_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_ORIG_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'orig_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'Proviens de',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['origin' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_RAIS_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'rais_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_COMMENT => 'Eleveur',
        FFCST::PROPERTY_TITLE   => 'Eleveur',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['raiser' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cau_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_COMMENT => 'Montant récolté',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_MNT_LEFT = [
        FFCST::PROPERTY_PRIVATE => 'cau_mnt_left',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_COMMENT => 'Montant restant',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'cau_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_COMMENT => 'Monnaie',
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_CODE = [
        FFCST::PROPERTY_PRIVATE => 'cau_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_COMMENT => 'Le code identifiant',
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_FAMILY = [
        FFCST::PROPERTY_PRIVATE => 'cau_family',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_COMMENT => 'La famille de la cause',
        FFCST::PROPERTY_TITLE   => 'Famille',
        FFCST::PROPERTY_ENUM    => ['OTHER','NONE','ANIMAL','FOREST'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_DEFAULT => 'ANIMAL',
    ];
    protected static $PRP_CAU_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'cau_string_1',
        FFCST::PROPERTY_TITLE   => 'Couleur',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'cau_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'cau_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'cau_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'cau_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'cau_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'cau_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'cau_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'cau_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'cau_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'cau_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'cau_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIME,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'cau_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'cau_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'cau_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'cau_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'cau_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'cau_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'cau_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'cau_bool_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_COORD = [
        FFCST::PROPERTY_PRIVATE => 'cau_coord',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_SEX = [
        FFCST::PROPERTY_PRIVATE => 'cau_sex',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['M','F','C','OTHER'],
        FFCST::PROPERTY_DEFAULT => 'OTHER',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'cau_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_CURRENT_YEAR,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_PARENT1_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'parent1_cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['parent1' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_PARENT2_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'parent2_cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['parent2' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUM_TEXT_ID = [
        FFCST::PROPERTY_PRIVATE => 'caum_text_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['default_text' =>
            [
                'model' => 'FreeAsso::Model::CauseMedia',
                'field' => 'caum_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAUM_BLOB_ID = [
        FFCST::PROPERTY_PRIVATE => 'caum_blob_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['default_blob' =>
            [
                'model' => 'FreeAsso::Model::CauseMedia',
                'field' => 'caum_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_UNIT_UNIT = [
        FFCST::PROPERTY_PRIVATE => 'cau_unit_unit',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_UNIT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cau_unit_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MONETARY,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_UNIT_BASE = [
        FFCST::PROPERTY_PRIVATE => 'cau_unit_base',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_UNIT_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'cau_unit_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_WAITING = [
        FFCST::PROPERTY_PRIVATE => 'cau_waiting',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
    ];
    protected static $PRP_CAU_CONFORM = [
        FFCST::PROPERTY_PRIVATE => 'cau_conform',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_COMMENT => 'Indique si la cause est conforme',
        FFCST::PROPERTY_SAMPLE  => true
    ];
    protected static $PRP_CAU_CONFORM_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'cau_conform_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Texte lié à la conformité',
        FFCST::PROPERTY_SAMPLE  => 'La cause est conforme'
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_FK      => ['group' =>
            [
                'model' => 'FreeSSO::Model::Group',
                'field' => 'grp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CAU_MNT_RAISED = [
        FFCST::PROPERTY_PRIVATE => 'cau_mnt_raised',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MONETARY,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL],
        FFCST::PROPERTY_COMMENT => 'Montant récolté',
    ];
    protected static $PRP_CAU_LAST_NEWS = [
        FFCST::PROPERTY_PRIVATE => 'cau_last_news',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_COMMENT => 'Date de la dernière news',
        FFCST::PROPERTY_TITLE   => 'News',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_CAU_LAST_PHOTO = [
        FFCST::PROPERTY_PRIVATE => 'cau_last_photo',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_COMMENT => 'Date de la dernière photo',
        FFCST::PROPERTY_TITLE   => 'Photo',
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
            'cau_id'           => self::$PRP_CAU_ID,
            'brk_id'           => self::$PRP_BRK_ID,
            'caut_id'          => self::$PRP_CAUT_ID,
            'cau_name'         => self::$PRP_CAU_NAME,
            'cau_desc'         => self::$PRP_CAU_DESC,
            'cau_from'         => self::$PRP_CAU_FROM,
            'cau_to'           => self::$PRP_CAU_TO,
            'cau_public'       => self::$PRP_CAU_PUBLIC,
            'cau_available'    => self::$PRP_CAU_AVAILABLE,
            'sspe_id'          => self::$PRP_SSPE_ID,
            'site_id'          => self::$PRP_SITE_ID,
            'orig_cli_id'      => self::$PRP_ORIG_CLI_ID,
            'rais_cli_id'      => self::$PRP_RAIS_CLI_ID,
            'cau_mnt'          => self::$PRP_CAU_MNT,
            'cau_mnt_left'     => self::$PRP_CAU_MNT_LEFT,
            'cau_money'        => self::$PRP_CAU_MONEY,
            'cau_code'         => self::$PRP_CAU_CODE,
            'cau_family'       => self::$PRP_CAU_FAMILY,
            'cau_string_1'     => self::$PRP_CAU_STRING_1,
            'cau_string_2'     => self::$PRP_CAU_STRING_2,
            'cau_string_3'     => self::$PRP_CAU_STRING_3,
            'cau_string_4'     => self::$PRP_CAU_STRING_4,
            'cau_number_1'     => self::$PRP_CAU_NUMBER_1,
            'cau_number_2'     => self::$PRP_CAU_NUMBER_2,
            'cau_number_3'     => self::$PRP_CAU_NUMBER_3,
            'cau_number_4'     => self::$PRP_CAU_NUMBER_4,
            'cau_date_1'       => self::$PRP_CAU_DATE_1,
            'cau_date_2'       => self::$PRP_CAU_DATE_2,
            'cau_date_3'       => self::$PRP_CAU_DATE_3,
            'cau_date_4'       => self::$PRP_CAU_DATE_4,
            'cau_text_1'       => self::$PRP_CAU_TEXT_1,
            'cau_text_2'       => self::$PRP_CAU_TEXT_2,
            'cau_text_3'       => self::$PRP_CAU_TEXT_3,
            'cau_text_4'       => self::$PRP_CAU_TEXT_4,
            'cau_bool_1'       => self::$PRP_CAU_BOOL_1,
            'cau_bool_2'       => self::$PRP_CAU_BOOL_2,
            'cau_bool_3'       => self::$PRP_CAU_BOOL_3,
            'cau_bool_4'       => self::$PRP_CAU_BOOL_4,
            'cau_coord'        => self::$PRP_CAU_COORD,
            'cau_sex'          => self::$PRP_CAU_SEX,
            'cau_year'         => self::$PRP_CAU_YEAR,
            'parent1_cau_id'   => self::$PRP_PARENT1_CAU_ID,
            'parent2_cau_id'   => self::$PRP_PARENT2_CAU_ID,
            'caum_text_id'     => self::$PRP_CAUM_TEXT_ID,
            'caum_blob_id'     => self::$PRP_CAUM_BLOB_ID,
            'cau_unit_unit'    => self::$PRP_CAU_UNIT_UNIT,
            'cau_unit_mnt'     => self::$PRP_CAU_UNIT_MNT,
            'cau_unit_base'    => self::$PRP_CAU_UNIT_BASE,
            'cau_unit_money'   => self::$PRP_CAU_UNIT_MONEY,
            'cau_waiting'      => self::$PRP_CAU_WAITING,
            'cau_conform'      => self::$PRP_CAU_CONFORM,
            'cau_conform_text' => self::$PRP_CAU_CONFORM_TEXT,
            'grp_id'           => self::$PRP_GRP_ID,
            'cau_mnt_raised'   => self::$PRP_CAU_MNT_RAISED,
            'cau_last_news'    => self::$PRP_CAU_LAST_NEWS,
            'cau_last_photo'   => self::$PRP_CAU_LAST_PHOTO,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return ['cau_code', 'cau_name'];
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'movements' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::CauseMovement',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les mouvements de la cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK
            ],
            'donations' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Donation',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les dons pour la cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK
            ],
            'medias' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les médias de la cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'documents' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les documents de la cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'growths' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::CauseGrowth',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les croissances de la cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
            'sicknesses' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::CauseSickness',
                FFCST::REL_FIELD   => 'cau_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Les maladies de la cause',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE
            ],
        ];
    }

    /**
     * Get default includes for merge datas
     *
     * @return array
     */
    public static function getDefaultMergeIncludes()
    {
        return ['subspecies', 'site'];
    }

    /**
     * Get short title
     *
     * @return array
     */
    public static function getSourceTitle()
    {
        return 'Cause';
    }
}
