<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Site
 *
 * @author jeromeklam
 */
abstract class Site extends \FreeAsso\Model\StorageModel\Base
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du site',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER],
        FFCST::PROPERTY_COMMENT => 'Identifiant du broker, pour restriction',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_SITT_ID = [
        FFCST::PROPERTY_PRIVATE => 'sitt_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du type de site',
        FFCST::PROPERTY_SAMPLE  => 1,
        FFCST::PROPERTY_FK      => ['site_type' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::SiteType',
                FFCST::FOREIGN_FIELD => 'sitt_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITE_NAME = [
        FFCST::PROPERTY_PRIVATE => 'site_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_COMMENT => 'Nom du site',
        FFCST::PROPERTY_SAMPLE  => 'Mon site',
        FFCST::PROPERTY_MAX     => 80,
        FFCST::PROPERTY_LLM_DESC => 'Site name. Use $contains for partial matching, $eq for exact.',
    ];
    protected static $PRP_SITE_FROM = [
        FFCST::PROPERTY_PRIVATE => 'site_from',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Début de validité',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01',
    ];
    protected static $PRP_SITE_TO = [
        FFCST::PROPERTY_PRIVATE => 'site_to',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Fin de validité',
        FFCST::PROPERTY_SAMPLE  => '2020-04-01',
    ];
    protected static $PRP_SITE_CODE = [
        FFCST::PROPERTY_PRIVATE => 'site_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Code identifiant court du site',
        FFCST::PROPERTY_SAMPLE  => 'SITEA',
        FFCST::PROPERTY_MAX     => 32,
        FFCST::PROPERTY_LLM_DESC => 'Short code identifying the site. Use $eq for exact match.',
    ];
    protected static $PRP_SITE_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'site_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Première ligne d\'adresse',
        FFCST::PROPERTY_SAMPLE  => '1 Rue Test',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_SITE_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'site_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Seconde ligne d\'adresse',
        FFCST::PROPERTY_SAMPLE  => 'Batiment A',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_SITE_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'site_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Troisième ligne d\'adresse',
        FFCST::PROPERTY_SAMPLE  => 'Cedex',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_SITE_CP = [
        FFCST::PROPERTY_PRIVATE => 'site_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Code postal',
        FFCST::PROPERTY_SAMPLE  => '99999',
        FFCST::PROPERTY_MAX     => 20,
    ];
    protected static $PRP_SITE_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'site_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Ville',
        FFCST::PROPERTY_SAMPLE  => 'Ma ville',
        FFCST::PROPERTY_MAX     => 80,
    ];
    protected static $PRP_OWNER_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'owner_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du propriétaire',
        FFCST::PROPERTY_SAMPLE  => 1,
        FFCST::PROPERTY_FK      => ['owner' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::Client',
                FFCST::FOREIGN_FIELD => 'cli_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SANIT_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'sanit_cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du vétérinaire',
        FFCST::PROPERTY_SAMPLE  => 1,
        FFCST::PROPERTY_FK      => ['sanitary' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::Client',
                FFCST::FOREIGN_FIELD => 'cli_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_PARENT_SITE_ID = [
        FFCST::PROPERTY_PRIVATE => 'parent_site_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_COMMENT => 'Identifiant du site parent',
        FFCST::PROPERTY_SAMPLE  => 1,
        FFCST::PROPERTY_FK      => ['parent_site' =>
            [
                FFCST::FOREIGN_MODEL => 'FreeAsso::Model::Site',
                FFCST::FOREIGN_FIELD => 'site_id',
                FFCST::FOREIGN_TYPE  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SITE_AREA = [
        FFCST::PROPERTY_PRIVATE => 'site_area',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Superficie du site (m2)',
        FFCST::PROPERTY_SAMPLE  => 100,
        FFCST::PROPERTY_LLM_DESC => 'Site area in square meters. Use $gt/$lt for size ranges.',
    ];
    protected static $PRP_SITE_POSITION = [
        FFCST::PROPERTY_PRIVATE => 'site_position',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Ordre par rapport aux sites frères',
        FFCST::PROPERTY_SAMPLE  => 1,
    ];
    protected static $PRP_SITE_PLOTS = [
        FFCST::PROPERTY_PRIVATE => 'site_plots',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Description des parcelles au format json',
        FFCST::PROPERTY_SAMPLE  => '[{"section:["A"],"number":["200","201"]},{"section:["B","C"],"number":["300"]}]',
    ];
    protected static $PRP_SITE_LEFT = [
        FFCST::PROPERTY_PRIVATE => 'site_left',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Identifiant gauche (nested tree)',
        FFCST::PROPERTY_SAMPLE  => 1,
    ];
    protected static $PRP_SITE_RIGHT = [
        FFCST::PROPERTY_PRIVATE => 'site_right',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Identifiant droit (nested tree)',
        FFCST::PROPERTY_SAMPLE  => 1,
    ];
    protected static $PRP_SITE_LEVEL = [
        FFCST::PROPERTY_PRIVATE => 'site_level',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Profondeur (nested tree)',
        FFCST::PROPERTY_SAMPLE  => 1,
    ];
    protected static $PRP_SITE_STRING_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 1',
        FFCST::PROPERTY_SAMPLE  => 'var1',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 2',
        FFCST::PROPERTY_SAMPLE  => 'var2',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 3',
        FFCST::PROPERTY_SAMPLE  => 'var3',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 4',
        FFCST::PROPERTY_SAMPLE  => 'var4',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_5 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 5',
        FFCST::PROPERTY_SAMPLE  => 'var5',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_6 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 6',
        FFCST::PROPERTY_SAMPLE  => 'var6',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_7 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_7',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 7',
        FFCST::PROPERTY_SAMPLE  => 'var7',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_STRING_8 = [
        FFCST::PROPERTY_PRIVATE => 'site_string_8',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Valeur variable chaine 8',
        FFCST::PROPERTY_SAMPLE  => 'var8',
        FFCST::PROPERTY_MAX     => 255,
    ];
    protected static $PRP_SITE_NUMBER_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DATE_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_date_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_TEXT_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_text_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_1 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_2 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_3 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_BOOL_4 = [
        FFCST::PROPERTY_PRIVATE => 'site_bool_4',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_COORD = [
        FFCST::PROPERTY_PRIVATE => 'site_coord',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Les coordonnées GPS sous forme de json',
        FFCST::PROPERTY_SAMPLE  => '{"lat": 48.7325755, "lon" : 7.3738603}',
    ];
    protected static $PRP_SITE_CODE_EX = [
        FFCST::PROPERTY_PRIVATE => 'site_code_ex',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_DESC = [
        FFCST::PROPERTY_PRIVATE => 'site_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT_HTML,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'La description du site au format html',
        FFCST::PROPERTY_SAMPLE  => '<p>Mon site préféré</p>',
    ];
    protected static $PRP_SITE_NUMBER_5 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_5',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_NUMBER_6 = [
        FFCST::PROPERTY_PRIVATE => 'site_number_6',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_SITE_CONFORM = [
        FFCST::PROPERTY_PRIVATE => 'site_conform',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_COMMENT => 'Indique si le site est conforme',
        FFCST::PROPERTY_SAMPLE  => true
    ];
    protected static $PRP_SITE_CONFORM_TEXT = [
        FFCST::PROPERTY_PRIVATE => 'site_conform_text',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Texte lié à la conformité',
        FFCST::PROPERTY_SAMPLE  => 'Le site est conforme'
    ];
    protected static $PRP_SITE_EXTERN = [
        FFCST::PROPERTY_PRIVATE => 'site_extern',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_COMMENT => 'Site externe',
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_SAMPLE  => false
    ];
    protected static $PRP_SITE_COUNT_CAUSE = [
        FFCST::PROPERTY_PRIVATE  => 'site_count_cause',
        FFCST::PROPERTY_TYPE     => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS  => [FFCST::OPTION_LOCAL]
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

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'site_id'           => self::$PRP_SITE_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'sitt_id'           => self::$PRP_SITT_ID,
            'site_name'         => self::$PRP_SITE_NAME,
            'site_from'         => self::$PRP_SITE_FROM,
            'site_to'           => self::$PRP_SITE_TO,
            'site_code'         => self::$PRP_SITE_CODE,
            'site_address1'     => self::$PRP_SITE_ADDRESS1,
            'site_address2'     => self::$PRP_SITE_ADDRESS2,
            'site_address3'     => self::$PRP_SITE_ADDRESS3,
            'site_cp'           => self::$PRP_SITE_CP,
            'site_town'         => self::$PRP_SITE_TOWN,
            'owner_cli_id'      => self::$PRP_OWNER_CLI_ID,
            'sanit_cli_id'      => self::$PRP_SANIT_CLI_ID,
            'parent_site_id'    => self::$PRP_PARENT_SITE_ID,
            'site_area'         => self::$PRP_SITE_AREA,
            'site_position'     => self::$PRP_SITE_POSITION,
            'site_plots'        => self::$PRP_SITE_PLOTS,
            'site_left'         => self::$PRP_SITE_LEFT,
            'site_right'        => self::$PRP_SITE_RIGHT,
            'site_level'        => self::$PRP_SITE_LEVEL,
            'site_string_1'     => self::$PRP_SITE_STRING_1,
            'site_string_2'     => self::$PRP_SITE_STRING_2,
            'site_string_3'     => self::$PRP_SITE_STRING_3,
            'site_string_4'     => self::$PRP_SITE_STRING_4,
            'site_string_5'     => self::$PRP_SITE_STRING_5,
            'site_string_6'     => self::$PRP_SITE_STRING_6,
            'site_string_7'     => self::$PRP_SITE_STRING_7,
            'site_string_8'     => self::$PRP_SITE_STRING_8,
            'site_number_1'     => self::$PRP_SITE_NUMBER_1,
            'site_number_2'     => self::$PRP_SITE_NUMBER_2,
            'site_number_3'     => self::$PRP_SITE_NUMBER_3,
            'site_number_4'     => self::$PRP_SITE_NUMBER_4,
            'site_date_1'       => self::$PRP_SITE_DATE_1,
            'site_date_2'       => self::$PRP_SITE_DATE_2,
            'site_date_3'       => self::$PRP_SITE_DATE_3,
            'site_date_4'       => self::$PRP_SITE_DATE_4,
            'site_text_1'       => self::$PRP_SITE_TEXT_1,
            'site_text_2'       => self::$PRP_SITE_TEXT_2,
            'site_text_3'       => self::$PRP_SITE_TEXT_3,
            'site_text_4'       => self::$PRP_SITE_TEXT_4,
            'site_bool_1'       => self::$PRP_SITE_BOOL_1,
            'site_bool_2'       => self::$PRP_SITE_BOOL_2,
            'site_bool_3'       => self::$PRP_SITE_BOOL_3,
            'site_bool_4'       => self::$PRP_SITE_BOOL_4,
            'site_coord'        => self::$PRP_SITE_COORD,
            'site_code_ex'      => self::$PRP_SITE_CODE_EX,
            'site_desc'         => self::$PRP_SITE_DESC,
            'site_number_5'     => self::$PRP_SITE_NUMBER_5,
            'site_number_6'     => self::$PRP_SITE_NUMBER_6,
            'site_conform'      => self::$PRP_SITE_CONFORM,
            'site_conform_text' => self::$PRP_SITE_CONFORM_TEXT,
            'site_count_cause'  => self::$PRP_SITE_COUNT_CAUSE,
            'site_extern'       => self::$PRP_SITE_EXTERN,
            'grp_id'            => self::$PRP_GRP_ID
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

    /**
     * Retourne une explication de la table
     */
    public static function getSourceTitle()
    {
        return 'Site';
    }

    /**
     * Retourne une explication de la table
     */
    public static function getSourceComments()
    {
        return 'Gestion d\'un site, qui permet de regrouper des causes dans un même lieu : région, île, pays, ...';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return 'site_name';
    }

    /**
     * Get uniq indexes
     *
     * @return array[]
     */
    public static function getUniqIndexes()
    {
        return [
            'name' => [
                FFCST::INDEX_FIELDS => 'site_name',
                FFCST::INDEX_EXISTS => \FreeAsso\Constants::ERROR_SITE_UNIQ_NAME,
            ]
        ];
    }

    /**
     * Get One To many relationShips
     *
     * @return array
     */
    public function getRelationships()
    {
        return [
            'sons' => [
                FFCST::REL_MODEL   => 'FreeAsso::Model::Site',
                FFCST::REL_FIELD   => 'parent_site_id',
                FFCST::REL_TYPE    => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_COMMENT => 'Texte lié à la conformité',
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CHECK,
                FFCST::REL_EXISTS  => \FreeAsso\Constants::ERROR_SITE_REL_SON,
            ],
            'medias' => [
                FFCST::REL_MODEL  => 'FreeAsso::Model::SiteMedia',
                FFCST::REL_FIELD  => 'site_id',
                FFCST::REL_TYPE   => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_REMOVE  => FFCST::REL_REMOVE_CASCADE,
                FFCST::REL_EXISTS => \FreeAsso\Constants::ERROR_SITE_REL_MEDIA,
            ],
            'movements_from' => [
                FFCST::REL_MODEL  => 'FreeAsso::Model::Movement',
                FFCST::REL_FIELD  => 'move_from_site_id',
                FFCST::REL_TYPE   => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_REMOVE => FFCST::REL_REMOVE_CHECK,
                FFCST::REL_EXISTS => \FreeAsso\Constants::ERROR_SITE_REL_FROM,
            ],
            'movements_to' => [
                FFCST::REL_MODEL  => 'FreeAsso::Model::Movement',
                FFCST::REL_FIELD  => 'move_to_site_id',
                FFCST::REL_TYPE   => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_REMOVE => FFCST::REL_REMOVE_CHECK,
                FFCST::REL_EXISTS => \FreeAsso\Constants::ERROR_SITE_REL_TO,
            ],
            'causes' => [
                FFCST::REL_MODEL  => 'FreeAsso::Model::Cause',
                FFCST::REL_FIELD  => 'site_id',
                FFCST::REL_TYPE   => \FreeFW\Model\Query::JOIN_LEFT,
                FFCST::REL_REMOVE => FFCST::REL_REMOVE_CHECK,
                FFCST::REL_EXISTS => \FreeAsso\Constants::ERROR_SITE_REL_CAUSE,
            ]
        ];
    }

    /**
     * Get LLM configuration for this model
     *
     * @return array
     */
    public static function getLlmConfig(): array
    {
        return [
            'keywords'    => ['sites', 'site', 'lieux', 'lieu', 'sanctuaires', 'sanctuaire', 'îles'],
            'description' => 'Physical locations where causes are housed (regions, islands, sanctuaries).',
        ];
    }
}
