<?php
namespace FreeAsso\Model\Base;

/**
 * CertificateGeneration
 *
 * @author jeromeklam
 */
abstract class CertificateGeneration extends \FreeAsso\Model\StorageModel\CertificateGeneration
{

    /**
     * cerg_id
     * @var int
     */
    protected $cerg_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * cerg_name
     * @var string
     */
    protected $cerg_name = null;

    /**
     * cerg_year
     * @var int
     */
    protected $cerg_year = null;

    /**
     * cerg_status
     * @var string
     */
    protected $cerg_status = null;

    /**
     * cerg_save
     * @var mixed
     */
    protected $cerg_save = null;

    /**
     * edi_id
     * @var int
     */
    protected $edi_id = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * Set cerg_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function setCergId($p_value)
    {
        $this->cerg_id = $p_value;
        return $this;
    }

    /**
     * Get cerg_id
     *
     * @return int
     */
    public function getCergId()
    {
        return $this->cerg_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
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
     * Set cerg_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function setCergName($p_value)
    {
        $this->cerg_name = $p_value;
        return $this;
    }

    /**
     * Get cerg_name
     *
     * @return string
     */
    public function getCergName()
    {
        return $this->cerg_name;
    }

    /**
     * Set cerg_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function setCergYear($p_value)
    {
        $this->cerg_year = $p_value;
        return $this;
    }

    /**
     * Get cerg_year
     *
     * @return int
     */
    public function getCergYear()
    {
        return $this->cerg_year;
    }

    /**
     * Set cerg_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function setCergStatus($p_value)
    {
        $this->cerg_status = $p_value;
        return $this;
    }

    /**
     * Get cerg_status
     *
     * @return string
     */
    public function getCergStatus()
    {
        return $this->cerg_status;
    }

    /**
     * Set cerg_save
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function setCergSave($p_value)
    {
        $this->cerg_save = $p_value;
        return $this;
    }

    /**
     * Get cerg_save
     *
     * @return mixed
     */
    public function getCergSave()
    {
        return $this->cerg_save;
    }

    /**
     * Set edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function setEdiId($p_value)
    {
        $this->edi_id = $p_value;
        return $this;
    }

    /**
     * Get edi_id
     *
     * @return int
     */
    public function getEdiId()
    {
        return $this->edi_id;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CertificateGeneration
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
