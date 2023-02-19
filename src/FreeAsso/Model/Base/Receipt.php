<?php
namespace FreeAsso\Model\Base;

/**
 * Receipt
 *
 * @author jeromeklam
 */
abstract class Receipt extends \FreeAsso\Model\StorageModel\Receipt
{

    /**
     * rec_id
     * @var int
     */
    protected $rec_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * cli_id
     * @var int
     */
    protected $cli_id = null;

    /**
     * rett_id
     * @var int
     */
    protected $rett_id = null;

    /**
     * rec_mode
     * @var string
     */
    protected $rec_mode = null;

    /**
     * rec_ts
     * @var mixed
     */
    protected $rec_ts = null;

    /**
     * rec_gen_ts
     * @var mixed
     */
    protected $rec_gen_ts = null;

    /**
     * rec_print_ts
     * @var mixed
     */
    protected $rec_print_ts = null;

    /**
     * rec_year
     * @var int
     */
    protected $rec_year = null;

    /**
     * rec_number
     * @var string
     */
    protected $rec_number = null;

    /**
     * rec_mnt
     * @var mixed
     */
    protected $rec_mnt = null;

    /**
     * rec_money
     * @var string
     */
    protected $rec_money = null;

    /**
     * rec_fullname
     * @var string
     */
    protected $rec_fullname = null;

    /**
     * rec_address1
     * @var string
     */
    protected $rec_address1 = null;

    /**
     * rec_address2
     * @var string
     */
    protected $rec_address2 = null;

    /**
     * rec_address3
     * @var string
     */
    protected $rec_address3 = null;

    /**
     * rec_cp
     * @var string
     */
    protected $rec_cp = null;

    /**
     * rec_town
     * @var string
     */
    protected $rec_town = null;

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
     * rec_email
     * @var string
     */
    protected $rec_email = null;

    /**
     * rec_send_method
     * @var string
     */
    protected $rec_send_method = null;

    /**
     * rec_mnt_letter
     * @var mixed
     */
    protected $rec_mnt_letter = null;

    /**
     * file_id
     * @var int
     */
    protected $file_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * rec_manual
     * @var bool
     */
    protected $rec_manual;

    /**
     * Numéro de rue
     * @var string
     */
    protected $rec_street_num = null;

    /**
     * Nom de rue
     * @var string
     */
    protected $rec_street_name = null;

    /**
     * Siren
     * @var string
     */
    protected $rec_siren = null;

    /**
     * Raison sociale
     * @var string
     */
    protected $rec_social_reason = null;

    /**
     * Titre
     * @var string
     */
    protected $rec_title = null;

    /**
     * Detail
     * @var string
     */
    protected $rec_detail = null;

    /**
     * Cash
     * @var bool
     */
    protected $rec_cash = false;

    /**
     * Check
     * @var bool
     */
    protected $rec_check = false;

    /**
     * Bank
     * @var bool
     */
    protected $rec_bank = false;

    /**
     * Autre
     * @var bool
     */
    protected $rec_other = false;

    /**
     * Nature
     * @var bool
     */
    protected $rec_nature = false;

    /**
     * Set rec_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecId($p_value)
    {
        $this->rec_id = $p_value;
        return $this;
    }

    /**
     * Get rec_id
     *
     * @return int
     */
    public function getRecId()
    {
        return $this->rec_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
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
     * Set cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
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
     * Set rett_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRettId($p_value)
    {
        $this->rett_id = $p_value;
        return $this;
    }

    /**
     * Get rett_id
     *
     * @return int
     */
    public function getRettId()
    {
        return $this->rett_id;
    }

    /**
     * Set rec_mode
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecMode($p_value)
    {
        $this->rec_mode = $p_value;
        return $this;
    }

    /**
     * Get rec_mode
     *
     * @return string
     */
    public function getRecMode()
    {
        return $this->rec_mode;
    }

    /**
     * Set rec_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecTs($p_value)
    {
        $this->rec_ts = $p_value;
        return $this;
    }

    /**
     * Get rec_ts
     *
     * @return mixed
     */
    public function getRecTs()
    {
        return $this->rec_ts;
    }

    /**
     * Set rec_gen_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecGenTs($p_value)
    {
        $this->rec_gen_ts = $p_value;
        return $this;
    }

    /**
     * Get rec_gen_ts
     *
     * @return mixed
     */
    public function getRecGenTs()
    {
        return $this->rec_gen_ts;
    }

    /**
     * Set rec_print_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecPrintTs($p_value)
    {
        $this->rec_print_ts = $p_value;
        return $this;
    }

    /**
     * Get rec_print_ts
     *
     * @return mixed
     */
    public function getRecPrintTs()
    {
        return $this->rec_print_ts;
    }

    /**
     * Set rec_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecYear($p_value)
    {
        $this->rec_year = $p_value;
        return $this;
    }

    /**
     * Get rec_year
     *
     * @return int
     */
    public function getRecYear()
    {
        return $this->rec_year;
    }

    /**
     * Set rec_number
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecNumber($p_value)
    {
        $this->rec_number = $p_value;
        return $this;
    }

    /**
     * Get rec_number
     *
     * @return string
     */
    public function getRecNumber()
    {
        return $this->rec_number;
    }

    /**
     * Set rec_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecMnt($p_value)
    {
        $this->rec_mnt = $p_value;
        return $this;
    }

    /**
     * Get rec_mnt
     *
     * @return mixed
     */
    public function getRecMnt()
    {
        return $this->rec_mnt;
    }

    /**
     * Set rec_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecMoney($p_value)
    {
        $this->rec_money = $p_value;
        return $this;
    }

    /**
     * Get rec_money
     *
     * @return string
     */
    public function getRecMoney()
    {
        return $this->rec_money;
    }

    /**
     * Set rec_fullname
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecFullname($p_value)
    {
        $this->rec_fullname = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_fullname
     *
     * @return string
     */
    public function getRecFullname()
    {
        return $this->rec_fullname;
    }

    /**
     * Set rec_address1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecAddress1($p_value)
    {
        $this->rec_address1 = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_address1
     *
     * @return string
     */
    public function getRecAddress1()
    {
        return $this->rec_address1;
    }

    /**
     * Set rec_address2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecAddress2($p_value)
    {
        $this->rec_address2 = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_address2
     *
     * @return string
     */
    public function getRecAddress2()
    {
        return $this->rec_address2;
    }

    /**
     * Set rec_address3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecAddress3($p_value)
    {
        $this->rec_address3 = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_address3
     *
     * @return string
     */
    public function getRecAddress3()
    {
        return $this->rec_address3;
    }

    /**
     * Set rec_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecCp($p_value)
    {
        $this->rec_cp = $p_value;
        return $this;
    }

    /**
     * Get rec_cp
     *
     * @return string
     */
    public function getRecCp()
    {
        return $this->rec_cp;
    }

    /**
     * Set rec_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecTown($p_value)
    {
        $this->rec_town = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_town
     *
     * @return string
     */
    public function getRecTown()
    {
        return $this->rec_town;
    }

    /**
     * Set cnty_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
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
     * @return \FreeAsso\Model\Receipt
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
     * Set rec_email
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecEmail($p_value)
    {
        $this->rec_email = $p_value;
        return $this;
    }

    /**
     * Get rec_email
     *
     * @return string
     */
    public function getRecEmail()
    {
        return $this->rec_email;
    }

    /**
     * Set rec_send_method
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecSendMethod($p_value)
    {
        $this->rec_send_method = $p_value;
        return $this;
    }

    /**
     * Get rec_send_method
     *
     * @return string
     */
    public function getRecSendMethod()
    {
        return $this->rec_send_method;
    }

    /**
     * Set rec_mnt_letter
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecMntLetter($p_value)
    {
        $this->rec_mnt_letter = $p_value;
        return $this;
    }

    /**
     * Get rec_mnt_letter
     *
     * @return mixed
     */
    public function getRecMntLetter()
    {
        return $this->rec_mnt_letter;
    }

    /**
     * Set file_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setFileId($p_value)
    {
        $this->file_id = $p_value;
        return $this;
    }

    /**
     * Get file_id
     *
     * @return int
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\Cause
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
     * Set rec_manual
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecManual($p_value)
    {
        $this->rec_manual = $p_value;
        return $this;
    }

    /**
     * Get rec_manual
     *
     * @return bool
     */
    public function getRecManual()
    {
        return $this->rec_manual;
    }

    /**
     * Set rec_street_num
     * 
     * @param string $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecStreetNum($p_value)
    {
        $this->rec_street_num = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_street_num
     * 
     * @return string
     */
    public function getRecStreetNum()
    {
        return $this->rec_street_num;
    }

    /**
     * Set rec_street_name
     * 
     * @param string $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecStreetName($p_value)
    {
        $this->rec_street_name = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_street_name
     * 
     * @return string
     */
    public function getRecStreetName()
    {
        return $this->rec_street_name;
    }

    /**
     * Set rec_siren
     * 
     * @param string $p_value
     * 
     * return \FreeAsso\Model\Receipt
     */
    public function setRecSiren($p_value)
    {
        $this->rec_siren = $p_value;
        return $this;
    }

    /**
     * Get rec_siren
     * 
     * @return string
     */
    public function getRecSiren()
    {
        return $this->rec_siren;
    }

    /**
     * Set rec_social_reason
     * 
     * @param string $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecSocialReason($p_value)
    {
        $this->rec_social_reason = \FreeFW\Tools\PBXString::postalString($p_value);
        return $this;
    }

    /**
     * Get rec_social_reason
     * 
     * @return string
     */
    public function getRecSocialReason()
    {
        return $this->rec_social_reason;
    }

    /**
     * Set rec_title
     * 
     * @param string $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecTitle($p_value)
    {
        $this->rec_title = $p_value;
        return $this;
    }

    /**
     * Get rec_title
     * 
     * @return string
     */
    public function getRecTitle()
    {
        return $this->rec_title;
    }

    /**
     * Set rec_detail
     * 
     * @param string $p_value;
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecDetail($p_value)
    {
        $this->rec_detail = $p_value;
        return $this;
    }

    /**
     * Get rec_detail
     * 
     * @return string
     */
    public function getRecDetail()
    {
        return $this->rec_detail;
    }

    /**
     * Set rec_cash
     * 
     * @param bool $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecCash($p_value)
    {
        $this->rec_cash = $p_value;
        return $this;
    }

    /**
     * Get rec_cash
     * 
     * @return bool
     */
    public function getRecCash()
    {
        return $this->rec_cash;
    }

    /**
     * Set rec_check
     * 
     * @param bool $p_value;
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecCheck($p_value)
    {
        $this->rec_check = $p_value;
        return $this;
    }

    /**
     * Get rec_check
     * 
     * @return bool
     */
    public function getRecCheck()
    {
        return $this->rec_check;
    }

    /**
     * Set rec_bank
     * 
     * @param bool $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecBank($p_value)
    {
        $this->rec_bank = $p_value;
        return $this;
    }

    /**
     * Get rec_bank
     * 
     * @return bool
     */
    public function getRecBank()
    {
        return $this->rec_bank;
    }

    /**
     * Set rec_other
     * 
     * @param bool $p_value
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecOther($p_value)
    {
        $this->rec_other = $p_value;
        return $this;
    }

    /**
     * Get rec_other
     * 
     * @return bool
     */
    public function getRecOther()
    {
        return $this->rec_other;
    }

    /**
     * Set rec_nature
     * 
     * @param bool $p_value;
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecNature($p_value)
    {
        $this->rec_nature = $p_value;
        return $this;
    }

    /**
     * Get rec_nature
     * 
     * @return bool
     */
    public function getRecNature()
    {
        return $this->rec_nature;
    }
}
