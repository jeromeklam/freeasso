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
    use \FreeFW\Behaviour\AutomateAwareTrait;
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
        return true;
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

    /**
     * Return first sponsorship
     *
     * @return \FreeAsso\Model\Sponsorship | false
     */
    public function getFirstSponsor()
    {
        $now   = \FreeFW\Tools\Date::getCurrentTimestamp();
        /**
         * @var \FreeFW\Model\Query $query
         */
        return \FreeAsso\Model\Sponsorship::findFirst(
            [
                'cli_id'   => $this->getCliId(),
                'spo_to'   => [ \FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => $now ],
                'spo_from' => [ \FreeFW\Storage\Storage::COND_LOWER_EQUAL_OR_NULL => $now ],
            ],
            [
                'spo_from' => \FreeFW\Storage\Storage::SORT_DESC
            ]
        );
    }

    /**
     * Specific fields
     *
     * @return array
     */
    public function getSpecificEditionFields($p_tmp_dir = '/tmp/', $p_keep_binary = true, $p_lang_code = null)
    {
        $fields  = [];
        $sponsor = $this->getFirstSponsor();
        if ($sponsor) {
            $fields[] = [
                'name'    => 'is_sponsor',
                'type'    => 'boolean',
                'title'   => 'sponsor',
                'content' => 1,
            ];
            $fields[] = [
                'name'    => 'spo_from',
                'type'    => 'date',
                'title'   => 'spo_from',
                'content' => \FreeFW\Tools\Date::mysqlToddmmyyyy($sponsor->getSpoFrom(), false, false),
            ];
        } else {
            $fields[] = [
                'name'    => 'is_sponsor',
                'type'    => 'boolean',
                'title'   => 'sponsor',
                'content' => 0,
            ];
            $fields[] = [
                'name'    => 'spo_from',
                'type'    => 'date',
                'title'   => 'spo_from',
                'content' => null,
            ];
        }
        $full_address = '';
        if (trim($this->getCliAddress1()) != '') {
            $full_address = trim($this->getCliAddress1());
        }
        if (trim($this->getCliAddress2()) != '') {
            $full_address = trim($full_address) . ' ' . trim($this->getCliAddress2());
        }
        if (trim($this->getCliAddress3()) != '') {
            $full_address = trim($full_address) . ' ' . trim($this->getCliAddress3());
        }
        if (trim($this->getCliCp()) != '') {
            $full_address = trim($full_address) . ' ' . trim($this->getCliCp());
        }
        if (trim($this->getCliTown()) != '') {
            $full_address = trim($full_address) . ' ' . trim($this->getCliTown());
        }
        $country = $this->getCountry();
        if ($country) {
            if ($p_lang_code == 'fr' && $country->getCntyName() != '') {
                $full_address = trim($full_address) . ' ' . trim($country->getCntyName());
            } else {
                $full_address = trim($full_address) . ' ' . trim($country->getCntyNameEn());
            }
        }
        $fields[] = [
            'name'    => 'cli_full_address',
            'type'    => 'string',
            'title'   => 'Addresse',
            'content' => $full_address,
        ];
        return $fields;
    }

    /**
     * Send Email
     *
     * @param [type] $p_email
     * 
     * @return void
     */
    public function sendEmail($p_email)
    {
        if ($this->getCliEmail() != '') {
            $filters = [
                'email_id' => $p_email->getEmailId()
            ];
            $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
            /**
             *
             * @var \FreeFW\Model\Message $message
             */
            $message = $emailService->getEmailAsMessage($filters, $this->getLangId(), $this);
            if ($message) {
                $message
                    ->addDest($this->getCliEmail())
                    ->setDestId($this->getCliId())
                ;
                return $message->create();
            }
        } else {
            // Add notofication for manual send...
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifObjectName('FreeAsso_Client')
                ->setNotifObjectId($this->getCliId())
                ->setNotifSubject($p_email->getEmailSubject() . ' : ' . $this->getFullname())
                ->setNotifCode('CLIENT_WITHOUT_EMAIL')
                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ;
            return $notification->create();
        }
        return true;
    }

    /**
     * Before merge
     *
     * @param \FreeFW\Model\MergeModel $p_datas
     * @param string                   $p_block
     * @param array                    $p_includes
     *
     * @return \FreeFW\Model\MergeModel
     */
    public function beforeMerge($p_datas, $p_block, $p_includes)
    {
        $sponsorships = [];
        $donations    = [];
        if (isset($p_includes['sponsorships']) || in_array('sponsorships', $p_includes)) {
            /**
             * @var \FreeFW\Model\Query $query
             */
            $query = \FreeAsso\Model\Sponsorship::getQuery();
            $query
                ->addFromFilters(['cli_id' => $this->getCliId()])
                ->addRelations(['cause','paymentType'])
                ->setSort('-spo_from')
            ;
            if ($query->execute()) {
                $all = $query->getResult();
                /**
                 * @var \FreeAsso\Model\Sponsorship $oneSponsorship
                 */
                foreach ($all as $oneSponsorship) {
                    $sponsorships[] = [
                        'cau_name'  => $oneSponsorship->getCause()->getCauName(),
                        'spo_from'  => \FreeFW\Tools\Date::mysqlToddmmyyyy($oneSponsorship->getSpoFrom(), false, false),
                        'spo_to'    => \FreeFW\Tools\Date::mysqlToddmmyyyy($oneSponsorship->getSpoTo(), false, false),
                        'spo_mnt'   => number_format($oneSponsorship->getSpoMntInput(), 2, ',', ' ') . ' ' . $oneSponsorship->getSpoMoneyInput(),
                        'ptyp_name' => $oneSponsorship->getPaymentType()->getPtypName()
                    ];
                }
            }
        }
        if (isset($p_includes['donations']) || in_array('donations', $p_includes)) {
            /**
             * @var \FreeFW\Model\Query $query
             */
            $query = \FreeAsso\Model\Donation::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id'     => $this->getCliId(),
                    ]
                )
                ->addRelations(['cause','paymentType'])
                ->setSort('-don_real_ts')
            ;
            if ($query->execute()) {
                $all = $query->getResult();
                /**
                 * @var \FreeAsso\Model\Donation $oneDonation
                 */
                foreach ($all as $oneDonation) {
                    $donations[] = [
                        'cau_name'    => $oneDonation->getCause()->getCauName(),
                        'don_real_ts' => \FreeFW\Tools\Date::mysqlToddmmyyyy($oneDonation->getDonRealTs(), false, false),
                        'don_mnt'     => number_format($oneDonation->getDonMntInput(), 2, ',', ' ') . ' ' . $oneDonation->getDonMoneyInput(),
                        'ptyp_name'   => $oneDonation->getPaymentType()->getPtypName() . '(' . $oneDonation->getDonStatus() . ')'
                    ];
                }
            }
        }
        // Add blocks
        $p_datas->addBlock($p_block . '_sponsorships', true);
        $p_datas->addData($sponsorships, $p_block . '_sponsorships', true);
        $p_datas->addBlock($p_block . '_donations', true);
        $p_datas->addData($donations, $p_block . '_donations', true);
        return $p_datas;
    }
}
