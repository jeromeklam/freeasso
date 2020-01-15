<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Sponsorship
 *
 * @author jeromeklam
 */
class Sponsorship extends \FreeAsso\Model\Base\Sponsorship
{

    /**
     * 
     * @var string
     */
    const PAYMENT_TYPE_MONTH = 'MONTH';
    const PAYMENT_TYPE_YEAR  = 'YEAR';
    const PAYMENT_TYPE_OTHER = 'OTHER';

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

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
        $this->spo_id = 0;
        $this->brk_id = 0;
        return $this;
    }

    /**
     * Set cause
     * 
     * @param \FreeAsso\Model\Cause $p_cause
     * 
     * @return \FreeAsso\Model\Sponsorship
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
     * Set client
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Sponsorship
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
