<?php
namespace FreeAsso\Model\Base;

/**
 * AccountingLine
 *
 * @author jeromeklam
 */
abstract class AccountingLine extends \FreeAsso\Model\StorageModel\AccountingLine
{

    /**
     * accl_id
     * @var int
     */
    protected $accl_id = null;

    /**
     * acch_id
     * @var int
     */
    protected $acch_id = null;

    /**
     * accl_ts
     * @var mixed
     */
    protected $accl_ts = null;

    /**
     * accl_amount
     * @var mixed
     */
    protected $accl_amount = null;

    /**
     * accl_label
     * @var string
     */
    protected $accl_label = null;

    /**
     * accl_ptyp_name
     * @var string
     */
    protected $accl_ptyp_name = null;

    /**
     * accl_complement
     * @var string
     */
    protected $accl_complement = null;

    /**
     * Set accl_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function setAcclId($p_value)
    {
        $this->accl_id = $p_value;
        return $this;
    }

    /**
     * Get accl_id
     *
     * @return int
     */
    public function getAcclId()
    {
        return $this->accl_id;
    }

    /**
     * Set acch_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
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
     * Set accl_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function setAcclTs($p_value)
    {
        $this->accl_ts = $p_value;
        return $this;
    }

    /**
     * Get accl_ts
     *
     * @return mixed
     */
    public function getAcclTs()
    {
        return $this->accl_ts;
    }

    /**
     * Set accl_amount
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function setAcclAmount($p_value)
    {
        $this->accl_amount = $p_value;
        return $this;
    }

    /**
     * Get accl_amount
     *
     * @return mixed
     */
    public function getAcclAmount()
    {
        return $this->accl_amount;
    }

    /**
     * Set accl_label
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function setAcclLabel($p_value)
    {
        $this->accl_label = $p_value;
        return $this;
    }

    /**
     * Get accl_label
     *
     * @return string
     */
    public function getAcclLabel()
    {
        return $this->accl_label;
    }

    /**
     * Set accl_ptyp_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function setAcclPtypName($p_value)
    {
        $this->accl_ptyp_name = $p_value;
        return $this;
    }

    /**
     * Get accl_ptyp_name
     *
     * @return string
     */
    public function getAcclPtypName()
    {
        return $this->accl_ptyp_name;
    }

    /**
     * Set accl_complement
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function setAcclComplement($p_value)
    {
        $this->accl_complement = $p_value;
        return $this;
    }

    /**
     * Get accl_complement
     *
     * @return string
     */
    public function getAcclComplement()
    {
        return $this->accl_complement;
    }
}
