<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Config
 *
 * @author jeromeklam
 */
class Config extends \FreeAsso\Model\Base\Config implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Config codes
     * @var string
     */
    const CONFIG_CAUT_STRING_1     = 'CAUT_STRING_1';
    const CONFIG_CAUT_STRING_2     = 'CAUT_STRING_2';
    const CONFIG_CAUT_STRING_3     = 'CAUT_STRING_3';
    const CONFIG_CAUT_STRING_4     = 'CAUT_STRING_4';
    const CONFIG_CAUT_NUMBER_1     = 'CAUT_NUMBER_1';
    const CONFIG_CAUT_NUMBER_2     = 'CAUT_NUMBER_2';
    const CONFIG_CAUT_NUMBER_3     = 'CAUT_NUMBER_3';
    const CONFIG_CAUT_NUMBER_4     = 'CAUT_NUMBER_4';
    const CONFIG_CAUT_BOOL_1       = 'CAUT_BOOL_1';
    const CONFIG_CAUT_BOOL_2       = 'CAUT_BOOL_2';
    const CONFIG_CAUT_BOOL_3       = 'CAUT_BOOL_3';
    const CONFIG_CAUT_BOOL_4       = 'CAUT_BOOL_4';
    const CONFIG_CAUT_DATE_1       = 'CAUT_DATE_1';
    const CONFIG_CAUT_DATE_2       = 'CAUT_DATE_2';
    const CONFIG_CAUT_DATE_3       = 'CAUT_DATE_3';
    const CONFIG_CAUT_DATE_4       = 'CAUT_DATE_4';
    const CONFIG_CAUT_TEXT_1       = 'CAUT_TEXT_1';
    const CONFIG_CAUT_TEXT_2       = 'CAUT_TEXT_2';
    const CONFIG_CAUT_TEXT_3       = 'CAUT_TEXT_3';
    const CONFIG_CAUT_TEXT_4       = 'CAUT_TEXT_4';
    const CONFIG_SITT_STRING_1     = 'SITT_STRING_1';
    const CONFIG_SITT_STRING_2     = 'SITT_STRING_2';
    const CONFIG_SITT_STRING_3     = 'SITT_STRING_3';
    const CONFIG_SITT_STRING_4     = 'SITT_STRING_4';
    const CONFIG_SITT_NUMBER_1     = 'SITT_NUMBER_1';
    const CONFIG_SITT_NUMBER_2     = 'SITT_NUMBER_2';
    const CONFIG_SITT_NUMBER_3     = 'SITT_NUMBER_3';
    const CONFIG_SITT_NUMBER_4     = 'SITT_NUMBER_4';
    const CONFIG_SITT_BOOL_1       = 'SITT_BOOL_1';
    const CONFIG_SITT_BOOL_2       = 'SITT_BOOL_2';
    const CONFIG_SITT_BOOL_3       = 'SITT_BOOL_3';
    const CONFIG_SITT_BOOL_4       = 'SITT_BOOL_4';
    const CONFIG_SITT_DATE_1       = 'SITT_DATE_1';
    const CONFIG_SITT_DATE_2       = 'SITT_DATE_2';
    const CONFIG_SITT_DATE_3       = 'SITT_DATE_3';
    const CONFIG_SITT_DATE_4       = 'SITT_DATE_4';
    const CONFIG_SITT_TEXT_1       = 'SITT_TEXT_1';
    const CONFIG_SITT_TEXT_2       = 'SITT_TEXT_2';
    const CONFIG_SITT_TEXT_3       = 'SITT_TEXT_3';
    const CONFIG_SITT_TEXT_4       = 'SITT_TEXT_4';

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->acfg_id    = 0;
        $this->brk_id     = 0;
        $this->acfg_code  = '';
        $this->acfg_value = '';
        return $this;
    }
}
