<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;
use FreeAsso\Controller\certificate;

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
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeAsso\Model\Behaviour\Certificate;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\DonationOrigin;
    use \FreeAsso\Model\Behaviour\PaymentType;
    use \FreeAsso\Model\Behaviour\Session;
    use \FreeAsso\Model\Behaviour\Sponsorship;

    /**
     * STATUS
     * @var string
     */
    const STATUS_OK   = 'OK';
    const STATUS_WAIT = 'WAIT';
    const STATUS_NEXT = 'NEXT';
    const STATUS_NOK  = 'NOK';

    /**
     * Old donation
     * @var \FreeAsso\Model\Donation
     */
    protected $old_donation = null;

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
     * Get don_real_ts_year
     *
     * @return mixed
     */
    public function getDonRealTsYear()
    {
        if (!$this->don_real_ts_year) {
            $date = \FreeFW\Tools\Date::mysqlToDatetime($this->getDonRealTs());
            if ($date) {
                $this->don_real_ts_year = intval($date->format('Y'));
            }
        }
        return $this->don_real_ts_year;
    }

    /**
     *
     */
    public function afterRead()
    {
        if ($this->isRawBehaviour()) {
            return true;
        }
        if ($this->getSessId() <= 0) {
            $session = \FreeAsso\Model\Session::findFirst(
                [
                    'sess_type'     => \FreeAsso\Model\Session::TYPE_STANDARD,
                    'sess_exercice' => date('Y')
                ]
            );
            if ($session) {
                $this->setSession($session);
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
        $this->old_donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $this->getDonId()]);
        $client = $this->getClient(true);
        if ($client) {
            $lastDonation = $client->getLastDonation();
            if ($lastDonation->getDonId() == $this->getDonId()) {
                $model   = new \FreeAsso\Model\Donation();
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
     * After remove
     *
     * @return boolean
     */
    public function afterRemove()
    {
        if ($this->isRawBehaviour()) {
            return true;
        }
        // Update cause
        $cause = $this->getCause();
        if ($cause) {
            return $cause->handleDonation(null, $this->old_donation);
        }
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function beforeCreate()
    {
        $cause  = $this->getCause();
        $client = $this->getClient();
        if ($cause->getCauseType()->getCautCertificat()) {
            /**
             * @var \FreeAsso\Model\Certificate $certificate
             */
            $certificate = $this->getCertificate();
            if (!$certificate instanceof \FreeAsso\Model\Certificate) {
                $certificate = new \FreeAsso\Model\Certificate();
            }
            if ($certificate->getCertFullname() == '') {
                $certificate->setCertFullname($client->getFullname());
            }
            if ($certificate->getCertEmail() == '') {
                $certificate->setCertEmail($client->getCliEmail());
            }
            $certificate
                ->setClient($client)
                ->setCertTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setCertGents(null)
                ->setCertPrintTs(null)
                ->setCertInputMnt($this->getDonMntInput())
                ->setCertInputMoney($this->getDonMoneyInput())
                ->setCertOutputMoney('IDR')
                ->setCertUnitBase($cause->getCauUnitBase())
                ->setCertUnitUnit($cause->getCauUnitUnit())
                ->setCertUnitMnt($cause->getCauUnitMnt())
                ->setCertAddress1($client->getCliAddress1())
                ->setCertAddress2($client->getCliAddress2())
                ->setCertAddress3($client->getCliAddress3())
                ->setCertCp($client->getCliCp())
                ->setCertTown($client->getCliTown())
                ->setCntyId($client->getCntyId())
                ->setLangId($client->getLangId())
            ;
            $certificate->calculateFields();
            if (!$certificate->create()) {
                $this->addErrors($certificate->getErrors());
                return false;
            }
            $alert = new \FreeFW\Model\Alert();
            $alert
                ->setAlertObjectName('FreeAsso_Certificate')
                ->setAlertObjectId($certificate->getCertId())
                ->setAlertTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setAlertFrom(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setTodoAlert()
                ->setAlertDoneAction(\FreeAsso\Constants::ACTION_CERTIFICATE_PRINT)
            ;
            if (!$alert->create()) {
                $this->addErrors($alert->getErrors());
            }
            $this->setCertId($certificate->getCertId());
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
        if ($this->isRawBehaviour()) {
            return true;
        }
        // Update cause
        $cause  = $this->getCause();
        if ($cause) {
            if (!$cause->handleDonation($this, null)) {
                return false;
            }
        }
        // Update client
        $this->updateClientLastDonation();
        return true;
    }

    /**
     * Before save
     *
     * @return boolean
     */
    public function beforeSave()
    {
        if ($this->isRawBehaviour()) {
            return true;
        }
        $this->old_donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $this->getDonId()]);
        if ($this->getCliId() != $this->old_donation->getCliId()) {
            $this->addError(\FreeAsso\Constants::ERROR_DONATION_CANT_CHANGE_CLIENT, "Can't change client");
        }
        if ($this->getCauId() != $this->old_donation->getCauId()) {
            $this->addError(\FreeAsso\Constants::ERROR_DONATION_CANT_CHANGE_CAUSE, "Can't change cause");
        }
        if (!$this->hasErrors()) {
            if ($this->getDonMntInput() != $this->old_donation->getDonMntInput() ||
                $this->getDonMoneyInput() != $this->old_donation->getDonMoneyInput()) {
                $certificate = $this->getCertificate();
                $certificate
                    ->setCertInputMnt($this->getDonMntInput())
                    ->setCertInputMoney($this->getDonMoneyInput())
                    ->setCertGents(null)
                    ->setCertPrintTs(null)
                ;
                $certificate->calculateFields();
                if (!$certificate->save()) {
                    $this->addErrors($certificate->getErrors());
                }
                $alert = new \FreeFW\Model\Alert();
                $alert
                    ->setAlertObjectName('FreeAsso_Certificate')
                    ->setAlertObjectId($certificate->getCertId())
                    ->setAlertTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setAlertFrom(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setTodoAlert()
                    ->setAlertDoneAction(\FreeAsso\Constants::ACTION_CERTIFICATE_PRINT)
                ;
                $alert->create();
            }
        }
        return $this->hasErrors();
    }

    /**
     * After save
     *
     * @return boolean
     */
    public function afterSave()
    {
        if ($this->isRawBehaviour()) {
            return true;
        }
        // Update cause
        $cause = $this->getCause();
        if ($cause) {
            if (!$cause->handleDonation($this, $this->old_donation)) {
                return false;
            }
        }
        if ($this->old_donation->getCauId() !== $this->getCauId()) {
            $cause = $this->old_donation->getCause();
            if ($cause) {
                if (!$cause->handleDonation($this, $this->old_donation)) {
                    return false;
                }
            }
        }
        return true;
    }
}
