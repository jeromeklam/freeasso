<?php
namespace FreeAsso\Model\Base;

/**
 * Client
 *
 * @author jeromeklam
 */
abstract class Client extends \FreeAsso\Model\StorageModel\Client
{

    /**
     * cli_id
     * @var int
     */
    protected $cli_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * clic_id
     * @var int
     */
    protected $clic_id = null;

    /**
     * clit_id
     * @var int
     */
    protected $clit_id = null;

    /**
     * cli_gender
     * @var string
     */
    protected $cli_gender = null;

    /**
     * cli_firstname
     * @var string
     */
    protected $cli_firstname = null;

    /**
     * cli_lastname
     * @var string
     */
    protected $cli_lastname = null;

    /**
     * cli_address1
     * @var string
     */
    protected $cli_address1 = null;

    /**
     * cli_address2
     * @var string
     */
    protected $cli_address2 = null;

    /**
     * cli_address3
     * @var string
     */
    protected $cli_address3 = null;

    /**
     * cli_cp
     * @var string
     */
    protected $cli_cp = null;

    /**
     * cli_town
     * @var string
     */
    protected $cli_town = null;

    /**
     * cnty_id
     * @var int
     */
    protected $cnty_id = null;

    /**
     * cli_active
     * @var int
     */
    protected $cli_active = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * cli_prefs
     * @var mixed
     */
    protected $cli_prefs = null;

    /**
     * cli_avatar
     * @var mixed
     */
    protected $cli_avatar = null;

    /**
     * cli_phone_home
     * @var string
     */
    protected $cli_phone_home = null;

    /**
     * cli_phone_gsm
     * @var string
     */
    protected $cli_phone_gsm = null;

    /**
     * cli_desc
     * @var mixed
     */
    protected $cli_desc = null;

    /**
     * cli_email
     * @var string
     */
    protected $cli_email = null;

    /**
     * cli_email_2
     * @var string
     */
    protected $cli_email_2 = null;

    /**
     * cli_email_refused
     * @var string
     */
    protected $cli_email_refused = null;

    /**
     * cli_receipt
     * @var bool
     */
    protected $cli_receipt = null;

    /**
     * cli_certificat
     * @var bool
     */
    protected $cli_certificat = null;

    /**
     * cli_extern_id
     * @var string
     */
    protected $cli_extern_id = null;

    /**
     * cli_sponsor_id
     * @var int
     */
    protected $cli_sponsor_id = null;

    /**
     * last_don_id
     * @var int
     */
    protected $last_don_id = null;

    /**
     * cli_string_1
     * @var string
     */
    protected $cli_string_1 = null;

    /**
     * cli_string_2
     * @var string
     */
    protected $cli_string_2 = null;

    /**
     * cli_string_3
     * @var string
     */
    protected $cli_string_3 = null;

    /**
     * cli_string_4
     * @var string
     */
    protected $cli_string_4 = null;

    /**
     * cli_number_1
     * @var int
     */
    protected $cli_number_1 = null;

    /**
     * cli_number_2
     * @var int
     */
    protected $cli_number_2 = null;

    /**
     * cli_number_3
     * @var int
     */
    protected $cli_number_3 = null;

    /**
     * cli_number_4
     * @var int
     */
    protected $cli_number_4 = null;

    /**
     * cli_date_1
     * @var mixed
     */
    protected $cli_date_1 = null;

    /**
     * cli_date_2
     * @var mixed
     */
    protected $cli_date_2 = null;

    /**
     * cli_date_3
     * @var mixed
     */
    protected $cli_date_3 = null;

    /**
     * cli_date_4
     * @var mixed
     */
    protected $cli_date_4 = null;

    /**
     * cli_text_1
     * @var mixed
     */
    protected $cli_text_1 = null;

    /**
     * cli_text_2
     * @var mixed
     */
    protected $cli_text_2 = null;

    /**
     * cli_text_3
     * @var mixed
     */
    protected $cli_text_3 = null;

    /**
     * cli_text_4
     * @var mixed
     */
    protected $cli_text_4 = null;

    /**
     * cli_bool_1
     * @var bool
     */
    protected $cli_bool_1 = null;

    /**
     * cli_bool_2
     * @var bool
     */
    protected $cli_bool_2 = null;

    /**
     * cli_bool_3
     * @var bool
     */
    protected $cli_bool_3 = null;

    /**
     * cli_bool_4
     * @var bool
     */
    protected $cli_bool_4 = null;

    /**
     * cli_display_site
     * @var bool
     */
    protected $cli_display_site = null;

    /**
     * cli_send_news
     * @var bool
     */
    protected $cli_send_news = null;

    /**
     * cli_coord
     * @var string
     */
    protected $cli_coord = null;

    /**
     * cli_siren
     * @var string
     */
    protected $cli_siren = null;

    /**
     * cli_siret
     * @var string
     */
    protected $cli_siret = null;

    /**
     * Set cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliId($p_value)
    {
        $this->cli_id = $p_value;
        return $this;
    }

    /**
     * Get cli_id
     *
     * @return int
     */
    public function getCliId()
    {
        return $this->cli_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }

    /**
     * Get brk_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }

    /**
     * Set clic_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setClicId($p_value)
    {
        $this->clic_id = $p_value;
        return $this;
    }

    /**
     * Get clic_id
     *
     * @return int
     */
    public function getClicId()
    {
        return $this->clic_id;
    }

    /**
     * Set clit_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setClitId($p_value)
    {
        $this->clit_id = $p_value;
        return $this;
    }

    /**
     * Get clit_id
     *
     * @return int
     */
    public function getClitId()
    {
        return $this->clit_id;
    }

    /**
     * Set cli_gender
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliGender($p_value)
    {
        $this->cli_gender = $p_value;
        return $this;
    }

    /**
     * Get cli_gender
     *
     * @return string
     */
    public function getCliGender()
    {
        return $this->cli_gender;
    }

    /**
     * Set cli_firstname
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliFirstname($p_value)
    {
        $this->cli_firstname = $p_value;
        return $this;
    }

    /**
     * Get cli_firstname
     *
     * @return string
     */
    public function getCliFirstname()
    {
        return $this->cli_firstname;
    }

    /**
     * Set cli_lastname
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliLastname($p_value)
    {
        $this->cli_lastname = $p_value;
        return $this;
    }

    /**
     * Get cli_lastname
     *
     * @return string
     */
    public function getCliLastname()
    {
        return $this->cli_lastname;
    }

    /**
     * Set cli_address1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliAddress1($p_value)
    {
        $this->cli_address1 = $p_value;
        return $this;
    }

    /**
     * Get cli_address1
     *
     * @return string
     */
    public function getCliAddress1()
    {
        return $this->cli_address1;
    }

    /**
     * Set cli_address2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliAddress2($p_value)
    {
        $this->cli_address2 = $p_value;
        return $this;
    }

    /**
     * Get cli_address2
     *
     * @return string
     */
    public function getCliAddress2()
    {
        return $this->cli_address2;
    }

    /**
     * Set cli_address3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliAddress3($p_value)
    {
        $this->cli_address3 = $p_value;
        return $this;
    }

    /**
     * Get cli_address3
     *
     * @return string
     */
    public function getCliAddress3()
    {
        return $this->cli_address3;
    }

    /**
     * Set cli_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliCp($p_value)
    {
        $this->cli_cp = $p_value;
        return $this;
    }

    /**
     * Get cli_cp
     *
     * @return string
     */
    public function getCliCp()
    {
        return $this->cli_cp;
    }

    /**
     * Set cli_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliTown($p_value)
    {
        $this->cli_town = $p_value;
        return $this;
    }

    /**
     * Get cli_town
     *
     * @return string
     */
    public function getCliTown()
    {
        return $this->cli_town;
    }

    /**
     * Set cnty_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
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
     * Set cli_active
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliActive($p_value)
    {
        $this->cli_active = $p_value;
        return $this;
    }

    /**
     * Get cli_active
     *
     * @return int
     */
    public function getCliActive()
    {
        return $this->cli_active;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
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
     * Set cli_prefs
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliPrefs($p_value)
    {
        $this->cli_prefs = $p_value;
        return $this;
    }

    /**
     * Get cli_prefs
     *
     * @return mixed
     */
    public function getCliPrefs()
    {
        return $this->cli_prefs;
    }

    /**
     * Set cli_avatar
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliAvatar($p_value)
    {
        $this->cli_avatar = $p_value;
        return $this;
    }

    /**
     * Get cli_avatar
     *
     * @return mixed
     */
    public function getCliAvatar()
    {
        return $this->cli_avatar;
    }

    /**
     * Set cli_phone_home
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliPhoneHome($p_value)
    {
        $this->cli_phone_home = $p_value;
        return $this;
    }

    /**
     * Get cli_phone_home
     *
     * @return string
     */
    public function getCliPhoneHome()
    {
        return $this->cli_phone_home;
    }

    /**
     * Set cli_phone_gsm
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliPhoneGsm($p_value)
    {
        $this->cli_phone_gsm = $p_value;
        return $this;
    }

    /**
     * Get cli_phone_gsm
     *
     * @return string
     */
    public function getCliPhoneGsm()
    {
        return $this->cli_phone_gsm;
    }

    /**
     * Set cli_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliDesc($p_value)
    {
        $this->cli_desc = $p_value;
        return $this;
    }

    /**
     * Get cli_desc
     *
     * @return mixed
     */
    public function getCliDesc()
    {
        return $this->cli_desc;
    }

    /**
     * Set cli_email
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliEmail($p_value)
    {
        $this->cli_email = $p_value;
        return $this;
    }

    /**
     * Get cli_email
     *
     * @return string
     */
    public function getCliEmail()
    {
        return $this->cli_email;
    }

    /**
     * Set cli_email_2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliEmail_2($p_value)
    {
        $this->cli_email_2 = $p_value;
        return $this;
    }

    /**
     * Get cli_email_2
     *
     * @return string
     */
    public function getCliEmail_2()
    {
        return $this->cli_email_2;
    }

    /**
     * Set cli_email_refused
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliEmailRefused($p_value)
    {
        $this->cli_email_refused = $p_value;
        return $this;
    }

    /**
     * Get cli_email_refused
     *
     * @return string
     */
    public function getCliEmailRefused()
    {
        return $this->cli_email_refused;
    }

    /**
     * Set cli_receipt
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliReceipt($p_value)
    {
        $this->cli_receipt = $p_value;
        return $this;
    }

    /**
     * Get cli_receipt
     *
     * @return bool
     */
    public function getCliReceipt()
    {
        return $this->cli_receipt;
    }

    /**
     * Set cli_certificat
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliCertificat($p_value)
    {
        $this->cli_certificat = $p_value;
        return $this;
    }

    /**
     * Get cli_certificat
     *
     * @return bool
     */
    public function getCliCertificat()
    {
        return $this->cli_certificat;
    }

    /**
     * Set cli_extern_id
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliExternId($p_value)
    {
        $this->cli_extern_id = $p_value;
        return $this;
    }

    /**
     * Get cli_extern_id
     *
     * @return string
     */
    public function getCliExternId()
    {
        return $this->cli_extern_id;
    }

    /**
     * Set cli_sponsor_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliSponsorId($p_value)
    {
        $this->cli_sponsor_id = $p_value;
        return $this;
    }

    /**
     * Get cli_sponsor_id
     *
     * @return int
     */
    public function getCliSponsorId()
    {
        return $this->cli_sponsor_id;
    }

    /**
     * Set last_don_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setLastDonId($p_value)
    {
        $this->last_don_id = $p_value;
        return $this;
    }

    /**
     * Get last_don_id
     *
     * @return int
     */
    public function getLastDonId()
    {
        return $this->last_don_id;
    }

    /**
     * Set cli_string_1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliString_1($p_value)
    {
        $this->cli_string_1 = $p_value;
        return $this;
    }

    /**
     * Get cli_string_1
     *
     * @return string
     */
    public function getCliString_1()
    {
        return $this->cli_string_1;
    }

    /**
     * Set cli_string_2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliString_2($p_value)
    {
        $this->cli_string_2 = $p_value;
        return $this;
    }

    /**
     * Get cli_string_2
     *
     * @return string
     */
    public function getCliString_2()
    {
        return $this->cli_string_2;
    }

    /**
     * Set cli_string_3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliString_3($p_value)
    {
        $this->cli_string_3 = $p_value;
        return $this;
    }

    /**
     * Get cli_string_3
     *
     * @return string
     */
    public function getCliString_3()
    {
        return $this->cli_string_3;
    }

    /**
     * Set cli_string_4
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliString_4($p_value)
    {
        $this->cli_string_4 = $p_value;
        return $this;
    }

    /**
     * Get cli_string_4
     *
     * @return string
     */
    public function getCliString_4()
    {
        return $this->cli_string_4;
    }

    /**
     * Set cli_number_1
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliNumber_1($p_value)
    {
        $this->cli_number_1 = $p_value;
        return $this;
    }

    /**
     * Get cli_number_1
     *
     * @return int
     */
    public function getCliNumber_1()
    {
        return $this->cli_number_1;
    }

    /**
     * Set cli_number_2
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliNumber_2($p_value)
    {
        $this->cli_number_2 = $p_value;
        return $this;
    }

    /**
     * Get cli_number_2
     *
     * @return int
     */
    public function getCliNumber_2()
    {
        return $this->cli_number_2;
    }

    /**
     * Set cli_number_3
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliNumber_3($p_value)
    {
        $this->cli_number_3 = $p_value;
        return $this;
    }

    /**
     * Get cli_number_3
     *
     * @return int
     */
    public function getCliNumber_3()
    {
        return $this->cli_number_3;
    }

    /**
     * Set cli_number_4
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliNumber_4($p_value)
    {
        $this->cli_number_4 = $p_value;
        return $this;
    }

    /**
     * Get cli_number_4
     *
     * @return int
     */
    public function getCliNumber_4()
    {
        return $this->cli_number_4;
    }

    /**
     * Set cli_date_1
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliDate_1($p_value)
    {
        $this->cli_date_1 = $p_value;
        return $this;
    }

    /**
     * Get cli_date_1
     *
     * @return mixed
     */
    public function getCliDate_1()
    {
        return $this->cli_date_1;
    }

    /**
     * Set cli_date_2
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliDate_2($p_value)
    {
        $this->cli_date_2 = $p_value;
        return $this;
    }

    /**
     * Get cli_date_2
     *
     * @return mixed
     */
    public function getCliDate_2()
    {
        return $this->cli_date_2;
    }

    /**
     * Set cli_date_3
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliDate_3($p_value)
    {
        $this->cli_date_3 = $p_value;
        return $this;
    }

    /**
     * Get cli_date_3
     *
     * @return mixed
     */
    public function getCliDate_3()
    {
        return $this->cli_date_3;
    }

    /**
     * Set cli_date_4
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliDate_4($p_value)
    {
        $this->cli_date_4 = $p_value;
        return $this;
    }

    /**
     * Get cli_date_4
     *
     * @return mixed
     */
    public function getCliDate_4()
    {
        return $this->cli_date_4;
    }

    /**
     * Set cli_text_1
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliText_1($p_value)
    {
        $this->cli_text_1 = $p_value;
        return $this;
    }

    /**
     * Get cli_text_1
     *
     * @return mixed
     */
    public function getCliText_1()
    {
        return $this->cli_text_1;
    }

    /**
     * Set cli_text_2
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliText_2($p_value)
    {
        $this->cli_text_2 = $p_value;
        return $this;
    }

    /**
     * Get cli_text_2
     *
     * @return mixed
     */
    public function getCliText_2()
    {
        return $this->cli_text_2;
    }

    /**
     * Set cli_text_3
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliText_3($p_value)
    {
        $this->cli_text_3 = $p_value;
        return $this;
    }

    /**
     * Get cli_text_3
     *
     * @return mixed
     */
    public function getCliText_3()
    {
        return $this->cli_text_3;
    }

    /**
     * Set cli_text_4
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliText_4($p_value)
    {
        $this->cli_text_4 = $p_value;
        return $this;
    }

    /**
     * Get cli_text_4
     *
     * @return mixed
     */
    public function getCliText_4()
    {
        return $this->cli_text_4;
    }

    /**
     * Set cli_bool_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliBool_1($p_value)
    {
        $this->cli_bool_1 = $p_value;
        return $this;
    }

    /**
     * Get cli_bool_1
     *
     * @return bool
     */
    public function getCliBool_1()
    {
        return $this->cli_bool_1;
    }

    /**
     * Set cli_bool_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliBool_2($p_value)
    {
        $this->cli_bool_2 = $p_value;
        return $this;
    }

    /**
     * Get cli_bool_2
     *
     * @return bool
     */
    public function getCliBool_2()
    {
        return $this->cli_bool_2;
    }

    /**
     * Set cli_bool_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliBool_3($p_value)
    {
        $this->cli_bool_3 = $p_value;
        return $this;
    }

    /**
     * Get cli_bool_3
     *
     * @return bool
     */
    public function getCliBool_3()
    {
        return $this->cli_bool_3;
    }

    /**
     * Set cli_bool_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliBool_4($p_value)
    {
        $this->cli_bool_4 = $p_value;
        return $this;
    }

    /**
     * Get cli_bool_4
     *
     * @return bool
     */
    public function getCliBool_4()
    {
        return $this->cli_bool_4;
    }

    /**
     * Set cli_display_site
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliDisplaySite($p_value)
    {
        $this->cli_display_site = $p_value;
        return $this;
    }

    /**
     * Get cli_display_site
     *
     * @return bool
     */
    public function getCliDisplaySite()
    {
        return $this->cli_display_site;
    }

    /**
     * Set cli_send_news
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliSendNews($p_value)
    {
        $this->cli_send_news = $p_value;
        return $this;
    }

    /**
     * Get cli_send_news
     *
     * @return bool
     */
    public function getCliSendNews()
    {
        return $this->cli_send_news;
    }

    /**
     * Set cli_coord
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliCoord($p_value)
    {
        $this->cli_coord = $p_value;
        return $this;
    }

    /**
     * Get cli_coord
     *
     * @return string
     */
    public function getCliCoord()
    {
        return $this->cli_coord;
    }

    /**
     * Set cli_siren
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliSiren($p_value)
    {
        $this->cli_siren = $p_value;
        return $this;
    }

    /**
     * Get cli_siren
     *
     * @return string
     */
    public function getCliSiren()
    {
        return $this->cli_siren;
    }

    /**
     * Set cli_siret
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliSiret($p_value)
    {
        $this->cli_siret = $p_value;
        return $this;
    }

    /**
     * Get cli_siret
     *
     * @return string
     */
    public function getCliSiret()
    {
        return $this->cli_siret;
    }
}
