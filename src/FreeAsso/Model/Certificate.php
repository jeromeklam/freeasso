<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Certificate
 *
 * @author jeromeklam
 */
class Certificate extends \FreeAsso\Model\Base\Certificate
{

    /**
     * Country
     * @var \FreeFW\Model\Country
     */
    protected $country = null;

    /**
     * Langue
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
        $this->cert_id    = 0;
        $this->cli_id     = 0;
        $this->brk_id     = 0;
        $this->file_id    = null;
        $this->lang_id    = null;
        $this->cnty_id    = null;
        return $this;
    }

    /**
     * Set country
     *
     * @param \FreeFW\Model\Country $p_country
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCountry($p_country)
    {
        $this->country = $p_country;
        return $this;
    }

    /**
     * Get country
     *
     * @return \FreeFW\Model\Country
     */
    public function getCountry()
    {
        return $this->country;
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
}
