<?php
namespace FreeSSO\Model\Base;

/**
 * Group
 *
 * @author jeromeklam
 */
abstract class Group extends \FreeSSO\Model\StorageModel\Group
{

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * grpt_id
     * @var int
     */
    protected $grpt_id = null;

    /**
     * grp_code
     * @var string
     */
    protected $grp_code = null;

    /**
     * grp_name
     * @var string
     */
    protected $grp_name = null;

    /**
     * grp_address1
     * @var string
     */
    protected $grp_address1 = null;

    /**
     * grp_address2
     * @var string
     */
    protected $grp_address2 = null;

    /**
     * grp_address3
     * @var string
     */
    protected $grp_address3 = null;

    /**
     * grp_cp
     * @var string
     */
    protected $grp_cp = null;

    /**
     * grp_town
     * @var string
     */
    protected $grp_town = null;

    /**
     * cnty_id
     * @var int
     */
    protected $cnty_id = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * grp_from
     * @var mixed
     */
    protected $grp_from = null;

    /**
     * grp_to
     * @var mixed
     */
    protected $grp_to = null;

    /**
     * grp_parent_id
     * @var int
     */
    protected $grp_parent_id = null;

    /**
     * grp_money_code
     * @var string
     */
    protected $grp_money_code = null;

    /**
     * grp_money_input
     * @var string
     */
    protected $grp_money_input = null;

    /**
     * grp_logo
     * @var mixed
     */
    protected $grp_logo = null;

    /**
     * grp_email_header
     * @var mixed
     */
    protected $grp_email_header = null;

    /**
     * grp_email_footer
     * @var mixed
     */
    protected $grp_email_footer = null;

    /**
     * grp_sign
     * @var mixed
     */
    protected $grp_sign = null;

    /**
     * grp_realm_id
     * @var int
     */
    protected $grp_realm_id = null;

    /**
     * grp_config
     * @var mixed
     */
    protected $grp_config = null;

    /**
     * grp_phone
     * @var string
     */
    protected $grp_phone = null;

    /**
     * grp_email
     * @var string
     */
    protected $grp_email = null;

    /**
     * grp_site_url
     * @var string
     */
    protected $grp_site_url = null;

    /**
     * grp_email_payment
     * @var mixed
     */
    protected $grp_email_payment = null;

    /**
     * grp_dig_sign
     * @var string
     */
    protected $grp_dig_sign = null;

    /**
     * grp_siret
     * @var string
     */
    protected $grp_siret = null;

    /**
     * grp_siret_cpl
     * @var string
     */
    protected $grp_siret_cpl = null;

    /**
     * grp_receipt
     * @var string
     */
    protected $grp_receipt = null;

    /**
     * grp_sign2
     * @var mixed
     */
    protected $grp_sign2 = null;

    /**
     * grp_dig_sign2
     * @var string
     */
    protected $grp_dig_sign2 = null;

    /**
     * grp_cog
     * @var string
     */
    protected $grp_cog = null;

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Group
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
     * Set grpt_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrptId($p_value)
    {
        $this->grpt_id = $p_value;
        return $this;
    }

    /**
     * Get grpt_id
     *
     * @return int
     */
    public function getGrptId()
    {
        return $this->grpt_id;
    }

    /**
     * Set grp_code
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpCode($p_value)
    {
        $this->grp_code = $p_value;
        return $this;
    }

    /**
     * Get grp_code
     *
     * @return string
     */
    public function getGrpCode()
    {
        return $this->grp_code;
    }

    /**
     * Set grp_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpName($p_value)
    {
        $this->grp_name = $p_value;
        return $this;
    }

    /**
     * Get grp_name
     *
     * @return string
     */
    public function getGrpName()
    {
        return $this->grp_name;
    }

    /**
     * Set grp_address1
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpAddress1($p_value)
    {
        $this->grp_address1 = $p_value;
        return $this;
    }

    /**
     * Get grp_address1
     *
     * @return string
     */
    public function getGrpAddress1()
    {
        return $this->grp_address1;
    }

    /**
     * Set grp_address2
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpAddress2($p_value)
    {
        $this->grp_address2 = $p_value;
        return $this;
    }

    /**
     * Get grp_address2
     *
     * @return string
     */
    public function getGrpAddress2()
    {
        return $this->grp_address2;
    }

    /**
     * Set grp_address3
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpAddress3($p_value)
    {
        $this->grp_address3 = $p_value;
        return $this;
    }

    /**
     * Get grp_address3
     *
     * @return string
     */
    public function getGrpAddress3()
    {
        return $this->grp_address3;
    }

    /**
     * Set grp_cp
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpCp($p_value)
    {
        $this->grp_cp = $p_value;
        return $this;
    }

    /**
     * Get grp_cp
     *
     * @return string
     */
    public function getGrpCp()
    {
        return $this->grp_cp;
    }

    /**
     * Set grp_town
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpTown($p_value)
    {
        $this->grp_town = $p_value;
        return $this;
    }

    /**
     * Get grp_town
     *
     * @return string
     */
    public function getGrpTown()
    {
        return $this->grp_town;
    }

    /**
     * Set cnty_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setCntyId($p_value)
    {
        $this->cnty_id = $p_value;
        return $this;
    }

    /**
     * Get cnty_id
     *
     * @return int
     */
    public function getCntyId()
    {
        return $this->cnty_id;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Group
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

    /**
     * Set grp_from
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpFrom($p_value)
    {
        $this->grp_from = $p_value;
        return $this;
    }

    /**
     * Get grp_from
     *
     * @return mixed
     */
    public function getGrpFrom()
    {
        return $this->grp_from;
    }

    /**
     * Set grp_to
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpTo($p_value)
    {
        $this->grp_to = $p_value;
        return $this;
    }

    /**
     * Get grp_to
     *
     * @return mixed
     */
    public function getGrpTo()
    {
        return $this->grp_to;
    }

    /**
     * Set grp_parent_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpParentId($p_value)
    {
        $this->grp_parent_id = $p_value;
        return $this;
    }

    /**
     * Get grp_parent_id
     *
     * @return int
     */
    public function getGrpParentId()
    {
        return $this->grp_parent_id;
    }

    /**
     * Set grp_money_code
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpMoneyCode($p_value)
    {
        $this->grp_money_code = $p_value;
        return $this;
    }

    /**
     * Get grp_money_code
     *
     * @return string
     */
    public function getGrpMoneyCode()
    {
        return $this->grp_money_code;
    }

    /**
     * Set grp_money_input
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpMoneyInput($p_value)
    {
        $this->grp_money_input = $p_value;
        return $this;
    }

    /**
     * Get grp_money_input
     *
     * @return string
     */
    public function getGrpMoneyInput()
    {
        return $this->grp_money_input;
    }

    /**
     * Set grp_logo
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpLogo($p_value)
    {
        $this->grp_logo = $p_value;
        return $this;
    }

    /**
     * Get grp_logo
     *
     * @return mixed
     */
    public function getGrpLogo()
    {
        return $this->grp_logo;
    }

    /**
     * Set grp_email_header
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpEmailHeader($p_value)
    {
        $this->grp_email_header = $p_value;
        return $this;
    }

    /**
     * Get grp_email_header
     *
     * @return mixed
     */
    public function getGrpEmailHeader()
    {
        return $this->grp_email_header;
    }

    /**
     * Set grp_email_footer
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpEmailFooter($p_value)
    {
        $this->grp_email_footer = $p_value;
        return $this;
    }

    /**
     * Get grp_email_footer
     *
     * @return mixed
     */
    public function getGrpEmailFooter()
    {
        return $this->grp_email_footer;
    }

    /**
     * Set grp_sign
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpSign($p_value)
    {
        $this->grp_sign = $p_value;
        return $this;
    }

    /**
     * Get grp_sign
     *
     * @return mixed
     */
    public function getGrpSign()
    {
        return $this->grp_sign;
    }

    /**
     * Set grp_realm_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpRealmId($p_value)
    {
        $this->grp_realm_id = $p_value;
        return $this;
    }

    /**
     * Get grp_realm_id
     *
     * @return int
     */
    public function getGrpRealmId()
    {
        return $this->grp_realm_id;
    }

    /**
     * Set grp_config
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpConfig($p_value)
    {
        $this->grp_config = $p_value;
        return $this;
    }

    /**
     * Get grp_config
     *
     * @return mixed
     */
    public function getGrpConfig()
    {
        return $this->grp_config;
    }

    /**
     * Set grp_phone
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\Group
     */
    public function setPhone($p_value)
    {
        $this->grp_phone = $p_value;
        return $this;
    }

    /**
     * Get grp_phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->grp_phone;
    }

    /**
     * Set grp_email
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\Group
     */
    public function setGrpEmail($p_value)
    {
        $this->grp_email = $p_value;
        return $this;
    }

    /**
     * Get grp_email
     *
     * @return string
     */
    public function getGrpEmail()
    {
        return $this->grp_email;
    }

    /**
     * Set grp_site_url
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\Group
     */
    public function setGrpSiteUrl($p_value)
    {
        $this->grp_site_url = $p_value;
        return $this;
    }

    /**
     * Get grp_site_url
     *
     * @return string
     */
    public function getGrpSiteUrl()
    {
        return $this->grp_site_url;
    }

    /**
     * Set grp_email_payment
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpEmailPayment($p_value)
    {
        $this->grp_email_payment = $p_value;
        return $this;
    }

    /**
     * Get grp_email_header
     *
     * @return mixed
     */
    public function getGrpEmailPayment()
    {
        return $this->grp_email_payment;
    }

    /**
     * Set grp_dig_sign
     *
     * @param string $p_value
     * 
     * @return \FreeSSO\Model\Group
     */
    public function setGrpDigSign($p_value)
    {
        $this->grp_dig_sign = $p_value;
        return $this;
    }

    /**
     * Get grp_dig_sign
     *
     * @return string
     */
    public function getGrpDigSign()
    {
        return $this->grp_dig_sign;
    }

    /**
     * Set grp_siret
     *
     * @param string $p_value
     * 
     * @return \FreeSSO\Model\Group
     */
    public function setGrpSiret($p_value)
    {
        $this->grp_siret = $p_value;
        return $this;
    }

    /**
     * Get grp_siret
     *
     * @return string
     */
    public function getGrpSiret()
    {
        return $this->grp_siret;
    }

    /**
     * Set grp_siret_cpl
     *
     * @param string $p_value
     * 
     * @return \FreeSSO\Model\Group
     */
    public function setGrpSiretCpl($p_value)
    {
        $this->grp_siret_cpl = $p_value;
        return $this;
    }

    /**
     * Get grp_siret_cpl
     *
     * @return string
     */
    public function getGrpSiretCpl()
    {
        return $this->grp_siret_cpl;
    }

    /**
     * Set grp_receipt
     *
     * @param string $p_value
     * 
     * @return \FreeSSO\Model\Group
     */
    public function setGrpReceipt($p_value)
    {
        $this->grp_receipt = $p_value;
        return $this;
    }

    /**
     * Get grp_receipt
     *
     * @return string
     */
    public function getGrpReceipt()
    {
        return $this->grp_receipt;
    }

    /**
     * Set grp_sign2
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGrpSign2($p_value)
    {
        $this->grp_sign2 = $p_value;
        return $this;
    }

    /**
     * Get grp_sign2
     *
     * @return mixed
     */
    public function getGrpSign2()
    {
        return $this->grp_sign2;
    }

    /**
     * Set grp_dig_sign2
     *
     * @param string $p_value
     * 
     * @return \FreeSSO\Model\Group
     */
    public function setGrpDigSign2($p_value)
    {
        $this->grp_dig_sign2 = $p_value;
        return $this;
    }

    /**
     * Get grp_dig_sign2
     *
     * @return string
     */
    public function getGrpDigSign2()
    {
        return $this->grp_dig_sign2;
    }

    /**
     * Set grp_cog
     *
     * @param string $p_value
     * 
     * @return \FreeSSO\Model\Group
     */
    public function setGrpCog($p_value)
    {
        $this->grp_cog = $p_value;
        return $this;
    }

    /**
     * Get grp_cog
     *
     * @return string
     */
    public function getGrpCog()
    {
        return $this->grp_cog;
    }
}
