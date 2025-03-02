<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Contact2
{

    /**
     * Id
     * @var number
     */
    protected $ctx2_cli_id = null;

    /**
     * Contact2
     * @var \FreeAsso\Model\Client
     */
    protected $contact2 = null;

    /**
     * Set contact2 id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\Contact2
     */
    public function setCtx2CliId($p_id)
    {
        $this->ctx2_cli_id = $p_id;
        if ($this->contact2) {
            if ($this->contact2->getCliId() != $this->ctx2_cli_id) {
                $this->contact2 = null;
            }
        }
        return $this;
    }

    /**
     * Get contact2 id
     *
     * @return number
     */
    public function getCtx2CliId()
    {
        return $this->ctx2_cli_id;
    }

    /**
     * Set contact2
     *
     * @param \FreeAsso\Model\Client $p_contact2
     *
     * @return \FreeFW\Core\Model
     */
    public function setContact2($p_contact2)
    {
        $this->contact2 = $p_contact2;
        if ($p_contact2) {
            $this->ctx2_cli_id = $p_contact2->getCliId();
        }
        return $this;
    }

    /**
     * Get contact2
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Client
     */
    public function getContact2($p_force = false)
    {
        if ($this->contact2 === null || $p_force) {
            if ($this->ctx2_cli_id > 0) {
                $this->contact2 = \FreeAsso\Model\Client::findFirst(['cli_id' => $this->ctx2_cli_id]);
            } else {
                $this->contact2 = null;
            }
        }
        return $this->contact2;
    }
}
