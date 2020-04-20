<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Receipt
 *
 * @author jeromeklam
 */
class Receipt extends \FreeAsso\Model\Base\Receipt
{

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
        $this->rec_id  = 0;
        $this->brk_id  = 0;
        $this->rec_ts  = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->rec_mnt = 0;
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
}
