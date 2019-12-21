<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Client
 *
 * @author jeromeklam
 */
class Client extends \FreeAsso\Model\Base\Client implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Site
     * @var \FreeAsso\Model\ClientCategory
     */
    protected $client_category = null;
    
    /**
     * Site
     * @var \FreeAsso\Model\ClientType
     */
    protected $client_type = null;

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
     * Sponsor
     * @var \FreeAsso\Model\Client
     */
    protected $sponsor = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cli_id     = 0;
        $this->brk_id     = 0;
        $this->clic_id    = 0;
        $this->clit_it    = '';
        $this->cli_active = 1;
        return $this;
    }

    /**
     * Set client category
     * 
     * @param \FreeAsso\Model\ClientCategory $p_category
     * 
     * @return \FreeAsso\Model\Client
     */
    public function setClientCategory($p_category)
    {
        $this->client_category = $p_category;
        return $this;
    }

    /**
     * Get client category
     * 
     * @return \FreeAsso\Model\ClientCategory
     */
    public function getClientCategory()
    {
        return $this->client_category;
    }

    /**
     * Set client type
     * 
     * @param \FreeAsso\Model\ClientType $p_type
     * 
     * @return \FreeAsso\Model\Client
     */
    public function setClientType($p_type)
    {
        $this->client_type = $p_type;
        return $this;
    }

    /**
     * Get client type
     * 
     * @return \FreeAsso\Model\ClientType
     */
    public function getClientType()
    {
        return $this->client_type;
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

    /**
     * Set sponsor
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Client
     */
    public function setSponsor($p_client)
    {
        $this->sponsor = $p_client;
        return $this;
    }

    /**
     * Get sponsor
     * 
     * @return \FreeAsso\Model\Client
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }
}
