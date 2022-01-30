<?php
namespace FreeAsso\Model\Base;

/**
 * ReceiptTypeCauseType
 *
 * @author jeromeklam
 */
abstract class ReceiptTypeCauseType extends \FreeAsso\Model\StorageModel\ReceiptTypeCauseType
{

    /**
     * rtct_id
     * @var int
     */
    protected $rtct_id = null;

    /**
     * caut_id
     * @var int
     */
    protected $caut_id = null;

    /**
     * rett_id
     * @var int
     */
    protected $rett_id = null;

    /**
     * rtct_once
     * @var int
     */
    protected $rtct_once = null;

    /**
     * rtct_regular
     * @var int
     */
    protected $rtct_regular = null;

    /**
     * Set rtct_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptTypeCauseType
     */
    public function setRtctId($p_value)
    {
        $this->rtct_id = $p_value;
        return $this;
    }

    /**
     * Get rtct_id
     *
     * @return int
     */
    public function getRtctId()
    {
        return $this->rtct_id;
    }

    /**
     * Set caut_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptTypeCauseType
     */
    public function setCautId($p_value)
    {
        $this->caut_id = $p_value;
        return $this;
    }

    /**
     * Get caut_id
     *
     * @return int
     */
    public function getCautId()
    {
        return $this->caut_id;
    }

    /**
     * Set rett_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptTypeCauseType
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
     * Set rtct_once
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptTypeCauseType
     */
    public function setRtctOnce($p_value)
    {
        $this->rtct_once = $p_value;
        return $this;
    }

    /**
     * Get rtct_once
     *
     * @return int
     */
    public function getRtctOnce()
    {
        return $this->rtct_once;
    }

    /**
     * Set rtct_regular
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ReceiptTypeCauseType
     */
    public function setRtctRegular($p_value)
    {
        $this->rtct_regular = $p_value;
        return $this;
    }

    /**
     * Get rtct_regular
     *
     * @return int
     */
    public function getRtctRegular()
    {
        return $this->rtct_regular;
    }
}
