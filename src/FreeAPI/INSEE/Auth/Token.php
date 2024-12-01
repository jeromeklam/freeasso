<?php
namespace FreeAPI\INSEE\Auth;

/**
 * Token
 */
class Token
{

    /**
     * Token
     * @var string
     */
    protected $token = null;

    /**
     * Expires
     * @var \DateTime
     */
    protected $expires = null;

    /**
     * Constructor
     * 
     * @param string $p_token
     */
    public function __construct()
    {
        $this->token = null;
    }

    /**
     * Init 
     * 
     * @param string $p_token
     * 
     * @return \FreeAPI\INSEE\Auth\Token
     */
    public function init($p_token)
    {
        $this->token   = null;
        $this->expires = new \DateTime();
        // extract parts, cf __toString
        $parts = explode('@', $p_token); 
        if (count($parts) == 2) {
            $this->token   = $this->hDecodeToken($parts[0]);
            $this->expires = $this->hDecodeExpires($parts[1]);
        }
        return $this;
    }

    /**
     * Set token
     * 
     * @param string $p_token
     * 
     * @return \FreeAPI\INSEE\Auth\Token
     */
    public function setToken($p_token)
    {
        $this->token = $p_token;
        return $this;
    }

    /**
     * Set expires
     * 
     * @param \DateTime $p_expires
     * 
     * @return \FreeAPI\INSEE\Auth\Token
     */
    public function setExpires($p_expires)
    {
        $this->expires = $p_expires;
        return $this;
    }

    /**
     * Token is valid ?
     * 
     * @return bool
     */
    public function isValid()
    {
        if ($this->token != '') {
            if ($this->expires instanceof \DateTime) {
                $now = new \DateTime();
                return $this->expires > $now; 
            }
        }
        return false;
    }

    /**
     * Get ws header
     * 
     * @return string
     */
    public function getAuthorizationHeader()
    {
        return 'Bearer ' . $this->token;
    }

    /**
     * Save to string
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->hEncodeToken($this->token) . '@' . $this->hEncodeExpires($this->expires);
    }

    /**
     * Decode token
     * 
     * @param string $p_token
     * 
     * @return string
     */
    protected function hDecodeToken($p_token)
    {
        return $p_token;
    }

    /**
     * Encode token
     * 
     * @param string $p_token
     * 
     * @return string
     */
    protected function hEncodeToken($p_token)
    {
        return $p_token;
    }

    /**
     * Encode expires
     * 
     * @param mixed $p_expires
     * 
     * @return string
     */
    protected function hEncodeExpires($p_expires)
    {
        if (!$p_expires instanceof \DateTime) {
            $p_expires = new \DateTime();
        }
        return $p_expires->format('Y-m-d H:i:sP');
    }

    /**
     * Decode expires
     * 
     * @param string $p_expires
     * 
     * @return \DateTime
     */
    protected function hDecodeExpires($p_expires)
    {
        return new \DateTime($p_expires);
    }
}
