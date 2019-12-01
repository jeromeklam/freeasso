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
}
