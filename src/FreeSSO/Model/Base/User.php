<?php
namespace FreeSSO\Model\Base;

/**
 * User
 *
 * @author jeromeklam
 */
abstract class User extends \FreeSSO\Model\StorageModel\User
{

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * user_login
     * @var string
     */
    protected $user_login = null;

    /**
     * user_password
     * @var string
     */
    protected $user_password = null;

    /**
     * user_active
     * @var bool
     */
    protected $user_active = null;

    /**
     * user_salt
     * @var string
     */
    protected $user_salt = null;

    /**
     * user_email
     * @var string
     */
    protected $user_email = null;

    /**
     * user_first_name
     * @var string
     */
    protected $user_first_name = null;

    /**
     * user_last_name
     * @var string
     */
    protected $user_last_name = null;

    /**
     * user_title
     * @var string
     */
    protected $user_title = null;

    /**
     * user_scope
     * @var mixed
     */
    protected $user_scope = null;

    /**
     * user_type
     * @var string
     */
    protected $user_type = null;

    /**
     * user_ips
     * @var mixed
     */
    protected $user_ips = null;

    /**
     * user_last_update
     * @var mixed
     */
    protected $user_last_update = null;

    /**
     * user_preferred_language
     * @var string
     */
    protected $user_preferred_language = null;

    /**
     * user_avatar
     * @var mixed
     */
    protected $user_avatar = null;

    /**
     * user_cache
     * @var mixed
     */
    protected $user_cache = null;

    /**
     * user_val_string
     * @var string
     */
    protected $user_val_string = null;

    /**
     * user_val_end
     * @var mixed
     */
    protected $user_val_end = null;

    /**
     * user_val_login
     * @var string
     */
    protected $user_val_login = null;

    /**
     * user_cnx
     * @var mixed
     */
    protected $user_cnx = null;

    /**
     * user_extern_code
     * @var string
     */
    protected $user_extern_code = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserId($p_value)
    {
        $this->user_id = $p_value;
        return $this;
    }

    /**
     * Get user_id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user_login
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserLogin($p_value)
    {
        $this->user_login = $p_value;
        return $this;
    }

    /**
     * Get user_login
     *
     * @return string
     */
    public function getUserLogin()
    {
        return $this->user_login;
    }

    /**
     * Set user_password
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserPassword($p_value)
    {
        $this->user_password = $p_value;
        return $this;
    }

    /**
     * Get user_password
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }

    /**
     * Set user_active
     *
     * @param bool $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserActive($p_value)
    {
        $this->user_active = $p_value;
        return $this;
    }

    /**
     * Get user_active
     *
     * @return bool
     */
    public function getUserActive()
    {
        return $this->user_active;
    }

    /**
     * Set user_salt
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserSalt($p_value)
    {
        $this->user_salt = $p_value;
        return $this;
    }

    /**
     * Get user_salt
     *
     * @return string
     */
    public function getUserSalt()
    {
        return $this->user_salt;
    }

    /**
     * Set user_email
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserEmail($p_value)
    {
        $this->user_email = $p_value;
        return $this;
    }

    /**
     * Get user_email
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * Set user_first_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserFirstName($p_value)
    {
        $this->user_first_name = $p_value;
        return $this;
    }

    /**
     * Get user_first_name
     *
     * @return string
     */
    public function getUserFirstName()
    {
        return $this->user_first_name;
    }

    /**
     * Set user_last_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserLastName($p_value)
    {
        $this->user_last_name = $p_value;
        return $this;
    }

    /**
     * Get user_last_name
     *
     * @return string
     */
    public function getUserLastName()
    {
        return $this->user_last_name;
    }

    /**
     * Set user_title
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserTitle($p_value)
    {
        $this->user_title = $p_value;
        return $this;
    }

    /**
     * Get user_title
     *
     * @return string
     */
    public function getUserTitle()
    {
        return $this->user_title;
    }

    /**
     * Set user_scope
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserScope($p_value)
    {
        $this->user_scope = $p_value;
        return $this;
    }

    /**
     * Get user_scope
     *
     * @return mixed
     */
    public function getUserScope()
    {
        return $this->user_scope;
    }

    /**
     * Set user_type
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserType($p_value)
    {
        $this->user_type = $p_value;
        return $this;
    }

    /**
     * Get user_type
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * Set user_ips
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserIps($p_value)
    {
        $this->user_ips = $p_value;
        return $this;
    }

    /**
     * Get user_ips
     *
     * @return mixed
     */
    public function getUserIps()
    {
        return $this->user_ips;
    }

    /**
     * Set user_last_update
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserLastUpdate($p_value)
    {
        $this->user_last_update = $p_value;
        return $this;
    }

    /**
     * Get user_last_update
     *
     * @return mixed
     */
    public function getUserLastUpdate()
    {
        return $this->user_last_update;
    }

    /**
     * Set user_preferred_language
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserPreferredLanguage($p_value)
    {
        $this->user_preferred_language = $p_value;
        return $this;
    }

    /**
     * Get user_preferred_language
     *
     * @return string
     */
    public function getUserPreferredLanguage()
    {
        return $this->user_preferred_language;
    }

    /**
     * Set user_avatar
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserAvatar($p_value)
    {
        $this->user_avatar = $p_value;
        return $this;
    }

    /**
     * Get user_avatar
     *
     * @return mixed
     */
    public function getUserAvatar()
    {
        return $this->user_avatar;
    }

    /**
     * Set user_cache
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserCache($p_value)
    {
        $this->user_cache = $p_value;
        return $this;
    }

    /**
     * Get user_cache
     *
     * @return mixed
     */
    public function getUserCache()
    {
        return $this->user_cache;
    }

    /**
     * Set user_val_string
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserValString($p_value)
    {
        $this->user_val_string = $p_value;
        return $this;
    }

    /**
     * Get user_val_string
     *
     * @return string
     */
    public function getUserValString()
    {
        return $this->user_val_string;
    }

    /**
     * Set user_val_end
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserValEnd($p_value)
    {
        $this->user_val_end = $p_value;
        return $this;
    }

    /**
     * Get user_val_end
     *
     * @return mixed
     */
    public function getUserValEnd()
    {
        return $this->user_val_end;
    }

    /**
     * Set user_val_login
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserValLogin($p_value)
    {
        $this->user_val_login = $p_value;
        return $this;
    }

    /**
     * Get user_val_login
     *
     * @return string
     */
    public function getUserValLogin()
    {
        return $this->user_val_login;
    }

    /**
     * Set user_cnx
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserCnx($p_value)
    {
        $this->user_cnx = $p_value;
        return $this;
    }

    /**
     * Get user_cnx
     *
     * @return mixed
     */
    public function getUserCnx()
    {
        return $this->user_cnx;
    }

    /**
     * Set user_extern_code
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setUserExternCode($p_value)
    {
        $this->user_extern_code = $p_value;
        return $this;
    }

    /**
     * Get user_extern_code
     *
     * @return string
     */
    public function getUserExternCode()
    {
        return $this->user_extern_code;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\User
     */
    public function setLangId($p_value)
    {
        $this->lang_id = $p_value;
        return $this;
    }

    /**
     * Get lang_id
     *
     * @return int
     */
    public function getLangId()
    {
        return $this->lang_id;
    }
}
