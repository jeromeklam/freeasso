<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * ClientType
 *
 * @author jeromeklam
 */
class ClientType extends \FreeAsso\Model\Base\ClientType implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

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
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->clit_id       = 0;
        $this->brk_id        = 0;
        $this->clit_name     = '';
        $this->clit_string_1 = 0;
        $this->clit_string_2 = 0;
        $this->clit_string_3 = 0;
        $this->clit_string_4 = 0;
        $this->clit_number_1 = 0;
        $this->clit_number_2 = 0;
        $this->clit_number_3 = 0;
        $this->clit_number_4 = 0;
        $this->clit_date_1   = 0;
        $this->clit_date_2   = 0;
        $this->clit_date_3   = 0;
        $this->clit_date_4   = 0;
        $this->clit_bool_1   = 0;
        $this->clit_bool_2   = 0;
        $this->clit_bool_3   = 0;
        $this->clit_bool_4   = 0;
        $this->clit_text_1   = 0;
        $this->clit_text_2   = 0;
        $this->clit_text_3   = 0;
        $this->clit_text_4   = 0;
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeAsso\Model\Base\ClientType::setClitCode()
     */
    public function setClitCode($p_value)
    {
        $clit_code = \FreeFW\Tools\PBXString::withoutAccent($p_value);
        $clit_code = strtoupper($clit_code);
        $clit_code = str_replace(["-", ".", "_", " "], '', $clit_code);
        //
        $this->clit_code = $clit_code;
        return $this;
    }
    
    /**
     *
     */
    public function beforeCreate()
    {
        $this->setClitCode($this->clit_name);
        return true;
    }
    
    /**
     *
     */
    public function beforeSave()
    {
        $this->setClitCode($this->clit_name);
        return true;
    }

    /**
     * Set add email id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitAddEmailId($p_id)
    {
        $this->clit_add_email_id = $p_id;
        if ($this->add_email) {
            if ($this->add_email->getEmailId() !== $this->clit_add_email_id) {
                $this->add_email = null;
            }
        }
        return $this;
    }

    /**
     * get clit_add_email_id
     *
     * @return int
     */
    public function getClitAddEmailId()
    {
        return $this->clit_add_email_id;
    }

    /**
     * Set add_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function setAddEmail($p_email)
    {
        $this->add_email = $p_email;
        if ($this->add_email) {
            $this->clit_add_email_id = $this->add_email->getEmailId();
        } else {
            $this->clit_add_email_id = null;
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
        if (!$this->add_email && $this->clit_add_email_id) {
            $this->add_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->clit_add_email_id]);
        }
        return $this->add_email;
    }

    /**
     * Set update email id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitUpdateEmailId($p_id)
    {
        $this->clit_update_email_id = $p_id;
        if ($this->update_email) {
            if ($this->update_email->getEmailId() !== $this->clit_update_email_id) {
                $this->update_email = null;
            }
        }
        return $this;
    }

    /**
     * get clit_update_email_id
     *
     * @return int
     */
    public function getClitUpdateEmailId()
    {
        return $this->clit_update_email_id;
    }

    /**
     * Set update_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function setUpdateEmail($p_email)
    {
        $this->update_email = $p_email;
        if ($this->update_email) {
            $this->clit_update_email_id = $this->update_email->getEmailId();
        } else {
            $this->clit_update_email_id = null;
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
        if (!$this->update_email && $this->clit_update_email_id) {
            $this->update_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->clit_update_email_id]);
        }
        return $this->update_email;
    }

    /**
     * Set end email id
     * 
     * @param int $p_id
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitEndEmailId($p_id)
    {
        $this->clit_end_email_id = $p_id;
        if ($this->end_email) {
            if ($this->end_email->getEmailId() !== $this->clit_end_email_id) {
                $this->end_email = null;
            }
        }
        return $this;
    }

    /**
     * get clit_end_email_id
     *
     * @return int
     */
    public function getClitEndEmailId()
    {
        return $this->clit_end_email_id;
    }

    /**
     * Set end_email
     *
     * @param \FreeFW\Model\Email $p_email
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function setEndEmail($p_email)
    {
        $this->end_email = $p_email;
        if ($this->end_email) {
            $this->clit_end_email_id = $this->end_email->getEmailId();
        } else {
            $this->clit_end_email_id = null;
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
        if (!$this->end_email && $this->clit_end_email_id) {
            $this->end_email = \FreeFW\Model\Email::findFirst(['email_id' => $this->clit_end_email_id]);
        }
        return $this->end_email;
    }
}
