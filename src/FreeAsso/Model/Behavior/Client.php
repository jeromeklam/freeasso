<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait Client
{

    /**
     * Id
     * @var number
     */
    protected $cli_id = null;

    /**
     * Client
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

    /**
     * Set client id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behavior\Client
     */
    public function setCliId($p_id)
    {
        $this->cli_id = $p_id;
        if ($this->client) {
            if ($this->client->getCliId() != $this->cli_id) {
                $this->client = null;
            }
        }
        return $this;
    }

    /**
     * Get client id
     *
     * @return number
     */
    public function getCliId()
    {
        return $this->cli_id;
    }

    /**
     * Set client
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeFW\Core\Model
     */
    public function setClient($p_client)
    {
        $this->client = $p_client;
        if ($p_client) {
            $this->cli_id = $p_client->getCliId();
        }
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
