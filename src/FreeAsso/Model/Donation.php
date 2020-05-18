<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Donation
 *
 * @author jeromeklam
 */
class Donation extends \FreeAsso\Model\Base\Donation
{

    /**
     * Behaviour
     */
    use \FreeAsso\Behaviour\Cause;
    use \FreeAsso\Behaviour\Client;
    use \FreeAsso\Behaviour\DonationOrigin;
    use \FreeAsso\Behaviour\PaymentType;
    use \FreeAsso\Behaviour\Session;
    use \FreeAsso\Behaviour\Sponsorship;

    /**
     * STATUS
     * @var string
     */
    const STATUS_OK   = 'OK';
    const STATUS_WAIT = 'WAIT';
    const STATUS_NEXT = 'NEXT';
    const STATUS_NOK  = 'NOK';

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->don_id           = 0;
        $this->brk_id           = 0;
        $this->don_ts           = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->don_ask_ts       = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->don_real_ts      = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->don_status       = self::STATUS_OK;
        $this->dono_id          = null;
        $this->sess_id          = null;
        $this->spo_id           = null;
        $this->don_display_site = true;
        $this->don_money        = 'EUR';
        return $this;
    }

    /**
     *
     */
    public function afterRead()
    {
        if ($this->don_id === 0) {
            $session = \FreeAsso\Model\Session::findFirst(
                [
                    'sess_type'     => \FreeAsso\Model\Session::TYPE_STANDARD,
                    'sess_exercice' => date('Y')
                ]
            );
            if ($session) {
                $this
                    ->setSessId($session->getSessId())
                    ->setSession($session)
                ;
            }
        }
    }

    /**
     * Update client last donation
     */
    protected function updateClientLastDonation()
    {
        $client = $this->getClient(true);
        if ($client) {
            $donation = $client->getLastDonation(true);
            if ($donation && $donation->getDonRealTs() <= $this->getDonRealTs()) {
                $client
                    ->setLastDonation($this)
                    ->save()
                ;
            }
        }
    }

    /**
     *
     * @return boolean
     */
    public function beforeRemove()
    {
        $client = $this->getClient(true);
        if ($client) {
            $lastDonation = $client->getLastDonation();
            if ($lastDonation->getDonId() == $this->getDonId()) {
                $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
                $query   = $model->getQuery();
                $filters = [
                    'don_id'     => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => $this->getDonId()],
                    'cli_id'     => $client->getCliId(),
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
                            $client->setLastDonId($row->getDonId());
                            return $client->save();
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * After create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        // Update cause mnt
        $cause = $this->getCause();
        if ($cause) {

        }
        $this->updateClientLastDonation();
        return true;
    }

    /**
     * After save
     *
     * @return boolean
     */
    public function afterSave()
    {
        return true;
    }
}
