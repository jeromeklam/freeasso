<?php
namespace FreeAsso\Model\Base;

/**
 * CauseLinkType
 *
 * @author jeromeklam
 */
abstract class CauseLinkType extends \FreeAsso\Model\StorageModel\CauseLinkType
{

    /**
     * cault_id
     * @var int
     */
    protected $cault_id = null;

    /**
     * cault_name
     * @var string
     */
    protected $cault_name = null;

    /**
     * ref_cault_id
     * @var int
     */
    protected $ref_cault_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * cault_family
     * @var string
     */
    protected $cault_family = null;

    /**
     * Set cault_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLinkType
     */
    public function setCaultId($p_value)
    {
        $this->cault_id = $p_value;
        return $this;
    }

    /**
     * Get cault_id
     *
     * @return int
     */
    public function getCaultId()
    {
        return $this->cault_id;
    }

    /**
     * Set cault_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseLinkType
     */
    public function setCaultName($p_value)
    {
        $this->cault_name = $p_value;
        return $this;
    }

    /**
     * Get cault_name
     *
     * @return string
     */
    public function getCaultName()
    {
        return $this->cault_name;
    }

    /**
     * Set ref_cault_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLinkType
     */
    public function setRefCaultId($p_value)
    {
        $this->ref_cault_id = $p_value;
        return $this;
    }

    /**
     * Get ref_cault_id
     *
     * @return int
     */
    public function getRefCaultId()
    {
        return $this->ref_cault_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLinkType
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
     * Set cault_family
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseLinkType
     */
    public function setCaultFamily($p_value)
    {
        $this->cault_family = $p_value;
        return $this;
    }

    /**
     * Get cault_family
     *
     * @return string
     */
    public function getCaultFamily()
    {
        return $this->cault_family;
    }
}
