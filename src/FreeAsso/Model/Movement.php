<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Movement
 *
 * @author jeromeklam
 */
class Movement extends \FreeAsso\Model\Base\Movement
{

    /**
     * From site
     * @var \FreeAsso\Model\Site
     */
    protected $from_site = null;

    /**
     * To site
     * @var \FreeAsso\Model\Site
     */
    protected $to_site = null;

    /**
     * From client
     * @var \FreeAsso\Model\Client
     */
    protected $from_client = null;

    /**
     * To client
     * @var \FreeAsso\Model\Client
     */
    protected $to_client = null;

    /**
     * Causes
     * @var [\FreeAsso\Model\Cause]
     */
    protected $causes = [];

    /**
     * Set causes
     *
     * @param [\FreeAsso\Model\Cause $p_cause]
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCauses($p_causes)
    {
        $this->causes = $p_causes;
        return $this;
    }

    /**
     * Get causes
     *
     * @return [\FreeAsso\Model\Cause]
     */
    public function getCauses()
    {
        return $this->causes;
    }

    /**
     * Set from
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setFromSite($p_site)
    {
        $this->from_site = $p_site;
        return $this;
    }

    /**
     * Get from
     *
     * @return \FreeAsso\Model\Site
     */
    public function getFromSite()
    {
        return $this->from_site;
    }

    /**
     * Set to
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setToSite($p_site)
    {
        $this->to_site = $p_site;
        return $this;
    }

    /**
     * Get to
     *
     * @return \FreeAsso\Model\Site
     */
    public function getToSite()
    {
        return $this->to_site;
    }

    /**
     * Set from client
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setFromClient($p_client)
    {
        $this->from_client = $p_client;
        return $this;
    }

    /**
     * Get from client
     *
     * @return \FreeAsso\Model\Client
     */
    public function getFromClient()
    {
        return $this->from_client;
    }

    /**
     * Set to client
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setToClient($p_client)
    {
        $this->to_client = $p_client;
        return $this;
    }

    /**
     * Get To client
     *
     * @return \FreeAsso\Model\Client
     */
    public function getToClient()
    {
        return $this->to_client;
    }

    /**
     * After create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        return true;
    }
}
