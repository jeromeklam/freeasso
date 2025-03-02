<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Contract
{

    /**
     * Id
     * @var number
     */
    protected $ct_id = null;

    /**
     * Contract
     * @var \FreeAsso\Model\Contract
     */
    protected $contract = null;

    /**
     * Set contract id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\Contract
     */
    public function setCtId($p_id)
    {
        $this->ct_id = $p_id;
        if ($this->contract) {
            if ($this->contract->getCtId() != $this->ct_id) {
                $this->contract = null;
            }
        }
        return $this;
    }

    /**
     * Get contract id
     *
     * @return number
     */
    public function getCtId()
    {
        return $this->ct_id;
    }

    /**
     * Set contract
     *
     * @param \FreeAsso\Model\Contract $p_contract
     *
     * @return \FreeFW\Core\Model
     */
    public function setContract($p_contract)
    {
        $this->contract = $p_contract;
        if ($p_contract) {
            $this->ct_id = $p_contract->getCtId();
        }
        return $this;
    }

    /**
     * Get contract
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Contract
     */
    public function getContract($p_force = false)
    {
        if ($this->contract === null || $p_force) {
            if ($this->ct_id > 0) {
                $this->contract = \FreeAsso\Model\Contract::findFirst(['ct_id' => $this->ct_id]);
            } else {
                $this->contract = null;
            }
        }
        return $this->contract;
    }
}
