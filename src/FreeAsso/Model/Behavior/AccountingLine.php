<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait AccountingLine
{

    /**
     * AccountingLine
     * @var \FreeAsso\Model\AccountingLine
     */
    protected $accountingLine = null;

    /**
     * Id
     * @var integer
     */
    protected $accl_id = null;

    /**
     * Set id
     *
     * @param integer $p_value
     * 
     * @return \FreeFW\Core\Model
     */
    public function setAcclId($p_value)
    {
        $this->accl_id = $p_value;
        if ($this->accl_id === null) {
            $this->accountingLine = null;
        } else {
            if ($this->accountingLine instanceof \FreeAsso\Model\AccountingLine && $this->accountingLine->getAcclId() != $this->accl_id) {
                $this->accountingLine = null;
            }
        }
        return $this;
    }

    /**
     * Get accl_id
     *
     * @return integer
     */
    public function getAcclId()
    {
        return $this->accl_id;
    }

    /**
     * Set accountingLine
     *
     * @param \FreeAsso\Model\AccountingLine $p_accountingLine
     *
     * @return \FreeFW\Core\Model
     */
    public function setAccountingLine($p_accountingLine)
    {
        $this->accountingLine = $p_accountingLine;
        if ($this->accountingLine instanceof \FreeAsso\model\AccountingLine) {
            $this->accl_id = $this->accountingLine->getAcclId();
        } else {
            $this->accl_id = null;
        }
        return $this;
    }

    /**
     * Get accountingLine
     *
     * @return \FreeAsso\Model\AccountingLine
     */
    public function getAccountingLine()
    {
        if ($this->accountingLine === null) {
            if ($this->accl_id > 0) {
                $this->accountingLine = \FreeAsso\Model\AccountingLine::findFirst(['accl_id' => $this->accl_id]);
            }
        }
        return $this->accountingLine;
    }
}
