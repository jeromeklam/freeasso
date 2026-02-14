<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait ClientType
{

    /**
     * ClientType
     * @var \FreeAsso\Model\ClientType
     */
    protected $client_type = null;

    /**
     * Set client_type
     *
     * @param \FreeAsso\Model\ClientType $p_client_type
     *
     * @return \FreeFW\Core\Model
     */
    public function setClientType($p_client_type)
    {
        $this->client_type = $p_client_type;
        return $this;
    }

    /**
     * Get client_type
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function getClientType($p_force = false)
    {
        if ($this->client_type === null || $p_force) {
            if ($this->clit_id > 0) {
                $this->client_type = \FreeAsso\Model\ClientType::findFirst(['clit_id' => $this->clit_id]);
            } else {
                $this->client_type = null;
            }
        }
        return $this->client_type;
    }
}
