<?php
namespace FreeAsso\Model\Base;

/**
 * CauseLink
 *
 * @author jeromeklam
 */
abstract class CauseLink extends \FreeAsso\Model\StorageModel\CauseLink
{

    /**
     * caul_id
     * @var int
     */
    protected $caul_id = null;

    /**
     * from_cau_id
     * @var int
     */
    protected $from_cau_id = null;

    /**
     * to_cau_id
     * @var int
     */
    protected $to_cau_id = null;

    /**
     * caul_from
     * @var string
     */
    protected $caul_from = null;

    /**
     * caul_to
     * @var string
     */
    protected $caul_to = null;

    /**
     * cault_id
     * @var int
     */
    protected $cault_id = null;

    /**
     * Set caul_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLink
     */
    public function setCaulId($p_value)
    {
        $this->caul_id = $p_value;
        return $this;
    }

    /**
     * Get caul_id
     *
     * @return int
     */
    public function getCaulId()
    {
        return $this->caul_id;
    }

    /**
     * Set from_cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLink
     */
    public function setFromCauId($p_value)
    {
        $this->from_cau_id = $p_value;
        return $this;
    }

    /**
     * Get from_cau_id
     *
     * @return int
     */
    public function getFromCauId()
    {
        return $this->from_cau_id;
    }

    /**
     * Set to_cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLink
     */
    public function setToCauId($p_value)
    {
        $this->to_cau_id = $p_value;
        return $this;
    }

    /**
     * Get to_cau_id
     *
     * @return int
     */
    public function getToCauId()
    {
        return $this->to_cau_id;
    }

    /**
     * Set caul_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseLink
     */
    public function setCaulFrom($p_value)
    {
        $this->caul_from = $p_value;
        return $this;
    }

    /**
     * Get caul_from
     *
     * @return string
     */
    public function getCaulFrom()
    {
        return $this->caul_from;
    }

    /**
     * Set caul_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseLink
     */
    public function setCaulTo($p_value)
    {
        $this->caul_to = $p_value;
        return $this;
    }

    /**
     * Get caul_to
     *
     * @return string
     */
    public function getCaulTo()
    {
        return $this->caul_to;
    }

    /**
     * Set cault_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseLink
     */
    public function setCaultId($p_value)
    {
        $this->cault_id = $p_value;
        return $this;
    }

    /**
     * Get cault_id
     *
     * @return int
     */
    public function getCaultId()
    {
        return $this->cault_id;
    }
}
