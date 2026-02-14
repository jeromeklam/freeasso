<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait Contact1
{

    /**
     * Id
     * @var number
     */
    protected $ctx1_cli_id = null;

    /**
     * Contact1
     * @var \FreeAsso\Model\Client
     */
    protected $contact1 = null;

    /**
     * Set contact1 id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behavior\Contact1
     */
    public function setCtx1CliId($p_id)
    {
        $this->ctx1_cli_id = $p_id;
        if ($this->contact1) {
            if ($this->contact1->getCliId() != $this->ctx1_cli_id) {
                $this->contact1 = null;
            }
        }
        return $this;
    }

    /**
     * Get contact1 id
     *
     * @return number
     */
    public function getCtx1CliId()
    {
        return $this->ctx1_cli_id;
    }

    /**
     * Set contact1
     *
     * @param \FreeAsso\Model\Client $p_contact1
     *
     * @return \FreeFW\Core\Model
     */
    public function setContact1($p_contact1)
    {
        $this->contact1 = $p_contact1;
        if ($p_contact1) {
            $this->ctx1_cli_id = $p_contact1->getCliId();
        }
        return $this;
    }

    /**
     * Get contact1
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Client
     */
    public function getContact1($p_force = false)
    {
        if ($this->contact1 === null || $p_force) {
            if ($this->ctx1_cli_id > 0) {
                $this->contact1 = \FreeAsso\Model\Client::findFirst(['cli_id' => $this->ctx1_cli_id]);
            } else {
                $this->contact1 = null;
            }
        }
        return $this->contact1;
    }
}
