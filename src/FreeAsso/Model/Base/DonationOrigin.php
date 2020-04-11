<?php
namespace FreeAsso\Model\Base;

/**
 * DonationOrigin
 *
 * @author jeromeklam
 */
abstract class DonationOrigin extends \FreeAsso\Model\StorageModel\DonationOrigin
{

    /**
     * dono_id
     * @var int
     */
    protected $dono_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * dono_ts
     * @var string
     */
    protected $dono_ts = null;

    /**
     * dono_origin
     * @var string
     */
    protected $dono_origin = null;

    /**
     * dono_comments
     * @var mixed
     */
    protected $dono_comments = null;

    /**
     * dono_year
     * @var string
     */
    protected $dono_year = null;

    /**
     * dono_month
     * @var string
     */
    protected $dono_month = null;

    /**
     * dono_status
     * @var string
     */
    protected $dono_status = null;

    /**
     * Set dono_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoId($p_value)
    {
        $this->dono_id = $p_value;
        return $this;
    }

    /**
     * Get dono_id
     *
     * @return int
     */
    public function getDonoId()
    {
        return $this->dono_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
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
     * Set dono_ts
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoTs($p_value)
    {
        $this->dono_ts = $p_value;
        return $this;
    }

    /**
     * Get dono_ts
     *
     * @return string
     */
    public function getDonoTs()
    {
        return $this->dono_ts;
    }

    /**
     * Set dono_origin
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoOrigin($p_value)
    {
        $this->dono_origin = $p_value;
        return $this;
    }

    /**
     * Get dono_origin
     *
     * @return string
     */
    public function getDonoOrigin()
    {
        return $this->dono_origin;
    }

    /**
     * Set dono_comments
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoComments($p_value)
    {
        $this->dono_comments = $p_value;
        return $this;
    }

    /**
     * Get dono_comments
     *
     * @return mixed
     */
    public function getDonoComments()
    {
        return $this->dono_comments;
    }

    /**
     * Set dono_year
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoYear($p_value)
    {
        $this->dono_year = $p_value;
        return $this;
    }

    /**
     * Get dono_year
     *
     * @return string
     */
    public function getDonoYear()
    {
        return $this->dono_year;
    }

    /**
     * Set dono_month
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoMonth($p_value)
    {
        $this->dono_month = $p_value;
        return $this;
    }

    /**
     * Get dono_month
     *
     * @return string
     */
    public function getDonoMonth()
    {
        return $this->dono_month;
    }

    /**
     * Set dono_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function setDonoStatus($p_value)
    {
        $this->dono_status = $p_value;
        return $this;
    }

    /**
     * Get dono_status
     *
     * @return string
     */
    public function getDonoStatus()
    {
        return $this->dono_status;
    }
}
