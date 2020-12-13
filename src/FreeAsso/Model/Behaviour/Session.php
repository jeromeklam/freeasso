<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Session
{

    /**
     * Session id
     * @var number
     */
    protected $sess_id = null;

    /**
     * Session
     * @var \FreeAsso\Model\Session
     */
    protected $session = null;

    /**
     * Set session id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\session
     */
    public function setSessId($p_id)
    {
        $this->sess_id = $p_id;
        if ($this->session) {
            if ($this->session->getSessId() != $p_id) {
                $this->session = null;
            }
        }
        return $this;
    }

    /**
     * Set session
     *
     * @param \FreeAsso\Model\Session $p_session
     *
     * @return \FreeFW\Core\Model
     */
    public function setSession($p_session)
    {
        $this->session = $p_session;
        if ($this->session) {
            $this->setSessId($this->session->getSessId());
        } else {
            $this->setSessId(null);
        }
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
