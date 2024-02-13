<?php
namespace FreeAsso\Model\Base;

/**
 * Stat
 *
 * @author jeromeklam
 */
abstract class Stat extends \FreeAsso\Model\StorageModel\Stat
{

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * don_year
     * @var int
     */
    protected $don_year = null;

    /**
     * don_month
     * @var int
     */
    protected $don_month = null;

    /**
     * ptyp_name
     * @var string
     */
    protected $ptyp_name = null;

    /**
     * clic_name
     * @var string
     */
    protected $clic_name = null;

    /**
     * caut_name
     * @var string
     */
    protected $caut_name = null;

    /**
     * don_regular
     * @var int
     */
    protected $don_regular = null;

    /**
     * cnty_ass
     * @var int
     */
    protected $cnty_ass = null;

    /**
     * don_status
     * @var string
     */
    protected $don_status = null;

    /**
     * tot_mnt
     * @var mixed
     */
    protected $tot_mnt = null;

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setGrpId($p_value)
    {
        $this->grp_id = $p_value;
        return $this;
    }

    /**
     * Get grp_id
     *
     * @return int
     */
    public function getGrpId()
    {
        return $this->grp_id;
    }

    /**
     * Set don_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setDonYear($p_value)
    {
        $this->don_year = $p_value;
        return $this;
    }

    /**
     * Get don_year
     *
     * @return int
     */
    public function getDonYear()
    {
        return $this->don_year;
    }

    /**
     * Set don_month
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setDonMonth($p_value)
    {
        $this->don_month = $p_value;
        return $this;
    }

    /**
     * Get don_month
     *
     * @return int
     */
    public function getDonMonth()
    {
        return $this->don_month;
    }

    /**
     * Set ptyp_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setPtypName($p_value)
    {
        $this->ptyp_name = $p_value;
        return $this;
    }

    /**
     * Get ptyp_name
     *
     * @return string
     */
    public function getPtypName()
    {
        return $this->ptyp_name;
    }

    /**
     * Set clic_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setClicName($p_value)
    {
        $this->clic_name = $p_value;
        return $this;
    }

    /**
     * Get clic_name
     *
     * @return string
     */
    public function getClicName()
    {
        return $this->clic_name;
    }

    /**
     * Set caut_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setCautName($p_value)
    {
        $this->caut_name = $p_value;
        return $this;
    }

    /**
     * Get caut_name
     *
     * @return string
     */
    public function getCautName()
    {
        return $this->caut_name;
    }

    /**
     * Set don_regular
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setDonRegular($p_value)
    {
        $this->don_regular = $p_value;
        return $this;
    }

    /**
     * Get don_regular
     *
     * @return int
     */
    public function getDonRegular()
    {
        return $this->don_regular;
    }

    /**
     * Set cnty_ass
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setCntyAss($p_value)
    {
        $this->cnty_ass = $p_value;
        return $this;
    }

    /**
     * Get cnty_ass
     *
     * @return int
     */
    public function getCntyAss()
    {
        return $this->cnty_ass;
    }

    /**
     * Set don_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setDonStatus($p_value)
    {
        $this->don_status = $p_value;
        return $this;
    }

    /**
     * Get don_status
     *
     * @return string
     */
    public function getDonStatus()
    {
        return $this->don_status;
    }

    /**
     * Set tot_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Stat
     */
    public function setTotMnt($p_value)
    {
        $this->tot_mnt = $p_value;
        return $this;
    }

    /**
     * Get tot_mnt
     *
     * @return mixed
     */
    public function getTotMnt()
    {
        return $this->tot_mnt;
    }
}
