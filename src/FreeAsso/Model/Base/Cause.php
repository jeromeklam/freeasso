<?php
namespace FreeAsso\Model\Base;

/**
 * Cause
 *
 * @author jeromeklam
 */
abstract class Cause extends \FreeAsso\Model\StorageModel\Cause
{

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * caut_id
     * @var int
     */
    protected $caut_id = null;

    /**
     * cau_name
     * @var string
     */
    protected $cau_name = null;

    /**
     * cau_desc
     * @var mixed
     */
    protected $cau_desc = null;

    /**
     * cau_from
     * @var string
     */
    protected $cau_from = null;

    /**
     * cau_to
     * @var string
     */
    protected $cau_to = null;

    /**
     * cau_public
     * @var string
     */
    protected $cau_public = null;

    /**
     * site_id
     * @var int
     */
    protected $site_id = null;

    /**
     * cau_mnt
     * @var string
     */
    protected $cau_mnt = null;

    /**
     * cau_code
     * @var string
     */
    protected $cau_code = null;

    /**
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
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
     * Set caut_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCautId($p_value)
    {
        $this->caut_id = $p_value;
        return $this;
    }

    /**
     * Get caut_id
     *
     * @return int
     */
    public function getCautId()
    {
        return $this->caut_id;
    }

    /**
     * Set cau_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauName($p_value)
    {
        $this->cau_name = $p_value;
        return $this;
    }

    /**
     * Get cau_name
     *
     * @return string
     */
    public function getCauName()
    {
        return $this->cau_name;
    }

    /**
     * Set cau_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauDesc($p_value)
    {
        $this->cau_desc = $p_value;
        return $this;
    }

    /**
     * Get cau_desc
     *
     * @return mixed
     */
    public function getCauDesc()
    {
        return $this->cau_desc;
    }

    /**
     * Set cau_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauFrom($p_value)
    {
        $this->cau_from = $p_value;
        return $this;
    }

    /**
     * Get cau_from
     *
     * @return string
     */
    public function getCauFrom()
    {
        return $this->cau_from;
    }

    /**
     * Set cau_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauTo($p_value)
    {
        $this->cau_to = $p_value;
        return $this;
    }

    /**
     * Get cau_to
     *
     * @return string
     */
    public function getCauTo()
    {
        return $this->cau_to;
    }

    /**
     * Set cau_public
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauPublic($p_value)
    {
        $this->cau_public = $p_value;
        return $this;
    }

    /**
     * Get cau_public
     *
     * @return string
     */
    public function getCauPublic()
    {
        return $this->cau_public;
    }

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setSiteId($p_value)
    {
        $this->site_id = $p_value;
        return $this;
    }

    /**
     * Get site_id
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->site_id;
    }

    /**
     * Set cau_mnt
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauMnt($p_value)
    {
        $this->cau_mnt = $p_value;
        return $this;
    }

    /**
     * Get cau_mnt
     *
     * @return string
     */
    public function getCauMnt()
    {
        return $this->cau_mnt;
    }

    /**
     * Set cau_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauCode($p_value)
    {
        $this->cau_code = $p_value;
        return $this;
    }

    /**
     * Get cau_code
     *
     * @return string
     */
    public function getCauCode()
    {
        return $this->cau_code;
    }
}
