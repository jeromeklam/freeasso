<?php
namespace FreeAsso\Model\Base;

/**
 * AccountingHeader
 *
 * @author jeromeklam
 */
abstract class AccountingHeader extends \FreeAsso\Model\StorageModel\AccountingHeader
{

    /**
     * acch_id
     * @var int
     */
    protected $acch_id = null;

    /**
     * acch_name
     * @var string
     */
    protected $acch_name = null;

    /**
     * acch_year
     * @var int
     */
    protected $acch_year = null;

    /**
     * acch_month
     * @var int
     */
    protected $acch_month = null;

    /**
     * acch_ts
     * @var mixed
     */
    protected $acch_ts = null;

    /**
     * acch_content
     * @var mixed
     */
    protected $acch_content = null;

    /**
     * acch_status
     * @var string
     */
    protected $acch_status = null;

    /**
     * acch_status_ts
     * @var mixed
     */
    protected $acch_status_ts = null;

    /**
     * acch_code
     * @var mixed
     */
    protected $acch_code = null;

    /**
     * acch_format
     * @var mixed
     */
    protected $acch_format = null;

    /**
     * Set acch_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchId($p_value)
    {
        $this->acch_id = $p_value;
        return $this;
    }

    /**
     * Get acch_id
     *
     * @return int
     */
    public function getAcchId()
    {
        return $this->acch_id;
    }

    /**
     * Set acch_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchName($p_value)
    {
        $this->acch_name = $p_value;
        return $this;
    }

    /**
     * Get acch_name
     *
     * @return string
     */
    public function getAcchName()
    {
        return $this->acch_name;
    }

    /**
     * Set acch_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchYear($p_value)
    {
        $this->acch_year = $p_value;
        return $this;
    }

    /**
     * Get acch_year
     *
     * @return int
     */
    public function getAcchYear()
    {
        return $this->acch_year;
    }

    /**
     * Set acch_month
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchMonth($p_value)
    {
        $this->acch_month = $p_value;
        return $this;
    }

    /**
     * Get acch_month
     *
     * @return int
     */
    public function getAcchMonth()
    {
        return $this->acch_month;
    }

    /**
     * Set acch_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchTs($p_value)
    {
        $this->acch_ts = $p_value;
        return $this;
    }

    /**
     * Get acch_ts
     *
     * @return mixed
     */
    public function getAcchTs()
    {
        return $this->acch_ts;
    }

    /**
     * Set acch_content
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchContent($p_value)
    {
        $this->acch_content = $p_value;
        return $this;
    }

    /**
     * Get acch_content
     *
     * @return mixed
     */
    public function getAcchContent()
    {
        return $this->acch_content;
    }

    /**
     * Set acch_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchStatus($p_value)
    {
        $this->acch_status = $p_value;
        return $this;
    }

    /**
     * Get acch_status
     *
     * @return string
     */
    public function getAcchStatus()
    {
        $this->acch_status_ts = \FreeFW\Tools\Date::getCurrentTimestamp();
        return $this->acch_status;
    }

    /**
     * Set acch_status_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchStatusTs($p_value)
    {
        $this->acch_status_ts = $p_value;
        return $this;
    }

    /**
     * Get acch_status_ts
     *
     * @return mixed
     */
    public function getAcchStatusTs()
    {
        return $this->acch_status_ts;
    }

    /**
     * Set acch_code
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchCode($p_value)
    {
        $this->acch_code = $p_value;
        return $this;
    }

    /**
     * Get acch_code
     *
     * @return mixed
     */
    public function getAcchCode()
    {
        return $this->acch_code;
    }

    /**
     * Set acch_format
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function setAcchFormat($p_value)
    {
        $this->acch_format = $p_value;
        return $this;
    }

    /**
     * Get acch_format
     *
     * @return mixed
     */
    public function getAcchFormat()
    {
        return $this->acch_format;
    }
}
