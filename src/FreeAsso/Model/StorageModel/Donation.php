<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * Donation
 *
 * @author jeromeklam
 */
abstract class Donation extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_DON_ID = [
        FFCST::PROPERTY_PRIVATE => 'don_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_TITLE   => 'Id',
        FFCST::PROPERTY_COMMENT => 'Identifiant',
    ];
    protected static $PRP_BRK_ID = [
        FFCST::PROPERTY_PRIVATE => 'brk_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_BROKER],
        FFCST::PROPERTY_TITLE   => 'Broker',
        FFCST::PROPERTY_COMMENT => 'Broker',
    ];
    protected static $PRP_GRP_ID = [
        FFCST::PROPERTY_PRIVATE => 'grp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED,FFCST::OPTION_GROUP],
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
    protected static $PRP_CLI_ID = [
        FFCST::PROPERTY_PRIVATE => 'cli_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED,FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Client',
        FFCST::PROPERTY_COMMENT => 'Client',
        FFCST::PROPERTY_FK      => ['client' =>
            [
                'model' => 'FreeAsso::Model::Client',
                'field' => 'cli_id',
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
    protected static $PRP_SPO_ID = [
        FFCST::PROPERTY_PRIVATE => 'spo_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Parrainage',
        FFCST::PROPERTY_COMMENT => 'Parrainage',
        FFCST::PROPERTY_FK      => ['sponsorship' =>
            [
                'model' => 'FreeAsso::Model::Sponsorship',
                'field' => 'spo_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_DESC = [
        FFCST::PROPERTY_PRIVATE => 'don_desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Description',
        FFCST::PROPERTY_COMMENT => 'Description',
    ];
    protected static $PRP_DON_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_NOW,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Date système',
        FFCST::PROPERTY_COMMENT => 'Date système d\'enregistrement'
    ];
    protected static $PRP_DON_ASK_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_ask_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Date début',
        FFCST::PROPERTY_COMMENT => 'Date de début prise en compte parrainage'
    ];
    protected static $PRP_DON_REAL_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_real_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Date réelle',
        FFCST::PROPERTY_COMMENT => 'Date réelle du don, comptable'
    ];
    protected static $PRP_DON_END_TS = [
        FFCST::PROPERTY_PRIVATE => 'don_end_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Date fin',
        FFCST::PROPERTY_COMMENT => 'Date de fin prise en compte parrainage'
    ];
    protected static $PRP_DON_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'don_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['WAIT','OK','NOK','NEXT'],
        FFCST::PROPERTY_DEFAULT => 'OK',
        FFCST::PROPERTY_TITLE   => 'Status',
        FFCST::PROPERTY_COMMENT => 'Status',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_DON_MNT = [
        FFCST::PROPERTY_PRIVATE => 'don_mnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Montant DB',
        FFCST::PROPERTY_COMMENT => 'Montant DB',
    ];
    protected static $PRP_DON_MONEY = [
        FFCST::PROPERTY_PRIVATE => 'don_money',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Monnaie DB',
        FFCST::PROPERTY_COMMENT => 'Monnaie DB',
    ];
    protected static $PRP_DON_MNT_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'don_mnt_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DECIMAL,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Montant saisi',
        FFCST::PROPERTY_COMMENT => 'Montant saisi',
    ];
    protected static $PRP_DON_MONEY_INPUT = [
        FFCST::PROPERTY_PRIVATE => 'don_money_input',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_DEFAULT => 'EUR',
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => 'Monnaie saisie',
        FFCST::PROPERTY_COMMENT => 'Monnaie saisie',
    ];
    protected static $PRP_PTYP_ID = [
        FFCST::PROPERTY_PRIVATE => 'ptyp_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Paiement',
        FFCST::PROPERTY_COMMENT => 'Type de paiement',
        FFCST::PROPERTY_FK      => ['payment_type' =>
            [
                'model' => 'FreeAsso::Model::PaymentType',
                'field' => 'ptyp_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_COMMENT = [
        FFCST::PROPERTY_PRIVATE => 'don_comment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Commentaires',
        FFCST::PROPERTY_COMMENT => 'Commentaires',
    ];
    protected static $PRP_DON_DSTAT = [
        FFCST::PROPERTY_PRIVATE => 'don_dstat',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Date status',
        FFCST::PROPERTY_COMMENT => 'Date status',
    ];
    protected static $PRP_REC_ID = [
        FFCST::PROPERTY_PRIVATE => 'rec_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Reçu',
        FFCST::PROPERTY_COMMENT => 'Reçu',
    ];
    protected static $PRP_CERT_ID = [
        FFCST::PROPERTY_PRIVATE => 'cert_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Certificat',
        FFCST::PROPERTY_COMMENT => 'Certificat',
        FFCST::PROPERTY_FK      => ['certificate' =>
            [
                'model' => 'FreeAsso::Model::Certificate',
                'field' => 'cert_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_SPONSORS = [
        FFCST::PROPERTY_PRIVATE => 'don_sponsors',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Parrains',
        FFCST::PROPERTY_COMMENT => 'Parrains',
    ];
    protected static $PRP_DON_DISPLAY_SITE = [
        FFCST::PROPERTY_PRIVATE => 'don_display_site',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_TITLE   => 'Site',
        FFCST::PROPERTY_COMMENT => 'Site',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DONO_ID = [
        FFCST::PROPERTY_PRIVATE => 'dono_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Origine',
        FFCST::PROPERTY_COMMENT => 'Origine',
        FFCST::PROPERTY_FK      => ['origin' =>
            [
                'model' => 'FreeAsso::Model::DonationOrigin',
                'field' => 'dono_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_SESS_ID = [
        FFCST::PROPERTY_PRIVATE => 'sess_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK],
        FFCST::PROPERTY_TITLE   => 'Session',
        FFCST::PROPERTY_COMMENT => 'Session',
        FFCST::PROPERTY_FK      => ['session' =>
            [
                'model' => 'FreeAsso::Model::Session',
                'field' => 'sess_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_REAL_TS_YEAR = [
        FFCST::PROPERTY_PRIVATE  => 'don_real_ts_year',
        FFCST::PROPERTY_TYPE     => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS  => [FFCST::OPTION_FUNCTION],
        FFCST::PROPERTY_TITLE    => 'Année',
        FFCST::PROPERTY_COMMENT  => 'Année',
        FFCST::PROPERTY_FUNCTION => [\FreeFW\Storage\Storage::FUNCTION_YEAR => 'don_real_ts']
    ];
    protected static $PRP_DON_NEWS = [
        FFCST::PROPERTY_PRIVATE => 'don_news',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Nouvelles',
        FFCST::PROPERTY_COMMENT => 'Nouvelles',
    ];
    protected static $PRP_DON_CERTNAME = [
        FFCST::PROPERTY_PRIVATE => 'don_certname',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL]
    ];
    protected static $PRP_DON_CERTEMAIL = [
        FFCST::PROPERTY_PRIVATE => 'don_certemail',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL]
    ];
    protected static $PRP_DON_CERTDISPMNT = [
        FFCST::PROPERTY_PRIVATE => 'don_certdispmnt',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BOOLEAN,
        FFCST::PROPERTY_DEFAULT => FFCST::DEFAULT_TRUE,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_LOCAL]
    ];
    protected static $PRP_ACCL_ID = [
        FFCST::PROPERTY_PRIVATE => 'accl_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_FK,FFCST::OPTION_NOMERGE],
        FFCST::PROPERTY_TITLE   => 'Compta',
        FFCST::PROPERTY_COMMENT => 'Compta',
        FFCST::PROPERTY_FK      => ['accounting' =>
            [
                'model' => 'FreeAsso::Model::AccountingLine',
                'field' => 'accl_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ]
    ];
    protected static $PRP_DON_VERIF = [
        FFCST::PROPERTY_PRIVATE => 'don_verif',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['NONE','AUTO','MANUAL','HISTO'],
        FFCST::PROPERTY_DEFAULT => 'NONE',
        FFCST::PROPERTY_TITLE   => 'Vérifié',
        FFCST::PROPERTY_COMMENT => 'Vérifié',
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DON_VERIF_COMMENT = [
        FFCST::PROPERTY_PRIVATE => 'don_verif_comment',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Vérif comm',
        FFCST::PROPERTY_COMMENT => 'Commentaire de vérification',
    ];
    protected static $PRP_DON_VERIF_MATCH = [
        FFCST::PROPERTY_PRIVATE => 'don_verif_match',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_DEFAULT => 0,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => 'Note',
        FFCST::PROPERTY_COMMENT => 'Note',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'don_id'            => self::$PRP_DON_ID,
            'brk_id'            => self::$PRP_BRK_ID,
            'grp_id'            => self::$PRP_GRP_ID,
            'cli_id'            => self::$PRP_CLI_ID,
            'cau_id'            => self::$PRP_CAU_ID,
            'spo_id'            => self::$PRP_SPO_ID,
            'don_desc'          => self::$PRP_DON_DESC,
            'don_ts'            => self::$PRP_DON_TS,
            'don_ask_ts'        => self::$PRP_DON_ASK_TS,
            'don_real_ts'       => self::$PRP_DON_REAL_TS,
            'don_end_ts'        => self::$PRP_DON_END_TS,
            'don_status'        => self::$PRP_DON_STATUS,
            'don_mnt'           => self::$PRP_DON_MNT,
            'don_money'         => self::$PRP_DON_MONEY,
            'don_mnt_input'     => self::$PRP_DON_MNT_INPUT,
            'don_money_input'   => self::$PRP_DON_MONEY_INPUT,
            'ptyp_id'           => self::$PRP_PTYP_ID,
            'don_comment'       => self::$PRP_DON_COMMENT,
            'don_dstat'         => self::$PRP_DON_DSTAT,
            'rec_id'            => self::$PRP_REC_ID,
            'cert_id'           => self::$PRP_CERT_ID,
            'don_sponsors'      => self::$PRP_DON_SPONSORS,
            'don_display_site'  => self::$PRP_DON_DISPLAY_SITE,
            'dono_id'           => self::$PRP_DONO_ID,
            'sess_id'           => self::$PRP_SESS_ID,
            'don_real_ts_year'  => self::$PRP_DON_REAL_TS_YEAR,
            'don_news'          => self::$PRP_DON_NEWS,
            'don_certname'      => self::$PRP_DON_CERTNAME,
            'don_certemail'     => self::$PRP_DON_CERTEMAIL,
            'don_certdispmnt'   => self::$PRP_DON_CERTDISPMNT,
            'accl_id'           => self::$PRP_ACCL_ID,
            'don_verif'         => self::$PRP_DON_VERIF,
            'don_verif_comment' => self::$PRP_DON_VERIF_COMMENT,
            'don_verif_match'   => self::$PRP_DON_VERIF_MATCH,
        ];
    }

    /**
     * Get object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_donation';
    }

    /**
     * Get title
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return 'Dons';
    }

    /**
     * Get default includes for merge datas
     *
     * @return array
     */
    public static function getDefaultMergeIncludes()
    {
        return ['cause', 'client', 'client.client_type', 'payment_type'];
    }
}
