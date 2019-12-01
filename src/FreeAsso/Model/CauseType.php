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
     * Type de montant
     * @var string
     */
    const MNT_TYPE_OTHER   = 'OTHER';
    const MNT_TYPE_ANNUAL  = 'ANNUAL';
    const MNT_TYPE_MAXIMUM = 'MAXIMUM';

    /**
     * Type de cause principal
     * @var \FreeAsso\Model\CauseMainType
     */
    protected $cause_main_type = null;
    
    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caut_id         = 0;
        $this->brk_id          = 0;
        $this->caut_name       = '';
        $this->caut_receipt    = 0;
        $this->caut_certificat = 0;
        $this->caut_mnt_type   = self::MNT_TYPE_OTHER;
        $this->caut_string_1   = 0;
        $this->caut_string_2   = 0;
        $this->caut_string_3   = 0;
        $this->caut_string_4   = 0;
        $this->caut_number_1   = 0;
        $this->caut_number_2   = 0;
        $this->caut_number_3   = 0;
        $this->caut_number_4   = 0;
        $this->caut_bool_1     = 0;
        $this->caut_bool_2     = 0;
        $this->caut_bool_3     = 0;
        $this->caut_bool_4     = 0;
        $this->caut_date_1     = 0;
        $this->caut_date_2     = 0;
        $this->caut_date_3     = 0;
        $this->caut_date_4     = 0;
        $this->caut_text_1     = 0;
        $this->caut_text_2     = 0;
        $this->caut_text_3     = 0;
        $this->caut_text_4     = 0;
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
}
