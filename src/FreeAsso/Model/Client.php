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
     * Last donation
     * @var \FreeAsso\Model\Donation
     */
    protected $last_donation = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cli_id           = 0;
        $this->brk_id           = 0;
        $this->clic_id          = 0;
        $this->clit_it          = '';
        $this->cli_active       = true;
        $this->last_don_id      = null;
        $this->cli_display_site = true;
        $this->cli_send_news    = true;
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

    /**
     * Set last donation
     * 
     * @param \FreeAsso\Model\Donation $p_donation
     * 
     * @return \FreeAsso\Model\Client
     */
    public function setLastDonation($p_donation)
    {
        $this->last_donation = $p_donation;
        return $this;
    }

    /**
     * Get last donation
     *
     * @return \FreeAsso\Model\Donation
     */
    public function getLastDonation()
    {
        return $this->last_donation;
    }

    /**
     * Update last donation
     * 
     * @return boolean
     */
    public function updateLastDonation()
    {
        $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
        $query   = $model->getQuery();
        $filters = [
            'cli_id'     => $this->getCliId(),
            'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
            'don_ts'     => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()]
        ];
        $query
            ->addFromFilters($filters)
            ->setSort('-don_ts')
            ->setLimit(0, 1)
        ;
        if ($query->execute()) {
            $results = $query->getResult();
            if ($results) {
                foreach ($results as $row) {
                    $this->setLastDonId($row->getDonId());
                    return $this->save();
                }
            }
        }
        return true;
    }
}
