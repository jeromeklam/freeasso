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
}
