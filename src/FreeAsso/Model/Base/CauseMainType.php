<?php
namespace FreeAsso\Model\Base;

/**
 * CauseMainType
 *
 * @author jeromeklam
 */
abstract class CauseMainType extends \FreeAsso\Model\StorageModel\CauseMainType
{

    /**
     * camt_id
     * @var int
     */
    protected $camt_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * camt_name
     * @var string
     */
    protected $camt_name = null;

    /**
     * camt_family
     * @var string
     */
    protected $camt_family = null;

    /**
     * Set camt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMainType
     */
    public function setCamtId($p_value)
    {
        $this->camt_id = $p_value;
        return $this;
    }

    /**
     * Get camt_id
     *
     * @return int
     */
    public function getCamtId()
    {
        return $this->camt_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
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
     * Set camt_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMainType
     */
    public function setCamtName($p_value)
    {
        $this->camt_name = $p_value;
        return $this;
    }

    /**
     * Get camt_name
     *
     * @return string
     */
    public function getCamtName()
    {
        return $this->camt_name;
    }

    /**
     * Set camt_family
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMainType
     */
    public function setCamtFamily($p_value)
    {
        $this->camt_family = $p_value;
        return $this;
    }

    /**
     * Get camt_family
     *
     * @return string
     */
    public function getCamtFamily()
    {
        return $this->camt_family;
    }
}
