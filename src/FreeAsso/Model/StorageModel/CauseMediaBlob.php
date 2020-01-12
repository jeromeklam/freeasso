<?php
namespace FreeAsso\Model\StorageModel;

use \FreeFW\Constants as FFCST;

/**
 * CauseMediaBlob
 *
 * @author jeromeklam
 */
abstract class CauseMediaBlob extends \FreeFW\Core\StorageModel
{

/**
 * Field properties as static arrays
 * @var array
 */
    protected static $PRP_CAU_ID = [
        FFCST::PROPERTY_PRIVATE => 'cau_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED]
    ];
    protected static $PRP_BLOB = [
        FFCST::PROPERTY_PRIVATE => 'blob',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BLOB,
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
            'cau_id' => self::$PRP_CAU_ID,
            'blob'   => self::$PRP_BLOB
        ];
    }

    /**
     * Set object source
     *
     * @return string
     */
    public static function getSource()
    {
        return 'asso_cause_media_blob';
    }
}
