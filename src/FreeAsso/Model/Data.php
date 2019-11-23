<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Data
 *
 * @author jeromeklam
 */
class Data extends \FreeAsso\Model\Base\Data implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->data_id = 0;
        $this->brk_id  = 0;
        return $this;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \FreeAsso\Model\Base\Data::setDataCode()
     */
    public function setDataCode($p_value)
    {
        $data_code = \FreeFW\Tools\PBXString::withoutAccent($this->data_name);
        $data_code = strtoupper($data_code);
        $data_code = str_replace(["-", ".", "_", " "], '', $data_code);
        //
        $this->data_code = $data_code;
        return $this;
    }

    /**
     * 
     */
    public function beforeCreate()
    {
        $this->setDataCode($this->data_name);
        return true;
    }

    /**
     *
     */
    public function beforeSave()
    {
        $this->setDataCode($this->data_name);
        return true;
    }
}
