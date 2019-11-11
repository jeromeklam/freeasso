<?php
namespace FreeAsso\Model\Base;

/**
 * CauseType
 *
 * @author jeromeklam
 */
abstract class CauseType extends \FreeAsso\Model\StorageModel\CauseType
{

    /**
     * caut_id
     * @var int
     */
    protected $caut_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * caut_name
     * @var string
     */
    protected $caut_name = null;

    /**
     * caut_receipt
     * @var string
     */
    protected $caut_receipt = null;

    /**
     * caut_max_mnt
     * @var string
     */
    protected $caut_max_mnt = null;

    /**
     * caut_min_mnt
     * @var string
     */
    protected $caut_min_mnt = null;

    /**
     * caut_mnt_type
     * @var string
     */
    protected $caut_mnt_type = null;

    /**
     * caut_certificat
     * @var string
     */
    protected $caut_certificat = null;

    /**
     * Set caut_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
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
     * Set caut_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautName($p_value)
    {
        $this->caut_name = $p_value;
        return $this;
    }

    /**
     * Get caut_name
     *
     * @return string
     */
    public function getCautName()
    {
        return $this->caut_name;
    }

    /**
     * Set caut_receipt
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautReceipt($p_value)
    {
        $this->caut_receipt = $p_value;
        return $this;
    }

    /**
     * Get caut_receipt
     *
     * @return string
     */
    public function getCautReceipt()
    {
        return $this->caut_receipt;
    }

    /**
     * Set caut_max_mnt
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMaxMnt($p_value)
    {
        $this->caut_max_mnt = $p_value;
        return $this;
    }

    /**
     * Get caut_max_mnt
     *
     * @return string
     */
    public function getCautMaxMnt()
    {
        return $this->caut_max_mnt;
    }

    /**
     * Set caut_min_mnt
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMinMnt($p_value)
    {
        $this->caut_min_mnt = $p_value;
        return $this;
    }

    /**
     * Get caut_min_mnt
     *
     * @return string
     */
    public function getCautMinMnt()
    {
        return $this->caut_min_mnt;
    }

    /**
     * Set caut_mnt_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMntType($p_value)
    {
        $this->caut_mnt_type = $p_value;
        return $this;
    }

    /**
     * Get caut_mnt_type
     *
     * @return string
     */
    public function getCautMntType()
    {
        return $this->caut_mnt_type;
    }

    /**
     * Set caut_certificat
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautCertificat($p_value)
    {
        $this->caut_certificat = $p_value;
        return $this;
    }

    /**
     * Get caut_certificat
     *
     * @return string
     */
    public function getCautCertificat()
    {
        return $this->caut_certificat;
    }
}
