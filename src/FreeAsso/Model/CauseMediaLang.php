<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMediaLang
 *
 * @author jeromeklam
 */
class CauseMediaLang extends \FreeAsso\Model\Base\CauseMediaLang
{

    /**
     * lang
     * @var \FreeFW\Model\Lang
     */
    protected $lang = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caml_id = 0;
        $this->brk_id  = 0;
        $this->caum_id = 0;
        $this->lang_id = null;
        return $this;
    }
    
    /**
     * Set lang
     *
     * @param \FreeFW\Model\Lang $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
     */
    public function setLang($p_value)
    {
        $this->lang = $p_value;
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
}
