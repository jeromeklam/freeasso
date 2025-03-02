<?php
namespace FreeAsso\Model\Base;

/**
 * Sponsor
 *
 * @author jeromeklam
 */
abstract class Sponsor extends \FreeAsso\Model\StorageModel\Sponsor
{

    /**
     * PK
     * @var number
     */
    protected $spon_id = null;

    /**
     * spon_name
     * @var string
     */
    protected $spon_name = null;

    /**
     * spon_email
     * @var string
     */
    protected $spon_email = null;

    /**
     * spon_site
     * @var boolean
     */
    protected $spon_site = true;

    /**
     * spon_news
     * @var string
     */
    protected $spon_news = true;

    /**
     * Client
     * @var number
     */
    protected $cli_id = null;

    /**
     * spon_donator
     * @var boolean
     */
    protected $spon_donator = true;

    /**
     * Set spon_id
     * 
     * @param number $p_value
     * 
     * @return \FreeAsso\Model\Base\Sponsor
     */
    public function setSponId($p_value)
    {
        $this->spon_id = $p_value;
        return $this;
    }

    /**
     * Get spon_id
     * 
     * @return number
     */
    public function getSponId()
    {
        return $this->spon_id;
    }

    /**
     * Set spon_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsor
     */
    public function setSponName($p_value)
    {
        $this->spon_name = $p_value;
        return $this;
    }

    /**
     * Get spon_name
     *
     * @return string
     */
    public function getSponName()
    {
        return $this->spon_name;
    }

    /**
     * Set spon_email
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsor
     */
    public function setSponEmail($p_value)
    {
        $this->spon_email = $p_value;
        return $this;
    }

    /**
     * Get spon_email
     *
     * @return string
     */
    public function getSponEmail()
    {
        return $this->spon_email;
    }

    /**
     * Set spon_site
     *
     * @param boolean $p_value
     *
     * @return \FreeAsso\Model\Sponsor
     */
    public function setSponSite($p_value)
    {
        $this->spon_site = $p_value;
        return $this;
    }

    /**
     * Get spon_site
     *
     * @return boolean
     */
    public function getSponSite()
    {
        return $this->spon_site;
    }

    /**
     * Set spon_news
     *
     * @param boolean $p_value
     *
     * @return \FreeAsso\Model\Sponsor
     */
    public function setSponNews($p_value)
    {
        $this->spon_news = $p_value;
        return $this;
    }

    /**
     * Get spon_news
     *
     * @return boolean
     */
    public function getSponNews()
    {
        return $this->spon_news;
    }

    /**
     * Set client id
     * 
     * @param number $p_value
     * 
     * @return \FreeAsso\Model\Base\Sponsor
     */
    public function setCliId($p_value)
    {
        $this->cli_id = $p_value;
        return $this;
    }

    /**
     * Get cli_id
     * 
     * @return number
     */
    public function getCliId()
    {
        return $this->cli_id;
    }

    /**
     * Set donator
     * 
     * @param boolean $p_value
     * 
     * @return \FreeAsso\Model\Base\Sponsor
     */
    public function setSponDonator($p_value)
    {
        $this->spon_donator = $p_value;
        return $this;
    }

    /**
     * Get donator
     * 
     * @return boolean
     */
    public function getSponDonator()
    {
        return $this->spon_donator;
    }
}
