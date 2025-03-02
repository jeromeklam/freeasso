<?php
namespace FreeAsso\Model\Base;

/**
 * Species
 *
 * @author jeromeklam
 */
abstract class Species extends \FreeAsso\Model\StorageModel\Species
{

    /**
     * spe_id
     * @var int
     */
    protected $spe_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * spe_name
     * @var string
     */
    protected $spe_name = null;

    /**
     * spe_scientific
     * @var string
     */
    protected $spe_scientific = null;

    /**
     * Set spe_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Species
     */
    public function setSpeId($p_value)
    {
        $this->spe_id = $p_value;
        return $this;
    }

    /**
     * Get spe_id
     *
     * @return int
     */
    public function getSpeId()
    {
        return $this->spe_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Species
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
     * Set spe_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Species
     */
    public function setSpeName($p_value)
    {
        $this->spe_name = $p_value;
        return $this;
    }

    /**
     * Get spe_name
     *
     * @return string
     */
    public function getSpeName()
    {
        return $this->spe_name;
    }

    /**
     * Set spe_scientific
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Species
     */
    public function setSpeScientific($p_value)
    {
        $this->spe_scientific = $p_value;
        return $this;
    }

    /**
     * Get spe_scientific
     *
     * @return string
     */
    public function getSpeScientific()
    {
        return $this->spe_scientific;
    }
}
