<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait ClientCategory
{

    /**
     * ClientCategory
     * @var \FreeAsso\Model\ClientCategory
     */
    protected $client_category = null;

    /**
     * Set client_category
     *
     * @param \FreeAsso\Model\ClientCategory $p_client_category
     *
     * @return \FreeFW\Core\Model
     */
    public function setClientCategory($p_client_category)
    {
        $this->client_category = $p_client_category;
        return $this;
    }

    /**
     * Get client_category
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\ClientCategory
     */
    public function getClientCategory($p_force = false)
    {
        if ($this->client_category === null || $p_force) {
            if ($this->clic_id > 0) {
                $this->client_category = \FreeAsso\Model\ClientCategory::findFirst(['clic_id' => $this->clic_id]);
            } else {
                $this->client_category = null;
            }
        }
        return $this->client_category;
    }
}
