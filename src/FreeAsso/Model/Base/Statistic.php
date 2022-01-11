<?php
namespace FreeAsso\Model\Base;

/**
 * Statistic
 *
 * @author jeromeklam
 */
abstract class Statistic extends \FreeAsso\Model\StorageModel\Statistic
{

    /**
     * stat_id
     * @var int
     */
    protected $stat_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * stat_code
     * @var string
     */
    protected $stat_code = null;

    /**
     * stat_name
     * @var string
     */
    protected $stat_name = null;

    /**
     * stat_year
     * @var int
     */
    protected $stat_year = null;

    /**
     * stat_month
     * @var int
     */
    protected $stat_month = null;

    /**
     * stat_nb
     * @var int
     */
    protected $stat_nb = null;

    /**
     * stat_mnt
     * @var mixed
     */
    protected $stat_mnt = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * Set stat_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatId($p_value)
    {
        $this->stat_id = $p_value;
        return $this;
    }

    /**
     * Get stat_id
     *
     * @return int
     */
    public function getStatId()
    {
        return $this->stat_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }

    /**
     * Get brk_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }

    /**
     * Set stat_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatCode($p_value)
    {
        $this->stat_code = $p_value;
        return $this;
    }

    /**
     * Get stat_code
     *
     * @return string
     */
    public function getStatCode()
    {
        return $this->stat_code;
    }

    /**
     * Set stat_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatName($p_value)
    {
        $this->stat_name = $p_value;
        return $this;
    }

    /**
     * Get stat_name
     *
     * @return string
     */
    public function getStatName()
    {
        return $this->stat_name;
    }

    /**
     * Set stat_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatYear($p_value)
    {
        $this->stat_year = $p_value;
        return $this;
    }

    /**
     * Get stat_year
     *
     * @return int
     */
    public function getStatYear()
    {
        return $this->stat_year;
    }

    /**
     * Set stat_month
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatMonth($p_value)
    {
        $this->stat_month = $p_value;
        return $this;
    }

    /**
     * Get stat_month
     *
     * @return int
     */
    public function getStatMonth()
    {
        return $this->stat_month;
    }

    /**
     * Set stat_nb
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatNb($p_value)
    {
        $this->stat_nb = $p_value;
        return $this;
    }

    /**
     * Get stat_nb
     *
     * @return int
     */
    public function getStatNb()
    {
        return $this->stat_nb;
    }

    /**
     * Set stat_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Statistic
     */
    public function setStatMnt($p_value)
    {
        $this->stat_mnt = $p_value;
        return $this;
    }

    /**
     * Get stat_mnt
     *
     * @return mixed
     */
    public function getStatMnt()
    {
        return $this->stat_mnt;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Statistic
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
}
