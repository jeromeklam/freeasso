<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseAlert
 *
 * @author jeromeklam
 */
class Alert extends \FreeAsso\Model\Base\Alert
{

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * Cause
     * @var \FreeAsso\Model\Site
     */
    protected $site = null;

    /**
     * Client
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->alert_id = 0;
        $this->brk_id   = 0;
        $this->cau_id   = null;
        $this->site_id  = null;
        $this->cli_id   = null;
        return $this;
    }

    /**
     * Set cause
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCause($p_cause)
    {
        $this->cause = $p_cause;
        return $this;
    }

    /**
     * Get cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * Set Site
     * 
     * @param \FreeAsso\Model\Site $p_site
     * 
     * @return \FreeAsso\Model\Alert
     */
    public function setSite($p_site)
    {
        $this->site = $p_site;
        return $this;
    }

    /**
     * Get site
     * 
     * @return \FreeAsso\Model\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set client
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Alert
     */
    public function setClient($p_client)
    {
        $this->client = $p_client;
        return $this;
    }

    /**
     * Get client
     * 
     * @return \FreeAsso\Model\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
