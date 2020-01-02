<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMedia
 *
 * @author jeromeklam
 */
class CauseMedia extends \FreeAsso\Model\Base\CauseMedia
{

    /**
     * Langue
     * @var \FreeFW\Model\Lang
     */
    protected $lang = null;

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caum_id = 0;
        $this->brk_id  = 0;
        $this->cau_id  = 0;
        $this->lang_id = null;
        return $this;
    }

    /**
     * Set lang
     *
     * @param \FreeFW\Model\Lang $p_lang
     *
     * @return \FreeAsso\Model\Client
     */
    public function setLang($p_lang)
    {
        $this->lang = $p_lang;
        return $this;
    }

    /**
     * Get lang
     *
     * @return \FreeFW\Model\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set cause
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCause($p_cause)
    {
        $this->cause = $p_cause;
        return $this;
    }
    
    /**
     * Get cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getCause()
    {
        return $this->cause;
    }
}
