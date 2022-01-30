<?php
namespace FreeAsso\Model\Behaviour;

/**
 * certificate_generation
 *
 * @author jeromeklam
 *
 */
trait CertificateGeneration
{

   /**
     * Id
     * @var number
     */
    protected $cerg_id = null;

    /**
     * CertificateGeneration
     * @var \FreeAsso\Model\CertificateGeneration
     */
    protected $certificate_generation = null;

    /**
     * Set id : certificate_generation
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\CertificateGeneration
     */
    public function setCergId($p_id)
    {
        $this->cerg_id = $p_id;
        if ($this->certificate_generation) {
            if ($this->certificate_generation->getCergId() != $this->cerg_id) {
                $this->certificate_generation = null;
            }
        }
        return $this;
    }

    /**
     * Get id : certificate_generation
     *
     * @return number
     */
    public function getCergId()
    {
        return $this->cerg_id;
    }

    /**
     * Set certificate_generation
     *
     * @param \FreeAsso\Model\CertificateGeneration $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setCertificateGeneration($p_model)
    {
        $this->certificate_generation = $p_model;
        if ($p_model) {
            $this->cerg_id = $p_model->getCergId();
        }
        return $this;
   }

   /**
     * Get certificate_generation
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\CertificateGeneration
     */
    public function getCertificateGeneration($p_force = false)
    {
        if ($this->certificate_generation === null || $p_force) {
            if ($this->cerg_id > 0) {
                $this->certificate_generation = \FreeAsso\Model\CertificateGeneration::findFirst(
                    [
                        'cerg_id' => $this->cerg_id
                    ]
                );
            } else {
                $this->certificate_generation = null;
            }
        }
        return $this->certificate_generation;
    }
}