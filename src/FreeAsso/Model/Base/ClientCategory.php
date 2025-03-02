<?php
namespace FreeAsso\Model\Base;

/**
 * ClientCategory
 *
 * @author jeromeklam
 */
abstract class ClientCategory extends \FreeAsso\Model\StorageModel\ClientCategory
{

    /**
     * clic_id
     * @var int
     */
    protected $clic_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * clic_code
     * @var string
     */
    protected $clic_code = null;

    /**
     * clic_name
     * @var string
     */
    protected $clic_name = null;

    /**
     * clic_fields
     * @var string
     */
    protected $clic_fields = null;

    /**
     * Set clic_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ClientCategory
     */
    public function setClicId($p_value)
    {
        $this->clic_id = $p_value;
        return $this;
    }

    /**
     * Get clic_id
     *
     * @return int
     */
    public function getClicId()
    {
        return $this->clic_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ClientCategory
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
     * Set clic_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ClientCategory
     */
    public function setClicCode($p_value)
    {
        $this->clic_code = $p_value;
        return $this;
    }

    /**
     * Get clic_code
     *
     * @return string
     */
    public function getClicCode()
    {
        return $this->clic_code;
    }

    /**
     * Set clic_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ClientCategory
     */
    public function setClicName($p_value)
    {
        $this->clic_name = $p_value;
        return $this;
    }

    /**
     * Get clic_name
     *
     * @return string
     */
    public function getClicName()
    {
        return $this->clic_name;
    }

    /**
     * Set clic_fields
     * 
     * @param string $p_value
     * 
     * @return \FreeAsso\Model\ClientCategory
     */
    public function setClicFields($p_value)
    {
        $this->clic_fields = $p_value;
        return $this;
    }

    /**
     * Get clic_fields
     * 
     * @return string
     */
    public function getClicFields()
    {
        return $this->clic_fields;
    }
}
