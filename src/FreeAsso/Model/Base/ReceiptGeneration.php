<?php
namespace FreeAsso\Model\Base;

/**
 * ReceiptGeneration
 *
 * @author jeromeklam
 */
abstract class ReceiptGeneration extends \FreeAsso\Model\StorageModel\ReceiptGeneration
{

    /**
     * recg_id
     * @var int
     */
    protected $recg_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * recg_name
     * @var string
     */
    protected $recg_name = null;

    /**
     * recg_year
     * @var int
     */
    protected $recg_year = null;

    /**
     * recg_status
     * @var string
     */
    protected $recg_status = null;

    /**
     * recg_save
     * @var mixed
     */
    protected $recg_save = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * Set recg_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgId($p_value)
    {
        $this->recg_id = $p_value;
        return $this;
    }

    /**
     * Get recg_id
     *
     * @return int
     */
    public function getRecgId()
    {
        return $this->recg_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
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
     * Set recg_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgName($p_value)
    {
        $this->recg_name = $p_value;
        return $this;
    }

    /**
     * Get recg_name
     *
     * @return string
     */
    public function getRecgName()
    {
        return $this->recg_name;
    }

    /**
     * Set recg_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgYear($p_value)
    {
        $this->recg_year = $p_value;
        return $this;
    }

    /**
     * Get recg_year
     *
     * @return int
     */
    public function getRecgYear()
    {
        return $this->recg_year;
    }

    /**
     * Set recg_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgStatus($p_value)
    {
        $this->recg_status = $p_value;
        return $this;
    }

    /**
     * Get recg_status
     *
     * @return string
     */
    public function getRecgStatus()
    {
        return $this->recg_status;
    }

    /**
     * Set recg_save
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgSave($p_value)
    {
        $this->recg_save = $p_value;
        return $this;
    }

    /**
     * Get recg_save
     *
     * @return mixed
     */
    public function getRecgSave()
    {
        return $this->recg_save;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
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
