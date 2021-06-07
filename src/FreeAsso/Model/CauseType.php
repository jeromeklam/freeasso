<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseType
 *
 * @author jeromeklam
 */
class CauseType extends \FreeAsso\Model\Base\CauseType implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Constantes
     * @var string
     */
    const FAMILY_NONE          = 'NONE';
    const FAMILY_ANIMAL        = 'ANIMAL';
    const FAMILY_OTHER         = 'OTHER';
    const FAMILY_NATURE        = 'NATURE';
    const FAMILY_ADMINISTRATIV = 'ADMINISTRATIV';

    /**
     * Type de montant
     * @var string
     */
    const MNT_TYPE_OTHER   = 'OTHER';
    const MNT_TYPE_ANNUAL  = 'ANNUAL';
    const MNT_TYPE_MAXIMUM = 'MAXIMUM';

    /**
     * Donation types
     * @var string
     */
    const DONATION_ALL     = 'ALL';
    const DONATION_ONCE    = 'ONCE';
    const DONATION_REGULAR = 'REGULAR';

    /**
     * Default donation duration
     * @var string
     */
    const DURATION_1YEAR    = '1Y';
    const DURATION_1MONTH   = '1M';
    const DURATION_INFINITE = 'INFINITE';

    /**
     * Type de cause principal
     * @var \FreeAsso\Model\CauseMainType
     */
    protected $cause_main_type = null;

    /**
     * Cause count
     * @var number
     */
    protected $count_cause = false;

    /**
     * Receipt edition
     * @var \FreeFW\Model\Edition
     */
    protected $receipt_edition = null;

    /**
     * Certificate edition
     * @var \FreeFW\Model\Edition
     */
    protected $certificate_edition = null;

    /**
     * Identity edition
     * @var \FreeFW\Model\Edition
     */
    protected $identity_edition = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caut_id               = 0;
        $this->brk_id                = 0;
        $this->caut_name             = '';
        $this->caut_receipt          = 0;
        $this->caut_certificat       = 0;
        $this->caut_mnt_type         = self::MNT_TYPE_OTHER;
        $this->caut_money            = 'EUR';
        $this->caut_donation         = self::DONATION_ALL;
        $this->caut_news             = true;
        $this->caut_once_duration    = self::DURATION_1YEAR;
        $this->caut_regular_duration = self::DURATION_1YEAR;
        $this->caut_string_1         = 0;
        $this->caut_string_2         = 0;
        $this->caut_string_3         = 0;
        $this->caut_string_4         = 0;
        $this->caut_number_1         = 0;
        $this->caut_number_2         = 0;
        $this->caut_number_3         = 0;
        $this->caut_number_4         = 0;
        $this->caut_bool_1           = 0;
        $this->caut_bool_2           = 0;
        $this->caut_bool_3           = 0;
        $this->caut_bool_4           = 0;
        $this->caut_date_1           = 0;
        $this->caut_date_2           = 0;
        $this->caut_date_3           = 0;
        $this->caut_date_4           = 0;
        $this->caut_text_1           = 0;
        $this->caut_text_2           = 0;
        $this->caut_text_3           = 0;
        $this->caut_text_4           = 0;
        return $this;
    }

    /**
     * Set Cause main type
     *
     * @param \FreeAsso\Model\CauseMainType $p_cause_main_type
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCauseMainType($p_cause_main_type)
    {
        $this->cause_main_type = $p_cause_main_type;
        return $this;
    }

    /**
     * Get cause main type
     *
     * @return \FreeAsso\Model\CauseMainType
     */
    public function getCauseMainType()
    {
        return $this->cause_main_type;
    }

    /**
     * Set cause count
     *
     * @param number $p_count
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCountCause($p_count)
    {
        $this->count_cause = $p_count;
        return $this;
    }

    /**
     * Count causes
     *
     * @return number
     */
    public function getCountCause()
    {
        if ($this->count_cause === false) {
            \FreeAsso\Model\Cause::count([]);
        }
        return $this->count_cause;
    }

    /**
     * Set caut_rec_edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\CauseType
     */
    public function setCautRecEdiid($p_value)
    {
        $this->caut_rec_edi_id = $p_value;
        if ($this->receipt_edition && $this->receipt_edition->getEdiId() !== $this->caut_rec_edi_id) {
            $this->receipt_edition = null;
        }
        return $this;
    }

    /**
     * Get caut_rec_edi_id
     *
     * @return int
     */
    public function getCautRecEdiId()
    {
        return $this->caut_rec_edi_id;
    }

    /**
     * Set receipt_edition
     *
     * @param \FreeFW\Model\Edition $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setReceiptEdition($p_value)
    {
        $this->receipt_edition = $p_value;
        if ($this->receipt_edition) {
            $this->caut_rec_edi_id = $this->receipt_edition->getEdiId();
        }
        return $this;
    }

    /**
     * Get receipt_edition
     *
     * @param boolean $p_force
     *
     * @return \FreeFW\Model\Edition
     */
    public function getReceiptEdition($p_force = false)
    {
        if ($this->receipt_edition === null || $p_force) {
            if ($this->caut_rec_edi_id > 0) {
                $this->receipt_edition = \FreeFW\Model\Edition::findFirst(['edi_id' => $this->caut_rec_edi_id]);
            } else {
                $this->receipt_edition = null;
            }
        }
        return $this->receipt_edition;
    }

    /**
     * Set caut_cert_edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\CauseType
     */
    public function setCautCertEdiid($p_value)
    {
        $this->caut_cert_edi_id = $p_value;
        if ($this->certificate_edition && $this->certificate_edition->getEdiId() !== $this->caut_rec_edi_id) {
            $this->certificate_edition = null;
        }
        return $this;
    }

    /**
     * Get caut_cert_edi_id
     *
     * @return int
     */
    public function getCautCertEdiId()
    {
        return $this->caut_cert_edi_id;
    }

    /**
     * Set certificate_edition
     *
     * @param \FreeFW\Model\Edition $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCertificateEdition($p_value)
    {
        $this->certificate_edition = $p_value;
        if ($this->certificate_edition) {
            $this->caut_cert_edi_id = $this->certificate_edition->getEdiId();
        }
        return $this;
    }

    /**
     * Get certificate_edition
     *
     * @param boolean $p_force
     *
     * @return \FreeFW\Model\Edition
     */
    public function getCertificateEdition($p_force = false)
    {
        if ($this->certificate_edition === null || $p_force) {
            if ($this->caut_cert_edi_id > 0) {
                $this->certificate_edition = \FreeFW\Model\Edition::findFirst(['edi_id' => $this->caut_cert_edi_id]);
            } else {
                $this->certificate_edition = null;
            }
        }
        return $this->certificate_edition;
    }

    /**
     * Set caut_ident_edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\CauseType
     */
    public function setCautIdentEdiid($p_value)
    {
        $this->caut_ident_edi_id = $p_value;
        if ($this->identity_edition && $this->identity_edition->getEdiId() !== $this->caut_ident_edi_id) {
            $this->identity_edition = null;
        }
        return $this;
    }

    /**
     * Get caut_ident_edi_id
     *
     * @return int
     */
    public function getCautIdentEdiId()
    {
        return $this->caut_ident_edi_id;
    }

    /**
     * Set identity_edition
     *
     * @param \FreeFW\Model\Edition $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setIdentityEdition($p_value)
    {
        $this->identity_edition = $p_value;
        if ($this->identity_edition) {
            $this->caut_ident_edi_id = $this->identity_edition->getEdiId();
        }
        return $this;
    }

    /**
     * Get identity_edition
     *
     * @param boolean $p_force
     *
     * @return \FreeFW\Model\Edition
     */
    public function getIdentityEdition($p_force = false)
    {
        if ($this->identity_edition === null || $p_force) {
            if ($this->caut_ident_edi_id > 0) {
                $this->identity_edition = \FreeFW\Model\Edition::findFirst(['edi_id' => $this->caut_ident_edi_id]);
            } else {
                $this->identity_edition = null;
            }
        }
        return $this->identity_edition;
    }
}
