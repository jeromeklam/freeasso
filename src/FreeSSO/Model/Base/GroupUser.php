<?php
namespace FreeSSO\Model\Base;

/**
 * GroupUser
 *
 * @author jeromeklam
 */
abstract class GroupUser extends \FreeSSO\Model\StorageModel\GroupUser
{

    /**
     * gru_id
     * @var int
     */
    protected $gru_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * fct_id
     * @var int
     */
    protected $fct_id = null;

    /**
     * gru_scope
     * @var mixed
     */
    protected $gru_scope = null;

    /**
     * gru_tel1
     * @var string
     */
    protected $gru_tel1 = null;

    /**
     * gru_tel2
     * @var string
     */
    protected $gru_tel2 = null;

    /**
     * gru_email
     * @var string
     */
    protected $gru_email = null;

    /**
     * gru_from
     * @var mixed
     */
    protected $gru_from = null;

    /**
     * gru_to
     * @var mixed
     */
    protected $gru_to = null;

    /**
     * gru_activ
     * @var bool
     */
    protected $gru_activ = null;

    /**
     * gru_ts
     * @var mixed
     */
    protected $gru_ts = null;

    /**
     * gru_extern_id
     * @var string
     */
    protected $gru_extern_id = null;

    /**
     * gru_informations
     * @var mixed
     */
    protected $gru_informations = null;

    /**
     * gru_rgpd
     * @var mixed
     */
    protected $gru_rgpd = null;

    /**
     * gru_permissions
     * @var string
     */
    protected $gru_permissions = null;

    /**
     * Set gru_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruId($p_value)
    {
        $this->gru_id = $p_value;
        return $this;
    }

    /**
     * Get gru_id
     *
     * @return int
     */
    public function getGruId()
    {
        return $this->gru_id;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGrpId($p_value)
    {
        $this->grp_id = $p_value;
        return $this;
    }

    /**
     * Get grp_id
     *
     * @return int
     */
    public function getGrpId()
    {
        return $this->grp_id;
    }

    /**
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\GroupUser
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
     * Set fct_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setFctId($p_value)
    {
        $this->fct_id = $p_value;
        return $this;
    }

    /**
     * Get fct_id
     *
     * @return int
     */
    public function getFctId()
    {
        return $this->fct_id;
    }

    /**
     * Set gru_scope
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruScope($p_value)
    {
        $this->gru_scope = $p_value;
        return $this;
    }

    /**
     * Get gru_scope
     *
     * @return mixed
     */
    public function getGruScope()
    {
        return $this->gru_scope;
    }

    /**
     * Set gru_tel1
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruTel1($p_value)
    {
        $this->gru_tel1 = $p_value;
        return $this;
    }

    /**
     * Get gru_tel1
     *
     * @return string
     */
    public function getGruTel1()
    {
        return $this->gru_tel1;
    }

    /**
     * Set gru_tel2
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruTel2($p_value)
    {
        $this->gru_tel2 = $p_value;
        return $this;
    }

    /**
     * Get gru_tel2
     *
     * @return string
     */
    public function getGruTel2()
    {
        return $this->gru_tel2;
    }

    /**
     * Set gru_email
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruEmail($p_value)
    {
        $this->gru_email = $p_value;
        return $this;
    }

    /**
     * Get gru_email
     *
     * @return string
     */
    public function getGruEmail()
    {
        return $this->gru_email;
    }

    /**
     * Set gru_from
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruFrom($p_value)
    {
        $this->gru_from = $p_value;
        return $this;
    }

    /**
     * Get gru_from
     *
     * @return mixed
     */
    public function getGruFrom()
    {
        return $this->gru_from;
    }

    /**
     * Set gru_to
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruTo($p_value)
    {
        $this->gru_to = $p_value;
        return $this;
    }

    /**
     * Get gru_to
     *
     * @return mixed
     */
    public function getGruTo()
    {
        return $this->gru_to;
    }

    /**
     * Set gru_activ
     *
     * @param bool $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruActiv($p_value)
    {
        $this->gru_activ = $p_value;
        return $this;
    }

    /**
     * Get gru_activ
     *
     * @return bool
     */
    public function getGruActiv()
    {
        return $this->gru_activ;
    }

    /**
     * Set gru_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruTs($p_value)
    {
        $this->gru_ts = $p_value;
        return $this;
    }

    /**
     * Get gru_ts
     *
     * @return mixed
     */
    public function getGruTs()
    {
        return $this->gru_ts;
    }

    /**
     * Set gru_extern_id
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruExternId($p_value)
    {
        $this->gru_extern_id = $p_value;
        return $this;
    }

    /**
     * Get gru_extern_id
     *
     * @return string
     */
    public function getGruExternId()
    {
        return $this->gru_extern_id;
    }

    /**
     * Set gru_informations
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruInformations($p_value)
    {
        $this->gru_informations = $p_value;
        return $this;
    }

    /**
     * Get gru_informations
     *
     * @return mixed
     */
    public function getGruInformations()
    {
        return $this->gru_informations;
    }

    /**
     * Set gru_rgpd
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGruRgpd($p_value)
    {
        $this->gru_rgpd = $p_value;
        return $this;
    }

    /**
     * Get gru_rgpd
     *
     * @return mixed
     */
    public function getGruRgpd()
    {
        return $this->gru_rgpd;
    }

    /**
     * Set gru_permissions
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\GroupUser
     */
    public function setGruPermissions($p_value)
    {
        $this->gru_permissions = $p_value;
        return $this;
    }

    /**
     * Get gru_permissions
     *
     * @return string
     */
    public function getGruPermissions()
    {
        return $this->gru_permissions;
    }
}
