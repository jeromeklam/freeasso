<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Donation
 *
 * @author jeromeklam
 */
class Donation extends \FreeAsso\Model\Base\Donation
{

    /**
     * STATUS
     * @var string
     */
    const STATUS_OK   = 'OK';
    const STATUS_WAIT = 'WAIT';
    const STATUS_NEXT = 'NEXT';
    const STATUS_NOK  = 'NOK';

    /**
     * Cause
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->don_id = 0;
        $this->brk_id = 0;
        return $this;
    }

    /**
     * Set client
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Donation
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

    /**
     * Set cause
     * 
     * @param \FreeAsso\Model\Cause $p_cause
     * 
     * @return \FreeAsso\Model\Donation
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
}