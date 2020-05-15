<?php
namespace FreeAsso\Model\Base;

/**
 * Subspecies
 *
 * @author jeromeklam
 */
abstract class Subspecies extends \FreeAsso\Model\StorageModel\Subspecies
{

    /**
     * sspe_id
     * @var int
     */
    protected $sspe_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * spe_id
     * @var int
     */
    protected $spe_id = null;

    /**
     * sspe_name
     * @var string
     */
    protected $sspe_name = null;

    /**
     * sspe_scientific
     * @var string
     */
    protected $sspe_scientific = null;

    /**
     * Set sspe_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Subspecies
     */
    public function setSspeId($p_value)
    {
        $this->sspe_id = $p_value;
        return $this;
    }

    /**
     * Get sspe_id
     *
     * @return int
     */
    public function getSspeId()
    {
        return $this->sspe_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Subspecies
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
     * Set spe_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Subspecies
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
     * Set sspe_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Subspecies
     */
    public function setSspeName($p_value)
    {
        $this->sspe_name = $p_value;
        return $this;
    }

    /**
     * Get sspe_name
     *
     * @return string
     */
    public function getSspeName()
    {
        return $this->sspe_name;
    }

    /**
     * Set sspe_scientific
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Subspecies
     */
    public function setSspeScientific($p_value)
    {
        $this->sspe_scientific = $p_value;
        return $this;
    }

    /**
     * Get sspe_scientific
     *
     * @return string
     */
    public function getSspeScientific()
    {
        return $this->sspe_scientific;
    }
}
