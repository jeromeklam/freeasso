<?php
namespace FreeAsso\Model\Base;

/**
 * SiteType
 *
 * @author jeromeklam
 */
abstract class SiteType extends \FreeAsso\Model\StorageModel\SiteType
{

    /**
     * sitt_id
     * @var int
     */
    protected $sitt_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * sitt_name
     * @var string
     */
    protected $sitt_name = null;

    /**
     * Set sitt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittId($p_value)
    {
        $this->sitt_id = $p_value;
        return $this;
    }

    /**
     * Get sitt_id
     *
     * @return int
     */
    public function getSittId()
    {
        return $this->sitt_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteType
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
     * Set sitt_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittName($p_value)
    {
        $this->sitt_name = $p_value;
        return $this;
    }

    /**
     * Get sitt_name
     *
     * @return string
     */
    public function getSittName()
    {
        return $this->sitt_name;
    }
}
