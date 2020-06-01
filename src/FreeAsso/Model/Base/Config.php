<?php
namespace FreeAsso\Model\Base;

/**
 * Config
 *
 * @author jeromeklam
 */
abstract class Config extends \FreeAsso\Model\StorageModel\Config
{

    /**
     * acfg_id
     * @var int
     */
    protected $acfg_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * acfg_code
     * @var string
     */
    protected $acfg_code = null;

    /**
     * acfg_value
     * @var string
     */
    protected $acfg_value = null;

    /**
     * Set acfg_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Config
     */
    public function setAcfgId($p_value)
    {
        $this->acfg_id = $p_value;
        return $this;
    }

    /**
     * Get acfg_id
     *
     * @return int
     */
    public function getAcfgId()
    {
        return $this->acfg_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Config
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
     * Set acfg_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Config
     */
    public function setAcfgCode($p_value)
    {
        $this->acfg_code = $p_value;
        return $this;
    }

    /**
     * Get acfg_code
     *
     * @return string
     */
    public function getAcfgCode()
    {
        return $this->acfg_code;
    }

    /**
     * Set acfg_value
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Config
     */
    public function setAcfgValue($p_value)
    {
        $this->acfg_value = $p_value;
        return $this;
    }

    /**
     * Get acfg_value
     *
     * @return string
     */
    public function getAcfgValue()
    {
        return $this->acfg_value;
    }
}
