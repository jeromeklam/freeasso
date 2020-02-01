<?php
namespace FreeAsso\Model\Base;

/**
 * Alert
 *
 * @author jeromeklam
 */
abstract class Alert extends \FreeAsso\Model\StorageModel\Alert
{

    /**
     * alert_id
     * @var int
     */
    protected $alert_id = null;

    /**
     * site_id
     * @var int
     */
    protected $site_id = null;

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * cli_id
     * @var int
     */
    protected $cli_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * alert_from
     * @var string
     */
    protected $alert_from = null;

    /**
     * alert_to
     * @var string
     */
    protected $alert_to = null;

    /**
     * alert_ts
     * @var string
     */
    protected $alert_ts = null;

    /**
     * alert_text
     * @var mixed
     */
    protected $alert_text = null;

    /**
     * alert_activ
     * @var int
     */
    protected $alert_activ = null;

    /**
     * Set alert_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setAlertId($p_value)
    {
        $this->alert_id = $p_value;
        return $this;
    }

    /**
     * Get alert_id
     *
     * @return int
     */
    public function getAlertId()
    {
        return $this->alert_id;
    }

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Alert
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
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Alert
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
     * Set cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setCliId($p_value)
    {
        $this->cli_id = $p_value;
        return $this;
    }

    /**
     * Get cli_id
     *
     * @return int
     */
    public function getCliId()
    {
        return $this->cli_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Alert
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
     * Set alert_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setAlertFrom($p_value)
    {
        $this->alert_from = $p_value;
        return $this;
    }

    /**
     * Get alert_from
     *
     * @return string
     */
    public function getAlertFrom()
    {
        return $this->alert_from;
    }

    /**
     * Set alert_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setAlertTo($p_value)
    {
        $this->alert_to = $p_value;
        return $this;
    }

    /**
     * Get alert_to
     *
     * @return string
     */
    public function getAlertTo()
    {
        return $this->alert_to;
    }

    /**
     * Set alert_ts
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setAlertTs($p_value)
    {
        $this->alert_ts = $p_value;
        return $this;
    }

    /**
     * Get alert_ts
     *
     * @return string
     */
    public function getAlertTs()
    {
        return $this->alert_ts;
    }

    /**
     * Set alert_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setAlertText($p_value)
    {
        $this->alert_text = $p_value;
        return $this;
    }

    /**
     * Get alert_text
     *
     * @return mixed
     */
    public function getAlertText()
    {
        return $this->alert_text;
    }

    /**
     * Set alert_activ
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Alert
     */
    public function setAlertActiv($p_value)
    {
        $this->alert_activ = $p_value;
        return $this;
    }

    /**
     * Get alert_activ
     *
     * @return int
     */
    public function getAlertActiv()
    {
        return $this->alert_activ;
    }
}
