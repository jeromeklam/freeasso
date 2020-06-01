<?php
namespace FreeAsso\Model\Base;

/**
 * CauseGrowth
 *
 * @author jeromeklam
 */
abstract class CauseGrowth extends \FreeAsso\Model\StorageModel\CauseGrowth
{

    /**
     * grow_id
     * @var int
     */
    protected $grow_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * grow_ts
     * @var mixed
     */
    protected $grow_ts = null;

    /**
     * grow_weight
     * @var mixed
     */
    protected $grow_weight = null;

    /**
     * grow_height
     * @var mixed
     */
    protected $grow_height = null;

    /**
     * Set grow_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseGrowth
     */
    public function setGrowId($p_value)
    {
        $this->grow_id = $p_value;
        return $this;
    }

    /**
     * Get grow_id
     *
     * @return int
     */
    public function getGrowId()
    {
        return $this->grow_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseGrowth
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
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseGrowth
     */
    public function setCauId($p_value)
    {
        $this->cau_id = $p_value;
        return $this;
    }

    /**
     * Get cau_id
     *
     * @return int
     */
    public function getCauId()
    {
        return $this->cau_id;
    }

    /**
     * Set grow_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseGrowth
     */
    public function setGrowTs($p_value)
    {
        $this->grow_ts = $p_value;
        return $this;
    }

    /**
     * Get grow_ts
     *
     * @return mixed
     */
    public function getGrowTs()
    {
        return $this->grow_ts;
    }

    /**
     * Set grow_weight
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseGrowth
     */
    public function setGrowWeight($p_value)
    {
        $this->grow_weight = $p_value;
        return $this;
    }

    /**
     * Get grow_weight
     *
     * @return mixed
     */
    public function getGrowWeight()
    {
        return $this->grow_weight;
    }

    /**
     * Set grow_height
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseGrowth
     */
    public function setGrowHeight($p_value)
    {
        $this->grow_height = $p_value;
        return $this;
    }

    /**
     * Get grow_height
     *
     * @return mixed
     */
    public function getGrowHeight()
    {
        return $this->grow_height;
    }
}
