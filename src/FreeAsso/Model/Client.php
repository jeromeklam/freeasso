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
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\ClientCategory;
    use \FreeAsso\Model\Behaviour\ClientType;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeFW\Model\Behaviour\Country;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Genres
     * @var string
     */
    const GENDER_OTHER  = 'OTHER';
    const GENDER_MISTER = 'MISTER';
    const GENDER_MADAM  = 'MADAM';

    /**
     * Site
     * @var \FreeAsso\Model\ClientType
     */
    protected $client_type = null;

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
     * Parent
     * @var \FreeAsso\Model\Client
     */
    protected $parent_client = null;

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
        if ($this->last_donation) {
            $this->setLastDonId($this->last_donation->getDonId());
        }
        return $this;
    }

    /**
     * Get last donation
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Donation
     */
    public function getLastDonation($p_force = false)
    {
        if ($this->last_donation === null || $p_force) {
            if ($this->last_don_id > 0) {
                $this->last_donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $this->last_don_id]);
            } else {
                $this->last_donation = null;
            }
        }
        return $this->last_donation;
    }

    /**
     * Update last donation
     *
     * @return boolean
     */
    public function updateLastDonation()
    {
        /**
         * @var \FreeAsso\Service\Client $clientService
         */
        $clientService = \FreeFW\DI\DI::get('FreeAsso::Service::Client');
        if ($clientService->updateLastDonation($this)) {
            return $this->save();
        }
        return false;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->getCliFullname();
    }

    /**
     * Dummy setter
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliFullname($p_value)
    {
        return $this;
    }

    /**
     * Get full name
     *
     * @return string
     */
    public function getCliFullname()
    {
        $name = trim($this->getCliFirstname()) . ' ' . trim($this->getCliLastname());
        return trim($name);
    }

    /**
     * Client is active ?
     *
     * @param \DateTime $p_date
     *
     * @return string
     */
    public function isActive(\DateTime $p_date = null)
    {
        if ($p_date === null) {
            $p_date = \FreeFW\Tools\Date::getServerDatetime();
        }
        return $this->getCliActive();
    }

    /**
     * Set parent client id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\Client
     */
    public function setParentCliId($p_id)
    {
        $this->parent_cli_id = $p_id;
        if ($this->parent_client) {
            if ($this->parent_client->getCliId() != $this->parent_cli_id) {
                $this->parent_client = null;
            }
        }
        return $this;
    }

    /**
     * Get parent client id
     *
     * @return number
     */
    public function getParentCliId()
    {
        return $this->parent_cli_id;
    }

    /**
     * Set parent
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeFW\Core\Model
     */
    public function setParentClient($p_client)
    {
        $this->parent_client = $p_client;
        if ($p_client) {
            $this->parent_cli_id = $p_client->getCliId();
        }
        return $this;
    }

    /**
     * Get parent
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Client
     */
    public function getParentClient($p_force = false)
    {
        if ($this->parent_client === null || $p_force) {
            if ($this->parent_cli_id > 0) {
                $this->parent_client = \FreeAsso\Model\Client::findFirst(['cli_id' => $this->parent_cli_id]);
            } else {
                $this->parent_client = null;
            }
        }
        return $this->parent_client;
    }

    /**
     * After create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        return true;
    }

    /**
     * Set preferred name
     *
     * @param string $p_name
     *
     * @return \FreeAsso\Model\Client
     */
    public function setCliName($p_name)
    {
        return $this;
    }

    /**
     * Get preferred name
     *
     * @return string
     */
    public function getCliName()
    {
        if ($this->getCliFirstname() != '') {
            return $this->getCliFirstname();
        }
        return $this->getCliLastname();
    }
}
