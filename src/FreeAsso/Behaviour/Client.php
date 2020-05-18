<?php
namespace FreeAsso\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Client
{

    /**
     * Client
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

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
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Client
     */
    public function getClient($p_force = false)
    {
        if ($this->client === null || $p_force) {
            if ($this->cli_id > 0) {
                $this->client = \FreeAsso\Model\Client::findFirst(['cli_id' => $this->cli_id]);
            } else {
                $this->client = null;
            }
        }
        return $this->client;
    }
}
