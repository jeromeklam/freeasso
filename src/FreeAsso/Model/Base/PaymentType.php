<?php
namespace FreeAsso\Model\Base;

/**
 * PaymentType
 *
 * @author jeromeklam
 */
abstract class PaymentType extends \FreeAsso\Model\StorageModel\PaymentType
{

    /**
     * ptyp_id
     * @var int
     */
    protected $ptyp_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * ptyp_code
     * @var string
     */
    protected $ptyp_code = null;

    /**
     * ptyp_name
     * @var string
     */
    protected $ptyp_name = null;

    /**
     * ptyp_name_en
     * @var string
     */
    protected $ptyp_name_en = null;

    /**
     * ptyp_receipt
     * @var bool
     */
    protected $ptyp_receipt = null;

    /**
     * ptyp_from
     * @var mixed
     */
    protected $ptyp_from = null;

    /**
     * ptyp_to
     * @var mixed
     */
    protected $ptyp_to = null;

    /**
     * ptyp_accounting
     * @var string
     */
    protected $ptyp_accounting = null;

    /**
     * ptyp_restriction
     * @var mixed
     */
    protected $ptyp_restriction = null;

    /**
     * Set ptyp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\PaymentType
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\PaymentType
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
     * Set ptyp_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypCode($p_value)
    {
        $this->ptyp_code = $p_value;
        return $this;
    }

    /**
     * Get ptyp_code
     *
     * @return string
     */
    public function getPtypCode()
    {
        return $this->ptyp_code;
    }

    /**
     * Set ptyp_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypName($p_value)
    {
        $this->ptyp_name = $p_value;
        return $this;
    }

    /**
     * Get ptyp_name
     *
     * @return string
     */
    public function getPtypName()
    {
        return $this->ptyp_name;
    }

    /**
     * Set ptyp_name_en
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypNameEn($p_value)
    {
        $this->ptyp_name_en = $p_value;
        return $this;
    }

    /**
     * Get ptyp_name_en
     *
     * @return string
     */
    public function getPtypNameEn()
    {
        return $this->ptyp_name_en;
    }

    /**
     * Set ptyp_receipt
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypReceipt($p_value)
    {
        $this->ptyp_receipt = $p_value;
        return $this;
    }

    /**
     * Get ptyp_receipt
     *
     * @return bool
     */
    public function getPtypReceipt()
    {
        return $this->ptyp_receipt;
    }

    /**
     * Set ptyp_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypFrom($p_value)
    {
        $this->ptyp_from = $p_value;
        return $this;
    }

    /**
     * Get ptyp_from
     *
     * @return mixed
     */
    public function getPtypFrom()
    {
        return $this->ptyp_from;
    }

    /**
     * Set ptyp_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypTo($p_value)
    {
        $this->ptyp_to = $p_value;
        return $this;
    }

    /**
     * Get ptyp_to
     *
     * @return mixed
     */
    public function getPtypTo()
    {
        return $this->ptyp_to;
    }

    /**
     * Set ptyp_accounting
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypAccounting($p_value)
    {
        $this->ptyp_accounting = $p_value;
        return $this;
    }

    /**
     * Get ptyp_accounting
     *
     * @return string
     */
    public function getPtypAccounting()
    {
        return $this->ptyp_accounting;
    }

    /**
     * Set ptyp_restriction
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function setPtypRestriction($p_value)
    {
        $this->ptyp_restriction = $p_value;
        return $this;
    }

    /**
     * Get ptyp_restriction
     *
     * @return string
     */
    public function getPtypRestriction()
    {
        return $this->ptyp_restriction;
    }
}
