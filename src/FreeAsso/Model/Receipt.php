<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Receipt
 *
 * @author jeromeklam
 */
class Receipt extends \FreeAsso\Model\Base\Receipt
{

    /**
     * Client
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

    /**
     * Country
     * @var \FreeFW\Model\Country
     */
    protected $country = null;

    /**
     * Lang
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
        $this->rec_id  = 0;
        $this->brk_id  = 0;
        $this->rec_ts  = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->rec_mnt = 0;
        return $this;
    }

    /**
     * Set client
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setClient($p_client)
    {
        $this->client = $p_client;
        return $this;
    }

    /**
     * Get client
     *
     * @return \FreeAsso\Model\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set country
     * 
     * @param \FreeFW\Model\Country $p_country
     * 
     * @return \FreeAsso\Model\Receipt
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
     * @return \FreeAsso\Model\Receipt
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
