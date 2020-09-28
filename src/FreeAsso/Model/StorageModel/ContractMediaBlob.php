<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * ContractMediaBlob
 *
 * @author jeromeklam
 */
abstract class ContractMediaBlob extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CT_ID = [
        FFCST::PROPERTY_PRIVATE => 'ct_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_TITLE = [
        FFCST::PROPERTY_PRIVATE => 'title',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
        FFCST::PROPERTY_OPTIONS => []
    ];
    protected static $PRP_DESC= [
        FFCST::PROPERTY_PRIVATE => 'desc',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_TEXT,
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
            'ct_id' => self::$PRP_CT_ID,
            'blob'  => self::$PRP_BLOB,
            'title' => self::$PRP_TITLE,
            'desc'  => self::$PRP_DESC,
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_contract_media_blob';
    }
}
