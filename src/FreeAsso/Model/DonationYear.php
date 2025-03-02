<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * DonationYear
 *
 * @author jeromeklam
 */
class DonationYear extends \FreeAsso\Model\Donation
{

    /**
     * Field properties as static arrays
     * @var array
     */
    protected static $PRP_DONY_ID = [
        FFCST::PROPERTY_PRIVATE => 'dony_id',
        FFCST::PROPERTY_TYPE    => FFCST::TYPE_BIGINT,
        FFCST::PROPERTY_OPTIONS => [FFCST::OPTION_REQUIRED, FFCST::OPTION_PK]
    ];

    /**
     * Id
     * @var number
     */
    protected $dony_id = null;

    /**
     * Set donation year id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\DonationYear
     */
    public function setDonyId($p_id)
    {
        $this->dony_id = $p_id;
        return $this;
    }

    /**
     * Get donation year id
     *
     * @return number
     */
    public function getDonyId()
    {
        return $this->dony_id;
    }

    /**
     * get properties
     *
     * @return array[]
     */
    public static function getProperties()
    {
        return [
            'dony_id'          => self::$PRP_DONY_ID,
            'don_real_ts_year' => self::$PRP_DON_REAL_TS_YEAR,
        ];
    }
}
