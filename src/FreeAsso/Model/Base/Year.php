<?php
namespace FreeAsso\Model\Base;

/**
 * Year
 *
 * @author jeromeklam
 */
abstract class Year extends \FreeAsso\Model\StorageModel\Year
{

    /**
     * year_id
     * @var int
     */
    protected $year_id = null;

    /**
     * year
     * @var int
     */
    protected $year = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * year_open
     * @var int
     */
    protected $year_open = null;

    /**
     * year_number
     * @var int
     */
    protected $year_number = null;
    
    /**
     * year_attest
     * @var int
     */
    protected $year_attest = null;

    /**
     * Set year_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Year
     */
    public function setYearId($p_value)
    {
        $this->year_id = $p_value;
        return $this;
    }

    /**
     * Get year_id
     *
     * @return int
     */
    public function getYearId()
    {
        return $this->year_id;
    }

    /**
     * Set year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Year
     */
    public function setYear($p_value)
    {
        $this->year = $p_value;
        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Year
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
     * Set year_open
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Year
     */
    public function setYearOpen($p_value)
    {
        $this->year_open = $p_value;
        return $this;
    }

    /**
     * Get year_open
     *
     * @return int
     */
    public function getYearOpen()
    {
        return $this->year_open;
    }

    /**
     * Set year_number
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Year
     */
    public function setYearNumber($p_value)
    {
        $this->year_number = $p_value;
        return $this;
    }

    /**
     * Get year_number
     *
     * @return int
     */
    public function getYearNumber()
    {
        return $this->year_number;
    }

    /**
     * Set year_attest
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Year
     */
    public function setYearAttest($p_value)
    {
        $this->year_attest = $p_value;
        return $this;
    }

    /**
     * Get year_attest
     *
     * @return int
     */
    public function getYearAttest()
    {
        return $this->year_attest;
    }
}
