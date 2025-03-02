<?php
namespace FreeAsso\Model\Base;

/**
 * ReceiptDonation
 *
 * @author jeromeklam
 */
abstract class ReceiptDonation extends \FreeAsso\Model\StorageModel\ReceiptDonation
{

    /**
     * rdo_id
     * @var int
     */
    protected $rdo_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * rec_id
     * @var int
     */
    protected $rec_id = null;

    /**
     * don_id
     * @var int
     */
    protected $don_id = null;

    /**
     * rdo_desc
     * @var string
     */
    protected $rdo_desc = null;

    /**
     * rdo_ts
     * @var string
     */
    protected $rdo_ts = null;

    /**
     * rdo_mnt
     * @var string
     */
    protected $rdo_mnt = null;

    /**
     * rdo_money
     * @var string
     */
    protected $rdo_money = null;

    /**
     * ptyp_id
     * @var int
     */
    protected $ptyp_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * Set rdo_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
     */
    public function setRdoId($p_value)
    {
        $this->rdo_id = $p_value;
        return $this;
    }

    /**
     * Get rdo_id
     *
     * @return int
     */
    public function getRdoId()
    {
        return $this->rdo_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
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
     * Set rec_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
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
     * Set don_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
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
     * Set rdo_desc
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
     */
    public function setRdoDesc($p_value)
    {
        $this->rdo_desc = $p_value;
        return $this;
    }

    /**
     * Get rdo_desc
     *
     * @return string
     */
    public function getRdoDesc()
    {
        return $this->rdo_desc;
    }

    /**
     * Set rdo_ts
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
     */
    public function setRdoTs($p_value)
    {
        $this->rdo_ts = $p_value;
        return $this;
    }

    /**
     * Get rdo_ts
     *
     * @return string
     */
    public function getRdoTs()
    {
        return $this->rdo_ts;
    }

    /**
     * Set rdo_mnt
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
     */
    public function setRdoMnt($p_value)
    {
        $this->rdo_mnt = $p_value;
        return $this;
    }

    /**
     * Get rdo_mnt
     *
     * @return string
     */
    public function getRdoMnt()
    {
        return $this->rdo_mnt;
    }

    /**
     * Set rdo_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
     */
    public function setRdoMoney($p_value)
    {
        $this->rdo_money = $p_value;
        return $this;
    }

    /**
     * Get rdo_money
     *
     * @return string
     */
    public function getRdoMoney()
    {
        return $this->rdo_money;
    }

    /**
     * Set ptyp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptDonation
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
}
