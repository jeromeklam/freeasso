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
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

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
     * Add email
     * @var \FreeFW\Model\Email
     */
    protected $add_email = null;

    /**
     * Update email
     * @var \FreeFW\Model\Email
     */
    protected $update_email = null;

    /**
     * End email
     * @var \FreeFW\Model\Email
     */
    protected $end_email = null;

    /**
     * Add sponsorship email
     * @var \FreeFW\Model\Email
     */
    protected $sponsorship_add_email = null;

    /**
     * Update sponsorship email
     * @var \FreeFW\Model\Email
     */
    protected $sponsorship_update_email = null;

    /**
     * End sponsorship email
     * @var \FreeFW\Model\Email
     */
    protected $sponsorship_end_email = null;

    /**
     * Add donation email
     * @var \FreeFW\Model\Email
     */
    protected $donation_add_email = null;

    /**
     * Update donation email
     * @var \FreeFW\Model\Email
     */
    protected $donation_update_email = null;

    /**
     * End donation email
     * @var \FreeFW\Model\Email
     */
    protected $donation_end_email = null;

    /**
     * Generation donation email
     * @var \FreeFW\Model\Email
     */
    protected $donation_generate_email = null;

    /**
     * Settings
     * @var [\FreeAsso\Model\ReceiptTypeCauseType]
     */
    protected $settings = null;

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

    /**
     * Set add email id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautAddEmailId($p_id)
    {
        $this->caut_add_email_id = $p_id;
        if ($this->add_email) {
            if ($this->add_email->getEmailId() !== $this->caut_add_email_id) {
                $this->add_email = null;
            }
        }
        return $this;
    }

    /**
     * get caut_add_email_id
     *
     * @return int
     */
    public function getCautAddEmailId()
    {
        return $this->caut_add_email_id;
    }

    /**
     * Set add_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setAddEmail($p_email)
    {
        $this->add_email = $p_email;
        if ($this->add_email) {
            $this->caut_add_email_id = $this->add_email->getEmailId();
        } else {
            $this->caut_add_email_id = null;
        }
        return $this;
    }

    /**
     * Get add_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getAddEmail()
    {
        if (!$this->add_email && $this->caut_add_email_id) {
            $this->add_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_add_email_id]);
        }
        return $this->add_email;
    }

    /**
     * Set update email id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautUpdateEmailId($p_id)
    {
        $this->caut_update_email_id = $p_id;
        if ($this->update_email) {
            if ($this->update_email->getEmailId() !== $this->caut_update_email_id) {
                $this->update_email = null;
            }
        }
        return $this;
    }

    /**
     * get caut_update_email_id
     *
     * @return int
     */
    public function getCautUpdateEmailId()
    {
        return $this->caut_update_email_id;
    }

    /**
     * Set update_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setUpdateEmail($p_email)
    {
        $this->update_email = $p_email;
        if ($this->update_email) {
            $this->caut_update_email_id = $this->update_email->getEmailId();
        } else {
            $this->caut_update_email_id = null;
        }
        return $this;
    }

    /**
     * Get update_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getUpdateEmail()
    {
        if (!$this->update_email && $this->caut_update_email_id) {
            $this->update_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_update_email_id]);
        }
        return $this->update_email;
    }

    /**
     * Set end email id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautEndEmailId($p_id)
    {
        $this->caut_end_email_id = $p_id;
        if ($this->end_email) {
            if ($this->end_email->getEmailId() !== $this->caut_end_email_id) {
                $this->end_email = null;
            }
        }
        return $this;
    }

    /**
     * get caut_end_email_id
     *
     * @return int
     */
    public function getCautEndEmailId()
    {
        return $this->caut_end_email_id;
    }

    /**
     * Set end_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setEndEmail($p_email)
    {
        $this->end_email = $p_email;
        if ($this->end_email) {
            $this->caut_end_email_id = $this->end_email->getEmailId();
        } else {
            $this->caut_end_email_id = null;
        }
        return $this;
    }

    /**
     * Get end_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getEndEmail()
    {
        if (!$this->end_email && $this->caut_end_email_id) {
            $this->end_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_end_email_id]);
        }
        return $this->end_email;
    }

    /**
     * Set caut_spo_add_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautSpoAddEmailId($p_id)
    {
        $this->caut_spo_add_email_id = $p_id;
        if ($this->sponsorship_add_email) {
            if ($this->sponsorship_add_email->getEmailId() !== $this->caut_spo_add_email_id) {
                $this->sponsorship_add_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_spo_add_email_id
     *
     * @return int
     */
    public function getCautSpoAddEmailId()
    {
        return $this->caut_spo_add_email_id;
    }

    /**
     * Set sponsorship_add_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setSponsorshipAddEmail($p_email)
    {
        $this->sponsorship_add_email = $p_email;
        if ($this->sponsorship_add_email) {
            $this->caut_spo_add_email_id = $this->sponsorship_add_email->getEmailId();
        } else {
            $this->caut_spo_add_email_id = null;
        }
        return $this;
    }

    /**
     * Get sponsorship_add_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getSponsorshipAddEmail()
    {
        if (!$this->sponsorship_add_email && $this->caut_spo_add_email_id) {
            $this->sponsorship_add_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_spo_add_email_id]);
        }
        return $this->sponsorship_add_email;
    }

    /**
     * Set caut_spo_update_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautSpoUpdateEmailId($p_id)
    {
        $this->caut_spo_update_email_id = $p_id;
        if ($this->sponsorship_update_email) {
            if ($this->sponsorship_update_email->getEmailId() !== $this->caut_spo_update_email_id) {
                $this->sponsorship_update_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_spo_update_email_id
     *
     * @return int
     */
    public function getCautSpoUpdateEmailId()
    {
        return $this->caut_spo_update_email_id;
    }

    /**
     * Set sponsorship_update_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setSponsorshipUpdateEmail($p_email)
    {
        $this->sponsorship_update_email = $p_email;
        if ($this->sponsorship_update_email) {
            $this->caut_spo_update_email_id = $this->sponsorship_update_email->getEmailId();
        } else {
            $this->caut_spo_update_email_id = null;
        }
        return $this;
    }

    /**
     * Get sponsorship_update_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getSponsorshipUpdateEmail()
    {
        if (!$this->sponsorship_update_email && $this->caut_spo_update_email_id) {
            $this->sponsorship_update_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_spo_update_email_id]);
        }
        return $this->sponsorship_update_email;
    }

    /**
     * Set caut_spo_end_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautSpoEndEmailId($p_id)
    {
        $this->caut_spo_end_email_id = $p_id;
        if ($this->sponsorship_end_email) {
            if ($this->sponsorship_end_email->getEmailId() !== $this->caut_spo_end_email_id) {
                $this->sponsorship_end_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_spo_end_email_id
     *
     * @return int
     */
    public function getCautSpoEndEmailId()
    {
        return $this->caut_spo_end_email_id;
    }

    /**
     * Set sponsorship_end_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setSponsorshipEndEmail($p_email)
    {
        $this->sponsorship_end_email = $p_email;
        if ($this->sponsorship_end_email) {
            $this->caut_spo_end_email_id = $this->sponsorship_end_email->getEmailId();
        } else {
            $this->caut_spo_end_email_id = null;
        }
        return $this;
    }

    /**
     * Get sponsorship_end_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getSponsorshipEndEmail()
    {
        if (!$this->sponsorship_end_email && $this->caut_spo_end_email_id) {
            $this->sponsorship_end_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_spo_end_email_id]);
        }
        return $this->sponsorship_end_email;
    }

    /**
     * Set caut_don_add_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDonAddEmailId($p_id)
    {
        $this->caut_don_add_email_id = $p_id;
        if ($this->donation_add_email) {
            if ($this->donation_add_email->getEmailId() !== $this->caut_don_add_email_id) {
                $this->donation_add_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_don_add_email_id
     *
     * @return int
     */
    public function getCautDonAddEmailId()
    {
        return $this->caut_don_add_email_id;
    }

    /**
     * Set donation_add_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setDonationAddEmail($p_email)
    {
        $this->donation_add_email = $p_email;
        if ($this->donation_add_email) {
            $this->caut_don_add_email_id = $this->donation_add_email->getEmailId();
        } else {
            $this->caut_don_add_email_id = null;
        }
        return $this;
    }

    /**
     * Get donation_add_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getDonationAddEmail()
    {
        if (!$this->donation_add_email && $this->caut_don_add_email_id) {
            $this->donation_add_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_don_add_email_id]);
        }
        return $this->donation_add_email;
    }

    /**
     * Set caut_don_update_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDonUpdateEmailId($p_id)
    {
        $this->caut_don_update_email_id = $p_id;
        if ($this->donation_update_email) {
            if ($this->donation_update_email->getEmailId() !== $this->caut_don_update_email_id) {
                $this->donation_update_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_don_update_email_id
     *
     * @return int
     */
    public function getCautDonUpdateEmailId()
    {
        return $this->caut_don_update_email_id;
    }

    /**
     * Set donation_update_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setDonationUpdateEmail($p_email)
    {
        $this->donation_update_email = $p_email;
        if ($this->donation_update_email) {
            $this->caut_don_update_email_id = $this->donation_update_email->getEmailId();
        } else {
            $this->caut_don_update_email_id = null;
        }
        return $this;
    }

    /**
     * Get donation_update_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getDonationUpdateEmail()
    {
        if (!$this->donation_update_email && $this->caut_don_update_email_id) {
            $this->donation_update_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_don_update_email_id]);
        }
        return $this->donation_update_email;
    }

    /**
     * Set caut_don_end_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDonEndEmailId($p_id)
    {
        $this->caut_don_end_email_id = $p_id;
        if ($this->donation_end_email) {
            if ($this->donation_end_email->getEmailId() !== $this->caut_don_end_email_id) {
                $this->donation_end_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_don_end_email_id
     *
     * @return int
     */
    public function getCautDonEndEmailId()
    {
        return $this->caut_don_end_email_id;
    }

    /**
     * Set donation_end_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setDonationEndEmail($p_email)
    {
        $this->donation_end_email = $p_email;
        if ($this->donation_end_email) {
            $this->caut_don_end_email_id = $this->donation_end_email->getEmailId();
        } else {
            $this->caut_don_end_email_id = null;
        }
        return $this;
    }

    /**
     * Get donation_end_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getDonationEndEmail()
    {
        if (!$this->donation_end_email && $this->caut_don_end_email_id) {
            $this->donation_end_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_don_end_email_id]);
        }
        return $this->donation_end_email;
    }

    /**
     * Set caut_don_generate_email_id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDonGenerateEmailId($p_id)
    {
        $this->caut_don_generate_email_id = $p_id;
        if ($this->donation_generate_email) {
            if ($this->donation_generate_email->getEmailId() !== $this->caut_don_generate_email_id) {
                $this->donation_generate_email = null;
            }
        }
        return $this;
    }

    /**
     * Get caut_don_generate_email_id
     *
     * @return int
     */
    public function getCautDonGenerateEmailId()
    {
        return $this->caut_don_generate_email_id;
    }

    /**
     * Set donation_generate_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function setDonationGenerateEmail($p_email)
    {
        $this->donation_generate_email = $p_email;
        if ($this->donation_generate_email) {
            $this->caut_don_generate_email_id = $this->donation_generate_email->getEmailId();
        } else {
            $this->caut_don_generate_email_id = null;
        }
        return $this;
    }

    /**
     * Get donation_generate_email
     *
     * @return \FreeFW\Model\Email
     */
    public function getDonationGenerateEmail()
    {
        if (!$this->donation_generate_email && $this->caut_don_generate_email_id) {
            $this->donation_generate_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->caut_don_generate_email_id]);
        }
        return $this->donation_generate_email;
    }

    /**
     * Set settings
     *
     * @param [\FreeAsso\Model\ReceiptTypeCauseType] $p_settings
     * 
     * @return \FreeFW\Model\CauseType
     */
    public function setSettings($p_settings)
    {
        $this->settings = $p_settings;
        return $this;
    }

    /**
     * Get settings
     *
     * @return [\FreeAsso\Model\ReceiptTypeCauseType]
     */
    public function getSettings()
    {
        if ($this->settings === null) {
            $this->settings = \FreeAsso\Model\ReceiptTypeCauseType::find(['caut_id' => $this->getCautId()]);
        }
        return $this->settings;
    }
}
