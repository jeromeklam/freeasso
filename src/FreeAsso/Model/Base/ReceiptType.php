<?php
namespace FreeAsso\Model\Base;

/**
 * ReceiptType
 *
 * @author jeromeklam
 */
abstract class ReceiptType extends \FreeAsso\Model\StorageModel\ReceiptType
{

    /**
     * rett_id
     * @var int
     */
    protected $rett_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * rett_name
     * @var string
     */
    protected $rett_name = null;

    /**
     * rett_last_number
     * @var string
     */
    protected $rett_last_number = null;

    /**
     * rett_regex
     * @var mixed
     */
    protected $rett_regex = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * rett_start_one
     * @var bool
     */
    protected $rett_start_one = null;

    /**
     * Set rett_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptType
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptType
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
     * Set rett_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptType
     */
    public function setRettName($p_value)
    {
        $this->rett_name = $p_value;
        return $this;
    }

    /**
     * Get rett_name
     *
     * @return string
     */
    public function getRettName()
    {
        return $this->rett_name;
    }

    /**
     * Set rett_last_number
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ReceiptType
     */
    public function setRettLastNumber($p_value)
    {
        $this->rett_last_number = $p_value;
        return $this;
    }

    /**
     * Get rett_last_number
     *
     * @return string
     */
    public function getRettLastNumber()
    {
        return $this->rett_last_number;
    }

    /**
     * Set rett_regex
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ReceiptType
     */
    public function setRettRegex($p_value)
    {
        $this->rett_regex = $p_value;
        return $this;
    }

    /**
     * Get rett_regex
     *
     * @return mixed
     */
    public function getRettRegex()
    {
        return $this->rett_regex;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptType
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
     * Set rett_start_one
     * 
     * @param bool $p_value
     * 
     * @return \FreeAsso\Model\ReceiptType
     */
    public function setRettStartOne($p_value)
    {
        $this->rett_start_one = $p_value;
        return $this;
    }

    /**
     * Get rett_start_one
     * 
     * @return bool
     */
    public function getRettStartOne()
    {
        return $this->rett_start_one;
    }
}
