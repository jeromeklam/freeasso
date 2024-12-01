<?php
namespace FreeSSO\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Broker
{

    /**
     * Broker
     * @var \FreeSSO\Model\User
     */
    protected $broker = null;

    /**
     * Broker Id
     * @var number
     */
    protected $brk_id = null;

    /**
     * Set broker
     *
     * @param \FreeSSO\Model\User $p_broker
     *
     * @return \FreeFW\Core\Model
     */
    public function setBroker($p_broker)
    {
        $this->broker = $p_broker;
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            $this->setBrkId($this->broker->getBrkId());
        } else {
            $this->setBrkId(null);
        }
        return $this;
    }

    /**
     * Get broker
     *
     * @return \FreeSSO\Model\Broker
     */
    public function getBroker()
    {
        if ($this->broker === null) {
            if ($this->brk_id > 0) {
                $this->broker = \FreeSSO\Model\Broker::findFirst(['brk_id' => $this->brk_id]);
            }
        }
        return $this->broker;
    }

    /**
     * Set broker id
     *
     * @param number $p_id
     *
     * @return \FreeSSO\Model\Behaviour\Broker
     */
    public function setBrkId($p_id)
    {
        $this->brk_id = $p_id;
        if ($this->broker !== null) {
            if ($this->brk_id != $this->broker->getBrkId()) {
                $this->broker = null;
            }
        }
        return $this;
    }

    /**
     * Get broker id
     *
     * @return number
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }
}
