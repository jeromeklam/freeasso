<?php
namespace FreeSSO\Model;

/**
 * BrokerSession
 *
 * @author : jeromeklam
 */
class BrokerSession extends \FreeSSO\Model\Base\BrokerSession
{

    /**
     * Prevent from saving history
     * @var bool
     */
    protected $no_history = true;

    /**
     * Session
     * @var \FreeSSO\Model\Session
     */
    protected $session;

    /**
     * Set session
     *
     * @param \FreeSSO\Model\Session $p_session
     *
     * @return \FreeSSO\Model\BrokerSession
     */
    public function setSession($p_session)
    {
        $this->session = $p_session;
        return $this;
    }

    /**
     * Get session
     *
     * @return \FreeSSO\Model\Session
     */
    public function getSession()
    {
        return $this->session;
    }
}
