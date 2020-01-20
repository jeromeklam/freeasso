<?php
namespace FreeAsso\Model\Base;

/**
 * CauseMovement
 *
 * @author jeromeklam
 */
abstract class CauseMovement extends \FreeAsso\Model\StorageModel\CauseMovement
{

    /**
     * camv_id
     * @var int
     */
    protected $camv_id = null;

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
     * camv_site_from_id
     * @var int
     */
    protected $camv_site_from_id = null;

    /**
     * camv_site_to_id
     * @var int
     */
    protected $camv_site_to_id = null;

    /**
     * camv_ts
     * @var string
     */
    protected $camv_ts = null;

    /**
     * camv_start
     * @var string
     */
    protected $camv_start = null;

    /**
     * camv_to
     * @var string
     */
    protected $camv_to = null;

    /**
     * camv_comment
     * @var mixed
     */
    protected $camv_comment = null;

    /**
     * Set camv_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvId($p_value)
    {
        $this->camv_id = $p_value;
        return $this;
    }

    /**
     * Get camv_id
     *
     * @return int
     */
    public function getCamvId()
    {
        return $this->camv_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
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
     * @return \FreeAsso\Model\CauseMovement
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
     * Set camv_site_from_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvSiteFromId($p_value)
    {
        $this->camv_site_from_id = $p_value;
        return $this;
    }

    /**
     * Get camv_site_from_id
     *
     * @return int
     */
    public function getCamvSiteFromId()
    {
        return $this->camv_site_from_id;
    }

    /**
     * Set camv_site_to_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvSiteToId($p_value)
    {
        $this->camv_site_to_id = $p_value;
        return $this;
    }

    /**
     * Get camv_site_to_id
     *
     * @return int
     */
    public function getCamvSiteToId()
    {
        return $this->camv_site_to_id;
    }

    /**
     * Set camv_ts
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvTs($p_value)
    {
        $this->camv_ts = $p_value;
        return $this;
    }

    /**
     * Get camv_ts
     *
     * @return string
     */
    public function getCamvTs()
    {
        return $this->camv_ts;
    }

    /**
     * Set camv_start
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvStart($p_value)
    {
        $this->camv_start = $p_value;
        return $this;
    }

    /**
     * Get camv_start
     *
     * @return string
     */
    public function getCamvStart()
    {
        return $this->camv_start;
    }

    /**
     * Set camv_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvTo($p_value)
    {
        $this->camv_to = $p_value;
        return $this;
    }

    /**
     * Get camv_to
     *
     * @return string
     */
    public function getCamvTo()
    {
        return $this->camv_to;
    }

    /**
     * Set camv_comment
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setCamvComment($p_value)
    {
        $this->camv_comment = $p_value;
        return $this;
    }

    /**
     * Get camv_comment
     *
     * @return mixed
     */
    public function getCamvComment()
    {
        return $this->camv_comment;
    }
}
