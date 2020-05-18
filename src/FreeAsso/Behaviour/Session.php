<?php
namespace FreeAsso\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait session
{

    /**
     * Session
     * @var \FreeAsso\Model\Session
     */
    protected $session = null;

    /**
     * Set session
     *
     * @param \FreeAsso\Model\Session $p_session
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setSession($p_session)
    {
        $this->session = $p_session;
        return $this;
    }

    /**
     * Get session
     *
     * @return \FreeAsso\Model\Session
     */
    public function getSession()
    {
        if ($this->session === null) {
            if ($this->sess_id > 0) {
                $this->session = \FreeAsso\Model\Session::findFirst(['sess_id' => $this->sess_id]);
            }
        }
        return $this->session;
    }
}
