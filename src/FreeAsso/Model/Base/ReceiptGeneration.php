<?php
namespace FreeAsso\Model\Base;

/**
 * ReceiptGeneration
 *
 * @author jeromeklam
 */
abstract class ReceiptGeneration extends \FreeAsso\Model\StorageModel\ReceiptGeneration
{

    /**
     * recg_id
     * @var int
     */
    protected $recg_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * recg_name
     * @var string
     */
    protected $recg_name = null;

    /**
     * recg_year
     * @var int
     */
    protected $recg_year = null;

    /**
     * recg_status
     * @var string
     */
    protected $recg_status = null;

    /**
     * recg_save
     * @var mixed
     */
    protected $recg_save = null;

    /**
     * edi_id
     * @var int
     */
    protected $edi_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * email_id
     * @var int
     */
    protected $email_id = null;

    /**
     * Date de générartion
     * @var string
     */
    protected $recg_gen = null;

    /**
     * Date emails
     * @var string
     */
    protected $recg_email = null;

    /**
     * Date d'impression
     * @var string
     */
    protected $recg_no_email = null;

    /**
     * clic_id
     * @var int
     */
    protected $clic_id = null;

    /**
     * ptyp_id
     * @var Integer
     */
    protected $ptyp_id = null;

    /**
     * recg_cogs
     * @var String
     */
    protected $recg_cogs = null;

    /**
     * Set recg_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgId($p_value)
    {
        $this->recg_id = $p_value;
        return $this;
    }

    /**
     * Get recg_id
     *
     * @return int
     */
    public function getRecgId()
    {
        return $this->recg_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
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
     * Set recg_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgName($p_value)
    {
        $this->recg_name = $p_value;
        return $this;
    }

    /**
     * Get recg_name
     *
     * @return string
     */
    public function getRecgName()
    {
        return $this->recg_name;
    }

    /**
     * Set recg_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgYear($p_value)
    {
        $this->recg_year = $p_value;
        return $this;
    }

    /**
     * Get recg_year
     *
     * @return int
     */
    public function getRecgYear()
    {
        return $this->recg_year;
    }

    /**
     * Set recg_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgStatus($p_value)
    {
        $this->recg_status = $p_value;
        return $this;
    }

    /**
     * Get recg_status
     *
     * @return string
     */
    public function getRecgStatus()
    {
        return $this->recg_status;
    }

    /**
     * Set recg_save
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgSave($p_value)
    {
        $this->recg_save = $p_value;
        return $this;
    }

    /**
     * Get recg_save
     *
     * @return mixed
     */
    public function getRecgSave()
    {
        return $this->recg_save;
    }

    /**
     * Set edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setEdiId($p_value)
    {
        $this->edi_id = $p_value;
        return $this;
    }

    /**
     * Get edi_id
     *
     * @return int
     */
    public function getEdiId()
    {
        return $this->edi_id;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
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
     * Set email_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setEmailId($p_value)
    {
        $this->email_id = $p_value;
        return $this;
    }

    /**
     * Get email_id
     *
     * @return int
     */
    public function getEmailId()
    {
        return $this->email_id;
    }

    /**
     * Get date de générartion
     *
     * @return  string
     */ 
    public function getRecgGen()
    {
        return $this->recg_gen;
    }

    /**
     * Set date de générartion
     *
     * @param  string  $recg_gen  Date de générartion
     *
     * @return  self
     */ 
    public function setRecgGen($recg_gen)
    {
        $this->recg_gen = $recg_gen;
        return $this;
    }

    /**
     * Get date emails
     *
     * @return  string
     */ 
    public function getRecgEmail()
    {
        return $this->recg_email;
    }

    /**
     * Set date emails
     *
     * @param  string  $recg_email  Date emails
     *
     * @return  self
     */ 
    public function setRecgEmail($recg_email)
    {
        $this->recg_email = $recg_email;
        return $this;
    }

    /**
     * Get date d'impression
     *
     * @return  string
     */ 
    public function getRecgNoEmail()
    {
        return $this->recg_no_email;
    }

    /**
     * Set date d'impression
     *
     * @param  string  $recg_no_email  Date d'impression
     *
     * @return  self
     */ 
    public function setRecgNoEmail($recg_no_email)
    {
        $this->recg_no_email = $recg_no_email;
        return $this;
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
     * Set ptyp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
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
     * Set recg_cogs
     *
     * @param String $p_value
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function setRecgCogs($p_value)
    {
        $this->recg_cogs = $p_value;
        return $this;
    }

    /**
     * Get recg_cogs
     *
     * @return String
     */
    public function getRecgCogs()
    {
        return $this->recg_cogs;
    }
}
