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
    const CONFIG_CAU_STRING_1      = 'CAU_STRING_1';
    const CONFIG_CAU_STRING_2      = 'CAU_STRING_2';
    const CONFIG_CAU_STRING_3      = 'CAU_STRING_3';
    const CONFIG_CAU_STRING_4      = 'CAU_STRING_4';
    const CONFIG_CAU_NUMBER_1      = 'CAU_NUMBER_1';
    const CONFIG_CAU_NUMBER_2      = 'CAU_NUMBER_2';
    const CONFIG_CAU_NUMBER_3      = 'CAU_NUMBER_3';
    const CONFIG_CAU_NUMBER_4      = 'CAU_NUMBER_4';
    const CONFIG_CAU_BOOL_1        = 'CAU_BOOL_1';
    const CONFIG_CAU_BOOL_2        = 'CAU_BOOL_2';
    const CONFIG_CAU_BOOL_3        = 'CAU_BOOL_3';
    const CONFIG_CAU_BOOL_4        = 'CAU_BOOL_4';
    const CONFIG_CAU_DATE_1        = 'CAU_DATE_1';
    const CONFIG_CAU_DATE_2        = 'CAU_DATE_2';
    const CONFIG_CAU_DATE_3        = 'CAU_DATE_3';
    const CONFIG_CAU_DATE_4        = 'CAU_DATE_4';
    const CONFIG_CAU_TEXT_1        = 'CAU_TEXT_1';
    const CONFIG_CAU_TEXT_2        = 'CAU_TEXT_2';
    const CONFIG_CAU_TEXT_3        = 'CAU_TEXT_3';
    const CONFIG_CAU_TEXT_4        = 'CAU_TEXT_4';
    const CONFIG_SITE_STRING_1     = 'SITE_STRING_1';
    const CONFIG_SITE_STRING_2     = 'SITE_STRING_2';
    const CONFIG_SITE_STRING_3     = 'SITE_STRING_3';
    const CONFIG_SITE_STRING_4     = 'SITE_STRING_4';
    const CONFIG_SITE_STRING_5     = 'SITE_STRING_5';
    const CONFIG_SITE_STRING_6     = 'SITE_STRING_6';
    const CONFIG_SITE_NUMBER_1     = 'SITE_NUMBER_1';
    const CONFIG_SITE_NUMBER_2     = 'SITE_NUMBER_2';
    const CONFIG_SITE_NUMBER_3     = 'SITE_NUMBER_3';
    const CONFIG_SITE_NUMBER_4     = 'SITE_NUMBER_4';
    const CONFIG_SITE_NUMBER_5     = 'SITE_NUMBER_5';
    const CONFIG_SITE_NUMBER_6     = 'SITE_NUMBER_6';
    const CONFIG_SITE_BOOL_1       = 'SITE_BOOL_1';
    const CONFIG_SITE_BOOL_2       = 'SITE_BOOL_2';
    const CONFIG_SITE_BOOL_3       = 'SITE_BOOL_3';
    const CONFIG_SITE_BOOL_4       = 'SITE_BOOL_4';
    const CONFIG_SITE_DATE_1       = 'SITE_DATE_1';
    const CONFIG_SITE_DATE_2       = 'SITE_DATE_2';
    const CONFIG_SITE_DATE_3       = 'SITE_DATE_3';
    const CONFIG_SITE_DATE_4       = 'SITE_DATE_4';
    const CONFIG_SITE_TEXT_1       = 'SITE_TEXT_1';
    const CONFIG_SITE_TEXT_2       = 'SITE_TEXT_2';
    const CONFIG_SITE_TEXT_3       = 'SITE_TEXT_3';
    const CONFIG_SITE_TEXT_4       = 'SITE_TEXT_4';

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
