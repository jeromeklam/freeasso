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
     * camt_name
     * @var string
     */
    protected $camt_name = null;

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
}
