<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * AccountingHeader
 *
 * @author jeromeklam
 */
abstract class AccountingHeader extends \FreeFW\Core\StorageModel
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_ACCH_ID = [
        FFCST::PROPERTY_PRIVATE => 'acch_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK],
        FFCST::PROPERTY_TITLE   => 'Id',
        FFCST::PROPERTY_COMMENT => 'Identifiant',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_ACCH_NAME = [
        FFCST::PROPERTY_PRIVATE => 'acch_name',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_MAX     => 255,
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ACCH_YEAR = [
        FFCST::PROPERTY_PRIVATE => 'acch_year',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_ACCH_MONTH = [
        FFCST::PROPERTY_PRIVATE => 'acch_month',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_INTEGER,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => 123,
    ];
    protected static $PRP_ACCH_TS = [
        FFCST::PROPERTY_PRIVATE => 'acch_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ACCH_CONTENT = [
        FFCST::PROPERTY_PRIVATE => 'acch_content',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ACCH_STATUS = [
        FFCST::PROPERTY_PRIVATE => 'acch_status',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_SELECT,
        FFCST::PROPERTY_ENUM    => ['WAITING','IMPORTED','PENDING','DONE'],
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ACCH_STATUS_TS = [
        FFCST::PROPERTY_PRIVATE => 'acch_status_ts',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_DATETIMETZ,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];
    protected static $PRP_ACCH_CODE = [
        FFCST::PROPERTY_PRIVATE => 'acch_code',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => [],
        FFCST::PROPERTY_TITLE   => '',
        FFCST::PROPERTY_COMMENT => '',
        FFCST::PROPERTY_SAMPLE  => '',
    ];

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'acch_id'        => self::$PRP_ACCH_ID,
            'acch_name'      => self::$PRP_ACCH_NAME,
            'acch_year'      => self::$PRP_ACCH_YEAR,
            'acch_month'     => self::$PRP_ACCH_MONTH,
            'acch_ts'        => self::$PRP_ACCH_TS,
            'acch_content'   => self::$PRP_ACCH_CONTENT,
            'acch_status'    => self::$PRP_ACCH_STATUS,
            'acch_status_ts' => self::$PRP_ACCH_STATUS_TS,
            'acch_code'      => self::$PRP_ACCH_CODE,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_accounting_header';
    }

    /**
     * Get object short description
     *
     * @return string
     */
    public static function getSourceTitle()
    {
        return '';
    }

    /**
     * Get object description
     *
     * @return string
     */
    public static function getSourceComments()
    {
        return '';
    }

    /**
     * Get autocomplete field
     *
     * @return string
     */
    public static function getAutocompleteField()
    {
        return '';
    }
}
