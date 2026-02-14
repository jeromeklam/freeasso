<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait AccountingHeader
{

    /**
     * AccountingHeader
     * @var \FreeAsso\Model\AccountingHeader
     */
    protected $accountingHeader = null;

    /**
     * Id
     * @var integer
     */
    protected $acch_id = null;

    /**
     * Set id
     *
     * @param integer $p_value
     * 
     * @return \FreeFW\Core\Model
     */
    public function setAcchId($p_value)
    {
        $this->acch_id = $p_value;
        if ($this->acch_id === null) {
            $this->accountingHeader = null;
        } else {
            if ($this->accountingHeader instanceof \FreeAsso\Model\AccountingHeader && $this->accountingHeader->getAcchId() != $this->acch_id) {
                $this->accountingHeader = null;
            }
        }
        return $this;
    }

    /**
     * Get acch_id
     *
     * @return integer
     */
    public function getAcchId()
    {
        return $this->acch_id;
    }

    /**
     * Set accountingHeader
     *
     * @param \FreeAsso\Model\AccountingHeader $p_accountingHeader
     *
     * @return \FreeFW\Core\Model
     */
    public function setAccountingHeader($p_accountingHeader)
    {
        $this->accountingHeader = $p_accountingHeader;
        if ($this->accountingHeader instanceof \FreeAsso\model\AccountingHeader) {
            $this->acch_id = $this->accountingHeader->getAcchId();
        } else {
            $this->acch_id = null;
        }
        return $this;
    }

    /**
     * Get accountingHeader
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function getAccountingHeader()
    {
        if ($this->accountingHeader === null) {
            if ($this->acch_id > 0) {
                $this->accountingHeader = \FreeAsso\Model\AccountingHeader::findFirst(['acch_id' => $this->acch_id]);
            }
        }
        return $this->accountingHeader;
    }
}
