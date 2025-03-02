<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * AutologinCookie
 *
 * @author jeromeklam
 */
class AutologinCookie extends \FreeSSO\Model\Base\AutologinCookie
{

    /**
     * Prevent from saving history
     * @var bool
     */
    protected $no_history = true;

    /**
     * Generate autologinCookie
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    protected function generateAutoCookie()
    {
        if ($this->auto_cookie == '') {
            $this->auto_cookie = hash('sha256', uniqid(microtime(), true));
        }
        return $this;
    }

    /**
     * Get uniq hash
     * @return boolean
     */
    public function beforeCreate()
    {
        $this->generateAutoCookie();
        return true;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->user_id = 0;
        $this->generateAutoCookie();
        return $this;
    }
}
