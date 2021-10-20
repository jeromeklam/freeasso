<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Certificate
 *
 * @author jeromeklam
 */
abstract class Certificate extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CERT_ID = [
        FFCST::PROPERTY_PRIVATE => 'cert_id',
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
        FFCST::PROPERTY_COMMENT => 'Identifiant du broker',
    ];
    protected static $PRP_CERT_TS = [
        FFCST::PROPERTY_PRIVATE => 'cert_ts',
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Création',
        FFCST::PROPERTY_COMMENT => 'Date de création',
    ];
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK,FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Donateur',
        FFCST::PROPERTY_COMMENT => 'Donateur',
        FFCST::PROPERTY_FK      => ['client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CERT_GEN_TS = [
        FFCST::PROPERTY_PRIVATE => 'cert_gen_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Généré le',
        FFCST::PROPERTY_COMMENT => 'Date de génération',
    ];
    protected static $PRP_CERT_PRINT_TS = [
        FFCST::PROPERTY_PRIVATE => 'cert_print_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Imprimé le',
        FFCST::PROPERTY_COMMENT => 'Date d\'impression',
    ];
    protected static $PRP_CERT_FULLNAME = [
        FFCST::PROPERTY_PRIVATE => 'cert_fullname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Nom complet',
        FFCST::PROPERTY_COMMENT => 'Nom complet du donateur',
    ];
    protected static $PRP_CERT_ADDRESS1 = [
        FFCST::PROPERTY_PRIVATE => 'cert_address1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Adresse 1',
        FFCST::PROPERTY_COMMENT => 'Adresse 1',
    ];
    protected static $PRP_CERT_ADDRESS2 = [
        FFCST::PROPERTY_PRIVATE => 'cert_address2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Adresse 2',
        FFCST::PROPERTY_COMMENT => 'Adresse 2',
    ];
    protected static $PRP_CERT_ADDRESS3 = [
        FFCST::PROPERTY_PRIVATE => 'cert_address3',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Adresse 3',
        FFCST::PROPERTY_COMMENT => 'Adresse 3',
    ];
    protected static $PRP_CERT_CP = [
        FFCST::PROPERTY_PRIVATE => 'cert_cp',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Code postal',
        FFCST::PROPERTY_COMMENT => 'Code postal',
    ];
    protected static $PRP_CERT_TOWN = [
        FFCST::PROPERTY_PRIVATE => 'cert_town',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Ville',
        FFCST::PROPERTY_COMMENT => 'Ville',
    ];
    protected static $PRP_LANG_ID = [
        FFCST::PROPERTY_PRIVATE => 'lang_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_LANG,
        FFCST::PROPERTY_TITLE   => 'Langue',
        FFCST::PROPERTY_COMMENT => 'Langue',
        FFCST::PROPERTY_FK      => ['lang' =>
            [
                'model' => 'FreeFW::Model::Lang',
                'field' => 'lang_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CNTY_ID = [
        FFCST::PROPERTY_PRIVATE => 'cnty_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_COUNTRY,
        FFCST::PROPERTY_TITLE   => 'Pays',
        FFCST::PROPERTY_COMMENT => 'Pays',
        FFCST::PROPERTY_FK      => ['country' =>
            [
                'model' => 'FreeFW::Model::Country',
                'field' => 'cnty_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CERT_EMAIL = [
        FFCST::PROPERTY_PRIVATE => 'cert_email',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Email',
        FFCST::PROPERTY_COMMENT => 'Email',
    ];
    protected static $PRP_CERT_INPUT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cert_input_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Montant',
        FFCST::PROPERTY_COMMENT => 'Montant',
    ];
    protected static $PRP_CERT_INPUT_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'cert_input_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Monnaie',
        FFCST::PROPERTY_COMMENT => 'Monnaie',
    ];
    protected static $PRP_CERT_OUTPUT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cert_output_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Montant final',
        FFCST::PROPERTY_COMMENT => 'Montant final',
    ];
    protected static $PRP_CERT_OUTPUT_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'cert_output_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Monnaie finale',
        FFCST::PROPERTY_COMMENT => 'Monnaie finale',
    ];
    protected static $PRP_CERT_COMMENT = [
        FFCST::PROPERTY_PRIVATE => 'cert_comment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Commentaires',
        FFCST::PROPERTY_COMMENT => 'Commentaires',
    ];
    protected static $PRP_CERT_DATA1 = [
        FFCST::PROPERTY_PRIVATE => 'cert_data1',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Donnée 1',
        FFCST::PROPERTY_COMMENT => 'Donnée 1',
    ];
    protected static $PRP_CERT_DATA2 = [
        FFCST::PROPERTY_PRIVATE => 'cert_data2',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Donnée 2',
        FFCST::PROPERTY_COMMENT => 'Donnée 2',
    ];
    protected static $PRP_FILE_ID = [
        FFCST::PROPERTY_PRIVATE => 'file_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Fichier',
        FFCST::PROPERTY_COMMENT => 'Fichier',
        FFCST::PROPERTY_FK      => ['file' =>
            [
                'model' => 'FreeFW::Model::File',
                'field' => 'file_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CERT_UNIT_UNIT = [
        FFCST::PROPERTY_PRIVATE => 'cert_unit_unit',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Unité',
        FFCST::PROPERTY_COMMENT => 'Unité',
    ];
    protected static $PRP_CERT_UNIT_MNT = [
        FFCST::PROPERTY_PRIVATE => 'cert_unit_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_MONETARY,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Montant unité',
        FFCST::PROPERTY_COMMENT => 'Montant unité',
    ];
    protected static $PRP_CERT_UNIT_BASE = [
        FFCST::PROPERTY_PRIVATE => 'cert_unit_base',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Base unité',
        FFCST::PROPERTY_COMMENT => 'Base unité',
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK,FFCST::OPTION_GROUP],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_CURRENT_GROUP,
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
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED,FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Cause',
        FFCST::PROPERTY_COMMENT => 'Cause',
        FFCST::PROPERTY_FK      => ['cause' =>
            [
                'model' => 'FreeAsso::Model::Cause',
                'field' => 'cau_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_CERT_MANUAL = [
        FFCST::PROPERTY_PRIVATE => 'cert_manual',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_FALSE,
        FFCST::PROPERTY_TITLE   => 'Manuel',
        FFCST::PROPERTY_COMMENT => 'Manuel',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'cert_id'           => self::$PRP_CERT_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'cert_ts'           => self::$PRP_CERT_TS,
            'cli_id'            => self::$PRP_CLI_ID,
            'cert_gen_ts'       => self::$PRP_CERT_GEN_TS,
            'cert_print_ts'     => self::$PRP_CERT_PRINT_TS,
            'cert_fullname'     => self::$PRP_CERT_FULLNAME,
            'cert_address1'     => self::$PRP_CERT_ADDRESS1,
            'cert_address2'     => self::$PRP_CERT_ADDRESS2,
            'cert_address3'     => self::$PRP_CERT_ADDRESS3,
            'cert_cp'           => self::$PRP_CERT_CP,
            'cert_town'         => self::$PRP_CERT_TOWN,
            'lang_id'           => self::$PRP_LANG_ID,
            'cnty_id'           => self::$PRP_CNTY_ID,
            'cert_email'        => self::$PRP_CERT_EMAIL,
            'cert_input_mnt'    => self::$PRP_CERT_INPUT_MNT,
            'cert_input_money'  => self::$PRP_CERT_INPUT_MONEY,
            'cert_output_mnt'   => self::$PRP_CERT_OUTPUT_MNT,
            'cert_output_money' => self::$PRP_CERT_OUTPUT_MONEY,
            'cert_comment'      => self::$PRP_CERT_COMMENT,
            'cert_data1'        => self::$PRP_CERT_DATA1,
            'cert_data2'        => self::$PRP_CERT_DATA2,
            'file_id'           => self::$PRP_FILE_ID,
            'cert_unit_unit'    => self::$PRP_CERT_UNIT_UNIT,
            'cert_unit_mnt'     => self::$PRP_CERT_UNIT_MNT,
            'cert_unit_base'    => self::$PRP_CERT_UNIT_BASE,
            'grp_id'            => self::$PRP_GRP_ID,
            'cau_id'            => self::$PRP_CAU_ID,
            'cert_manual'       => self::$PRP_CERT_MANUAL,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_certificate';
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Certificat';
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSourceComment()
    {
        return 'Gestion des certificats';
    }
}
