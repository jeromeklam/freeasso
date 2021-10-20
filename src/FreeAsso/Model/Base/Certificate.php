<?php
namespace FreeAsso\Model\Base;

/**
 * Certificate
 *
 * @author jeromeklam
 */
abstract class Certificate extends \FreeAsso\Model\StorageModel\Certificate
{

    /**
     * cert_id
     * @var int
     */
    protected $cert_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * cert_ts
     * @var mixed
     */
    protected $cert_ts = null;

    /**
     * cli_id
     * @var int
     */
    protected $cli_id = null;

    /**
     * cert_gen_ts
     * @var mixed
     */
    protected $cert_gen_ts = null;

    /**
     * cert_print_ts
     * @var mixed
     */
    protected $cert_print_ts = null;

    /**
     * cert_fullname
     * @var string
     */
    protected $cert_fullname = null;

    /**
     * cert_address1
     * @var string
     */
    protected $cert_address1 = null;

    /**
     * cert_address2
     * @var string
     */
    protected $cert_address2 = null;

    /**
     * cert_address3
     * @var string
     */
    protected $cert_address3 = null;

    /**
     * cert_cp
     * @var string
     */
    protected $cert_cp = null;

    /**
     * cert_town
     * @var string
     */
    protected $cert_town = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * cnty_id
     * @var int
     */
    protected $cnty_id = null;

    /**
     * cert_email
     * @var string
     */
    protected $cert_email = null;

    /**
     * cert_input_mnt
     * @var mixed
     */
    protected $cert_input_mnt = null;

    /**
     * cert_input_money
     * @var string
     */
    protected $cert_input_money = null;

    /**
     * cert_output_mnt
     * @var mixed
     */
    protected $cert_output_mnt = null;

    /**
     * cert_output_money
     * @var string
     */
    protected $cert_output_money = null;

    /**
     * cert_comment
     * @var mixed
     */
    protected $cert_comment = null;

    /**
     * cert_data1
     * @var string
     */
    protected $cert_data1 = null;

    /**
     * cert_data2
     * @var string
     */
    protected $cert_data2 = null;

    /**
     * file_id
     * @var int
     */
    protected $file_id = null;

    /**
     * cert_unit_unit
     * @var string
     */
    protected $cert_unit_unit = null;

    /**
     * cert_unit_mnt
     * @var mixed
     */
    protected $cert_unit_mnt = null;

    /**
     * cert_unit_base
     * @var mixed
     */
    protected $cert_unit_base = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * cert_manual
     * @var bool
     */
    protected $cert_manual = null;

    /**
     * Set cert_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Certificate
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Certificate
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
     * Set cert_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertTs($p_value)
    {
        $this->cert_ts = $p_value;
        return $this;
    }

    /**
     * Get cert_ts
     *
     * @return mixed
     */
    public function getCertTs()
    {
        return $this->cert_ts;
    }

    /**
     * Set cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Certificate
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
     * Set cert_gen_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertGenTs($p_value)
    {
        $this->cert_gen_ts = $p_value;
        return $this;
    }

    /**
     * Get cert_gen_ts
     *
     * @return mixed
     */
    public function getCertGenTs()
    {
        return $this->cert_gen_ts;
    }

    /**
     * Set cert_print_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertPrintTs($p_value)
    {
        $this->cert_print_ts = $p_value;
        return $this;
    }

    /**
     * Get cert_print_ts
     *
     * @return mixed
     */
    public function getCertPrintTs()
    {
        return $this->cert_print_ts;
    }

    /**
     * Set cert_fullname
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertFullname($p_value)
    {
        $this->cert_fullname = $p_value;
        return $this;
    }

    /**
     * Get cert_fullname
     *
     * @return string
     */
    public function getCertFullname()
    {
        return $this->cert_fullname;
    }

    /**
     * Set cert_address1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertAddress1($p_value)
    {
        $this->cert_address1 = $p_value;
        return $this;
    }

    /**
     * Get cert_address1
     *
     * @return string
     */
    public function getCertAddress1()
    {
        return $this->cert_address1;
    }

    /**
     * Set cert_address2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertAddress2($p_value)
    {
        $this->cert_address2 = $p_value;
        return $this;
    }

    /**
     * Get cert_address2
     *
     * @return string
     */
    public function getCertAddress2()
    {
        return $this->cert_address2;
    }

    /**
     * Set cert_address3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertAddress3($p_value)
    {
        $this->cert_address3 = $p_value;
        return $this;
    }

    /**
     * Get cert_address3
     *
     * @return string
     */
    public function getCertAddress3()
    {
        return $this->cert_address3;
    }

    /**
     * Set cert_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertCp($p_value)
    {
        $this->cert_cp = $p_value;
        return $this;
    }

    /**
     * Get cert_cp
     *
     * @return string
     */
    public function getCertCp()
    {
        return $this->cert_cp;
    }

    /**
     * Set cert_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertTown($p_value)
    {
        $this->cert_town = $p_value;
        return $this;
    }

    /**
     * Get cert_town
     *
     * @return string
     */
    public function getCertTown()
    {
        return $this->cert_town;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Certificate
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
     * Set cnty_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Certificate
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
     * Set cert_email
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertEmail($p_value)
    {
        $this->cert_email = $p_value;
        return $this;
    }

    /**
     * Get cert_email
     *
     * @return string
     */
    public function getCertEmail()
    {
        return $this->cert_email;
    }

    /**
     * Set cert_input_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertInputMnt($p_value)
    {
        $this->cert_input_mnt = $p_value;
        return $this;
    }

    /**
     * Get cert_input_mnt
     *
     * @return mixed
     */
    public function getCertInputMnt()
    {
        return $this->cert_input_mnt;
    }

    /**
     * Set cert_input_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertInputMoney($p_value)
    {
        $this->cert_input_money = $p_value;
        return $this;
    }

    /**
     * Get cert_input_money
     *
     * @return string
     */
    public function getCertInputMoney()
    {
        return $this->cert_input_money;
    }

    /**
     * Set cert_output_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertOutputMnt($p_value)
    {
        $this->cert_output_mnt = $p_value;
        return $this;
    }

    /**
     * Get cert_output_mnt
     *
     * @return mixed
     */
    public function getCertOutputMnt()
    {
        return $this->cert_output_mnt;
    }

    /**
     * Set cert_output_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertOutputMoney($p_value)
    {
        $this->cert_output_money = $p_value;
        return $this;
    }

    /**
     * Get cert_output_money
     *
     * @return string
     */
    public function getCertOutputMoney()
    {
        return $this->cert_output_money;
    }

    /**
     * Set cert_comment
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertComment($p_value)
    {
        $this->cert_comment = $p_value;
        return $this;
    }

    /**
     * Get cert_comment
     *
     * @return mixed
     */
    public function getCertComment()
    {
        return $this->cert_comment;
    }

    /**
     * Set cert_data1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertData1($p_value)
    {
        $this->cert_data1 = $p_value;
        return $this;
    }

    /**
     * Get cert_data1
     *
     * @return string
     */
    public function getCertData1()
    {
        return $this->cert_data1;
    }

    /**
     * Set cert_data2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertData2($p_value)
    {
        $this->cert_data2 = $p_value;
        return $this;
    }

    /**
     * Get cert_data2
     *
     * @return string
     */
    public function getCertData2()
    {
        return $this->cert_data2;
    }

    /**
     * Set file_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Certificate
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
     * Set cert_unit_unit
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertUnitUnit($p_value)
    {
        $this->cert_unit_unit = $p_value;
        return $this;
    }

    /**
     * Get cert_unit_unit
     *
     * @return string
     */
    public function getCertUnitUnit()
    {
        return $this->cert_unit_unit;
    }

    /**
     * Set cert_unit_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertUnitMnt($p_value)
    {
        $this->cert_unit_mnt = $p_value;
        return $this;
    }

    /**
     * Get cert_unit_mnt
     *
     * @return mixed
     */
    public function getCertUnitMnt()
    {
        return $this->cert_unit_mnt;
    }

    /**
     * Set cert_unit_base
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function setCertUnitBase($p_value)
    {
        $this->cert_unit_base = $p_value;
        return $this;
    }

    /**
     * Get cert_unit_base
     *
     * @return mixed
     */
    public function getCertUnitBase()
    {
        return $this->cert_unit_base;
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
     * Set cert_manual
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setCertManual($p_value)
    {
        $this->cert_manual = $p_value;
        return $this;
    }

    /**
     * Get cert_manual
     *
     * @return bool
     */
    public function getCertManual()
    {
        return $this->cert_manual;
    }
}
