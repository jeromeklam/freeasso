<?php
namespace FreeAsso\Model\Base;

/**
 * Donation
 *
 * @author jeromeklam
 */
abstract class Donation extends \FreeAsso\Model\StorageModel\Donation
{

    /**
     * don_id
     * @var int
     */
    protected $don_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * cli_id
     * @var int
     */
    protected $cli_id = null;

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * spo_id
     * @var int
     */
    protected $spo_id = null;

    /**
     * don_desc
     * @var mixed
     */
    protected $don_desc = null;

    /**
     * don_ts
     * @var mixed
     */
    protected $don_ts = null;

    /**
     * don_ask_ts
     * @var mixed
     */
    protected $don_ask_ts = null;

    /**
     * don_real_ts
     * @var mixed
     */
    protected $don_real_ts = null;

    /**
     * don_end_ts
     * @var mixed
     */
    protected $don_end_ts = null;

    /**
     * don_status
     * @var string
     */
    protected $don_status = null;

    /**
     * don_mnt
     * @var mixed
     */
    protected $don_mnt = null;

    /**
     * don_money
     * @var string
     */
    protected $don_money = null;

    /**
     * don_mnt_input
     * @var mixed
     */
    protected $don_mnt_input = null;

    /**
     * don_money_input
     * @var string
     */
    protected $don_money_input = null;

    /**
     * ptyp_id
     * @var int
     */
    protected $ptyp_id = null;

    /**
     * don_comment
     * @var mixed
     */
    protected $don_comment = null;

    /**
     * don_dstat
     * @var mixed
     */
    protected $don_dstat = null;

    /**
     * rec_id
     * @var int
     */
    protected $rec_id = null;

    /**
     * cert_id
     * @var int
     */
    protected $cert_id = null;

    /**
     * don_sponsors
     * @var mixed
     */
    protected $don_sponsors = null;

    /**
     * don_display_site
     * @var bool
     */
    protected $don_display_site = null;

    /**
     * dono_id
     * @var int
     */
    protected $dono_id = null;

    /**
     * sess_id
     * @var int
     */
    protected $sess_id = null;

    /**
     * Year
     * @var number
     */
    protected $don_real_ts_year = null;

    /**
     * Set don_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonId($p_value)
    {
        $this->don_id = $p_value;
        return $this;
    }

    /**
     * Get don_id
     *
     * @return int
     */
    public function getDonId()
    {
        return $this->don_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
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
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
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
     * Set cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
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
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setCauId($p_value)
    {
        $this->cau_id = $p_value;
        return $this;
    }

    /**
     * Get cau_id
     *
     * @return int
     */
    public function getCauId()
    {
        return $this->cau_id;
    }

    /**
     * Set spo_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setSpoId($p_value)
    {
        $this->spo_id = $p_value;
        return $this;
    }

    /**
     * Get spo_id
     *
     * @return int
     */
    public function getSpoId()
    {
        return $this->spo_id;
    }

    /**
     * Set don_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonDesc($p_value)
    {
        $this->don_desc = $p_value;
        return $this;
    }

    /**
     * Get don_desc
     *
     * @return mixed
     */
    public function getDonDesc()
    {
        return $this->don_desc;
    }

    /**
     * Set don_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonTs($p_value)
    {
        $this->don_ts = $p_value;
        return $this;
    }

    /**
     * Get don_ts
     *
     * @return mixed
     */
    public function getDonTs()
    {
        return $this->don_ts;
    }

    /**
     * Set don_ask_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonAskTs($p_value)
    {
        $this->don_ask_ts = $p_value;
        return $this;
    }

    /**
     * Get don_ask_ts
     *
     * @return mixed
     */
    public function getDonAskTs()
    {
        return $this->don_ask_ts;
    }

    /**
     * Set don_real_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonRealTs($p_value)
    {
        $this->don_real_ts = $p_value;
        return $this;
    }

    /**
     * Get don_real_ts
     *
     * @return mixed
     */
    public function getDonRealTs()
    {
        return $this->don_real_ts;
    }

    /**
     * Set don_end_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonEndTs($p_value)
    {
        $this->don_end_ts = $p_value;
        return $this;
    }

    /**
     * Get don_end_ts
     *
     * @return mixed
     */
    public function getDonEndTs()
    {
        return $this->don_end_ts;
    }

    /**
     * Set don_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonStatus($p_value)
    {
        $this->don_status = $p_value;
        return $this;
    }

    /**
     * Get don_status
     *
     * @return string
     */
    public function getDonStatus()
    {
        return $this->don_status;
    }

    /**
     * Set don_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonMnt($p_value)
    {
        $this->don_mnt = $p_value;
        return $this;
    }

    /**
     * Get don_mnt
     *
     * @return mixed
     */
    public function getDonMnt()
    {
        return $this->don_mnt;
    }

    /**
     * Set don_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonMoney($p_value)
    {
        $this->don_money = $p_value;
        return $this;
    }

    /**
     * Get don_money
     *
     * @return string
     */
    public function getDonMoney()
    {
        return $this->don_money;
    }

    /**
     * Set don_mnt_input
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonMntInput($p_value)
    {
        $this->don_mnt_input = $p_value;
        return $this;
    }

    /**
     * Get don_mnt_input
     *
     * @return mixed
     */
    public function getDonMntInput()
    {
        return $this->don_mnt_input;
    }

    /**
     * Set don_money_input
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonMoneyInput($p_value)
    {
        $this->don_money_input = $p_value;
        return $this;
    }

    /**
     * Get don_money_input
     *
     * @return string
     */
    public function getDonMoneyInput()
    {
        return $this->don_money_input;
    }

    /**
     * Set ptyp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setPtypId($p_value)
    {
        $this->ptyp_id = $p_value;
        return $this;
    }

    /**
     * Get ptyp_id
     *
     * @return int
     */
    public function getPtypId()
    {
        return $this->ptyp_id;
    }

    /**
     * Set don_comment
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonComment($p_value)
    {
        $this->don_comment = $p_value;
        return $this;
    }

    /**
     * Get don_comment
     *
     * @return mixed
     */
    public function getDonComment()
    {
        return $this->don_comment;
    }

    /**
     * Set don_dstat
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonDstat($p_value)
    {
        $this->don_dstat = $p_value;
        return $this;
    }

    /**
     * Get don_dstat
     *
     * @return mixed
     */
    public function getDonDstat()
    {
        return $this->don_dstat;
    }

    /**
     * Set rec_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
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
     * Set cert_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setCertId($p_value)
    {
        $this->cert_id = $p_value;
        return $this;
    }

    /**
     * Get cert_id
     *
     * @return int
     */
    public function getCertId()
    {
        return $this->cert_id;
    }

    /**
     * Set don_sponsors
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonSponsors($p_value)
    {
        $this->don_sponsors = $p_value;
        return $this;
    }

    /**
     * Get don_sponsors
     *
     * @return mixed
     */
    public function getDonSponsors()
    {
        return $this->don_sponsors;
    }

    /**
     * Set don_display_site
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonDisplaySite($p_value)
    {
        $this->don_display_site = $p_value;
        return $this;
    }

    /**
     * Get don_display_site
     *
     * @return bool
     */
    public function getDonDisplaySite()
    {
        return $this->don_display_site;
    }

    /**
     * Set dono_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonoId($p_value)
    {
        $this->dono_id = $p_value;
        return $this;
    }

    /**
     * Get dono_id
     *
     * @return int
     */
    public function getDonoId()
    {
        return $this->dono_id;
    }

    /**
     * Set sess_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setSessId($p_value)
    {
        $this->sess_id = $p_value;
        return $this;
    }

    /**
     * Get sess_id
     *
     * @return int
     */
    public function getSessId()
    {
        return $this->sess_id;
    }

    /**
     * Set don_real_ts_year
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setDonRealTsYear($p_value)
    {
        $this->don_real_ts_year = $p_value;
        return $this;
    }

    /**
     * Get don_real_ts_year
     *
     * @return mixed
     */
    public function getDonRealTsYear()
    {
        return $this->don_real_ts_year;
    }
}
