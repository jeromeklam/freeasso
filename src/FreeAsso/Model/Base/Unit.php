<?php
namespace FreeAsso\Model\Base;

/**
 * Unit
 *
 * @author jeromeklam
 */
abstract class Unit extends \FreeAsso\Model\StorageModel\Unit
{

    /**
     * unit_id
     * @var int
     */
    protected $unit_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * unit_name
     * @var string
     */
    protected $unit_name = null;

    /**
     * unit_code
     * @var string
     */
    protected $unit_code = null;

    /**
     * Set unit_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Unit
     */
    public function setUnitId($p_value)
    {
        $this->unit_id = $p_value;
        return $this;
    }

    /**
     * Get unit_id
     *
     * @return int
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Unit
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
     * Set unit_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Unit
     */
    public function setUnitName($p_value)
    {
        $this->unit_name = $p_value;
        return $this;
    }

    /**
     * Get unit_name
     *
     * @return string
     */
    public function getUnitName()
    {
        return $this->unit_name;
    }

    /**
     * Set unit_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Unit
     */
    public function setUnitCode($p_value)
    {
        $this->unit_code = $p_value;
        return $this;
    }

    /**
     * Get unit_code
     *
     * @return string
     */
    public function getUnitCode()
    {
        return $this->unit_code;
    }
}
