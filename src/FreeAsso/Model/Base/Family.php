<?php
namespace FreeAsso\Model\Base;

/**
 * Family
 *
 * @author jeromeklam
 */
abstract class Family extends \FreeAsso\Model\StorageModel\Family
{

    /**
     * fam_id
     * @var int
     */
    protected $fam_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * fam_name
     * @var string
     */
    protected $fam_name = null;

    /**
     * fam_desc
     * @var mixed
     */
    protected $fam_desc = null;

    /**
     * fam_parent_id
     * @var int
     */
    protected $fam_parent_id = null;

    /**
     * fam_position
     * @var string
     */
    protected $fam_position = null;

    /**
     * fam_left
     * @var string
     */
    protected $fam_left = null;

    /**
     * fam_right
     * @var string
     */
    protected $fam_right = null;

    /**
     * fam_level
     * @var string
     */
    protected $fam_level = null;

    /**
     * fam_code_int
     * @var string
     */
    protected $fam_code_int = null;

    /**
     * Set fam_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamId($p_value)
    {
        $this->fam_id = $p_value;
        return $this;
    }

    /**
     * Get fam_id
     *
     * @return int
     */
    public function getFamId()
    {
        return $this->fam_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Family
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
     * Set fam_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamName($p_value)
    {
        $this->fam_name = $p_value;
        return $this;
    }

    /**
     * Get fam_name
     *
     * @return string
     */
    public function getFamName()
    {
        return $this->fam_name;
    }

    /**
     * Set fam_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamDesc($p_value)
    {
        $this->fam_desc = $p_value;
        return $this;
    }

    /**
     * Get fam_desc
     *
     * @return mixed
     */
    public function getFamDesc()
    {
        return $this->fam_desc;
    }

    /**
     * Set fam_parent_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamParentId($p_value)
    {
        $this->fam_parent_id = $p_value;
        return $this;
    }

    /**
     * Get fam_parent_id
     *
     * @return int
     */
    public function getFamParentId()
    {
        return $this->fam_parent_id;
    }

    /**
     * Set fam_position
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamPosition($p_value)
    {
        $this->fam_position = $p_value;
        return $this;
    }

    /**
     * Get fam_position
     *
     * @return string
     */
    public function getFamPosition()
    {
        return $this->fam_position;
    }

    /**
     * Set fam_left
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamLeft($p_value)
    {
        $this->fam_left = $p_value;
        return $this;
    }

    /**
     * Get fam_left
     *
     * @return string
     */
    public function getFamLeft()
    {
        return $this->fam_left;
    }

    /**
     * Set fam_right
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamRight($p_value)
    {
        $this->fam_right = $p_value;
        return $this;
    }

    /**
     * Get fam_right
     *
     * @return string
     */
    public function getFamRight()
    {
        return $this->fam_right;
    }

    /**
     * Set fam_level
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamLevel($p_value)
    {
        $this->fam_level = $p_value;
        return $this;
    }

    /**
     * Get fam_level
     *
     * @return string
     */
    public function getFamLevel()
    {
        return $this->fam_level;
    }

    /**
     * Set fam_code_int
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Family
     */
    public function setFamCodeInt($p_value)
    {
        $this->fam_code_int = $p_value;
        return $this;
    }

    /**
     * Get fam_code_int
     *
     * @return string
     */
    public function getFamCodeInt()
    {
        return $this->fam_code_int;
    }
}
