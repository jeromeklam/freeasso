<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait Certificate
{

    /**
     * Certificate
     * @var \FreeAsso\Model\Certificate
     */
    protected $certificate = null;

    /**
     * Set certificate
     *
     * @param \FreeAsso\Model\Certificate $p_certificate
     *
     * @return \FreeFW\Core\Model
     */
    public function setCertificate($p_certificate)
    {
        $this->certificate = $p_certificate;
        return $this;
    }

    /**
     * Get certificate
     *
     * @return \FreeAsso\Model\Certificate
     */
    public function getCertificate()
    {
        if ($this->certificate === null) {
            if ($this->cert_id > 0) {
                $this->certificate = \FreeAsso\Model\Certificate::findFirst(['cert_id' => $this->cert_id]);
            }
        }
        return $this->certificate;
    }
}
