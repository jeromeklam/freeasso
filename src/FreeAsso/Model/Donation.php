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
    use \FreeFW\Behaviour\EventManagerAwareTrait;
    use \FreeFW\Behaviour\AutomateAwareTrait;
    use \FreeAsso\Model\Behaviour\AccountingLine;
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeAsso\Model\Behaviour\Certificate;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\DonationOrigin;
    use \FreeAsso\Model\Behaviour\PaymentType;
    use \FreeAsso\Model\Behaviour\Session;
    use \FreeAsso\Model\Behaviour\Sponsorship;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * STATUS
     * @var string
     */
    const STATUS_OK   = 'OK';
    const STATUS_WAIT = 'WAIT';
    const STATUS_NEXT = 'NEXT';
    const STATUS_NOK  = 'NOK';

    const VERIF_NONE   = 'NONE';
    const VERIF_AUTO   = 'AUTO';
    const VERIF_MANUAL = 'MANUAL';

    /**
     * Old donation
     * @var \FreeAsso\Model\Donation
     */
    protected $old_donation = null;

    /**
     * Check session
     * @var boolean
     */
    protected $check_session = true;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $ts    = \FreeFW\Tools\Date::getCurrentTimestamp();
        $year  = date('Y');
        $month = date('m');
        //
        $this->don_id           = 0;
        $this->don_ts           = $ts;
        $this->don_ask_ts       = $ts;
        $this->don_real_ts      = $ts;
        $this->don_status       = self::STATUS_OK;
        $this->dono_id          = null;
        $this->spo_id           = null;
        $this->don_display_site = true;
        $this->don_money        = 'EUR';
        $this->session          = \FreeAsso\Model\Session::getFactory(intval($year), intval($month));
        return $this;
    }

    /**
     * Set check_session
     *
     * @param boolean $p_check
     * 
     * @return \FreeAsso\Model\Donation
     */
    public function setCheckSession($p_check = true)
    {
        $this->check_session = $p_check;
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
            $realTs = \FreeFW\Tools\Date::mysqlToDatetime($this->don_real_ts);
            $session = \FreeAsso\Model\Session::findSession($realTs);
            $this->setSession($session);
        }
    }

    /**
     * Update client last donation
     */
    protected function updateAfterDbAction()
    {
        $client = $this->getClient(true);
        if ($client) {
            if (!$client->updateLastDonation()) {
                $this->addErrors($client->getErrors());
                return false;
            }
        }
        // Update cause
        $cause  = $this->getCause();
        if ($cause) {
            if (!$cause->handleDonation()) {
                $this->addErrors($cause->getErrors());
                $this->addError(\FreeAsso\Constants::ERROR_DONATION_UPDATEDB, "Erreur de mise à jour du bénéficiare");
                return false;
            }
        }
        if ($this->old_donation && $this->old_donation->getCauId() !== $this->getCauId()) {
            $cause = $this->old_donation->getCause();
            if ($cause) {
                if (!$cause->handleDonation()) {
                    $this->addError(\FreeAsso\Constants::ERROR_DONATION_UPDATEDB, "Erreur de mise à jour du bénéficiare (2)");
                    return false;
                }
            }
        }
        // Certificate ??
        if ($this->getCertId() > 0) {
            $certificate = \FreeAsso\Model\Certificate::findFirst(['cert_id' => $this->getCertId()]);
            if ($certificate) {
                if (!$certificate->generate()) {
                    $this->addErrors($certificate->getErrors());
                    return false;
                }
            }
        }
        //
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function beforeRemove()
    {
        if ($this->getCertId() > 0 && $this->getSpoId() > 0) {
            $this
                ->addError(\FreeAsso\Constants::ERROR_CERTIFICATE_EXISTS, 'Il existe un certificat associé')
            ;
            return false;
        }
        $this->old_donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $this->getDonId()]);
        $client = $this->getClient(true);
        if ($client) {
            $lastDonation = $client->getLastDonation();
            if ($lastDonation && $lastDonation->getDonId() == $this->getDonId()) {
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
                $client->setLastDonId(null);
                return $client->save();
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
        if ($this->getCertId() > 0) {
            $certificate = \FreeAsso\Model\Certificate::findFirst(['cert_id' => $this->getCertId()]);
            if ($certificate) {
                if (!$certificate->remove()) {
                    $this->addErrors($certificate->getErrors());
                    return false;
                }
            }
        }
        if ($this->isRawBehaviour()) {
            return true;
        }
        // Update cause
        $cause = $this->getCause();
        if ($cause) {
            return $cause->handleDonation();
        }
        return $this->updateAfterDbAction();
    }

    /**
     *
     * @return boolean
     */
    public function beforeCreate()
    {
        $cause  = $this->getCause();
        $client = $this->getClient();
        /**
         * Pas de génération de certificat pour un don régulier, fait à part...
         */
        if ($cause->getCauseType()->getCautCertificat() && $this->getSpoId() <= 0) {
            /**
             * @var \FreeAsso\Model\Certificate $certificate
             */
            $certificate = $this->getCertificate();
            if (!$certificate instanceof \FreeAsso\Model\Certificate) {
                $certificate = new \FreeAsso\Model\Certificate();
            }
            if ($this->getDonCertname() != '') {
                $certificate->setCertFullname($this->getDonCertname());
            } else {
                $certificate->setCertFullname($client->getCliFullname());
            }
            if ($this->getDonCertemail() != '') {
                $certificate->setCertEmail($this->getDonCertemail());
            }
            $certificate
                ->setClient($client)
                ->setCertManual(false)
                ->setCertTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setCertGents(null)
                ->setCertPrintTs(null)
                ->setCertInputMnt($this->getDonMntInput())
                ->setCertInputMoney($this->getDonMoneyInput())
                ->setCertOutputMoney($cause->getCauUnitMoney())
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
                ->setCauId($this->getCauId())
                ->setCertDisplayMnt($this->getDonCertdispmnt())
            ;
            $certificate->calculateFields();
            if (!$certificate->create()) {
                $this->addErrors($certificate->getErrors());
                return false;
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
        // Update datas
        if (!$this->updateAfterDbAction()) {
            $this->addError(\FreeAsso\Constants::ERROR_DONATION_UPDATEDB, "Erreur updateDb " . $this->getDonId());
            return false;
        }
        // Jamais de notification pour la création d'un don pour un paiement régulier
        if ($this->getDonSendEmail() && ($this->getSpoId() === null || $this->getSpoId() <= 0)) {
            /**
             * @var \FreeAsso\Service\Donation $donationService
             */
            $donationService = \FreeFW\DI\DI::get('FreeAsso::Service::Donation');
            $donationService->notification($this, "create", true);
        }
        return true;
    }

    /**
     * Before save
     *
     * @return boolean
     */
    public function beforeSave()
    {
        $test = trim(strip_tags($this->getDonDesc()));
        if ($test != '') {
            $add = '<p><b>' . \FreeFW\Tools\Date::mysqlToddmmyyyy(\FreeFW\Tools\Date::getCurrentTimestamp()) . '</b>';
            $add .= ' : ' . $this->getDonDesc() . '</p>';
            $test = trim(strip_tags($this->getDonComment()));
            if ($test != '') {
                $add .= $this->getDonComment();
            }
            $this
                ->setDonComment($add)
                ->setDonDesc(null)
            ;
        }
        $this->old_donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $this->getDonId()]);
        if ($this->getCliId() != $this->old_donation->getCliId()) {
            $this->addError(\FreeAsso\Constants::ERROR_DONATION_CANT_CHANGE_CLIENT, "Can't change client");
        }
        if ($this->getCauId() != $this->old_donation->getCauId()) {
            // On ne peut le changer que si le type ne change pas...
            if ($this->getCause()->getCautId() !== $this->old_donation->getCause()->getCautId()) {
                $this->addError(\FreeAsso\Constants::ERROR_DONATION_CANT_CHANGE_CAUSE, "Can't change cause");
            }
        }
        if (!$this->hasErrors()) {
            if ($this->getDonMntInput() != $this->old_donation->getDonMntInput() ||
                $this->getDonMoneyInput() != $this->old_donation->getDonMoneyInput()) {
                $certificate = $this->getCertificate();
                if ($certificate) {
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
        }
        return !$this->hasErrors();
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
        $this->updateAfterDbAction();
        return true;
    }

    /**
     * @see \FreeFW\Core\Model validate
     */
    public function validate()
    {
        parent::validate();
        // En modification, si la session n'est pas ouverte il faut un motif
        if ($this->getDonId() > 0 && $this->check_session) {
            $session = $this->getSession();
            if ($session && $session->getSessStatus() != \FreeAsso\Model\Session::STATUS_OPEN) {
                $test = trim(strip_tags($this->getDonDesc()));
                if ($test == '') {
                    $this->addError(
                        \FreeAsso\Constants::ERROR_DONATION_NEED_REASON,
                        'Need reason to save',
                        \FreeFW\Core\Error::TYPE_PRECONDITION,
                        'don_desc'
                    );
                } 
            }
        }
        if ($this->getSpoId() <= 0 && $this->getDonEndTs() == '') {
            $this->addError(
                \FreeFW\Constants::ERROR_REQUIRED,
                'Need end date',
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                'don_end_ts'
            );
            return false;
        }
        return $this;
    }

    /**
     * Specific fields
     *
     * @return array
     */
    public function getSpecificEditionFields()
    {
        $fields   = [];
        $fields[] = [
            'name'    => 'don_regular',
            'type'    => 'boolean',
            'title'   => 'regular',
            'content' => $this->getSpoId() > 0,
        ];
        $date = \FreeFW\Tools\Date::mysqlToDatetime($this->getDonRealTs());
        $year = intval($date->format('Y'));
        $fields[] = [
            'name'    => 'don_year',
            'type'    => 'integer',
            'title'   => 'Année',
            'content' => $year,
        ];
        $monnaie = $this->getDonMoney();
        if ($monnaie === 'EUR') {
            $monnaie = '€';
        }
        $fields[] = [
            'name'    => 'money',
            'type'    => 'string',
            'title'   => 'Monnaie',
            'content' => $monnaie
        ];
        return $fields;
    }

    /**
     * Check session
     *
     * @return void
     */
    public function verifySession()
    {
        $realts  = \FreeFW\Tools\Date::mysqlToDatetime($this->getDonRealTs());
        $session = \FreeAsso\Model\Session::findSession($realts, $this->getGrpId(), false);
        if ($session && $session->getSessId() != $this->getSessId()) {
            $year = intval($realts->format('Y'));
            $month = intval($realts->format('m'));
            $session = \FreeAsso\Model\Session::getFactory($year, $month, $this->getGrpId());
            $this
                ->setSession($session)
                ->setDonDesc('Mise à jour de la session')
            ;
            $this->logger->info('Session update ' . $this->getDonId());
            $this->save(false, true);
        }
    }

    /**
     * Undocumented function
     *
     * @param array $p_types
     * 
     * @return int
     */
    public function detectReceiptType($p_types)
    {
        $type = 0;
        /**
         * @var \FreeAsso\Model\Cause $cause
         */
        $cause = $this->getCause();
        $bReg  = false;
        if ($this->getSpoId() > 0) {
            $bReg = true;
        }
        /**
         * @var \FreeAsso\Model\ReceiptType $oneType
         */
        foreach ($p_types as $oneType) {
            /**
             * @var \FreeAsso\Model\ReceiptTypeCauseType $oneSetting
             */
            foreach ($oneType->getSettings() as $oneSetting) {
                if ($oneSetting->getCautId() == $cause->getCautId()) {
                    if (($oneSetting->getRtctOnce() && !$bReg) || ($oneSetting->getRtctRegular() && $bReg)) {
                        return $oneType->getRettId();
                    }
                }
            }
        }
        return $type;
    }

    /**
     * Generate statistics
     * 
     * @param array $p_stats
     * 
     * @return void
     */
    public function computeStatistics(&$p_stats)
    {
        $real = \FreeFW\Tools\Date::mysqlToDatetime($this->getDonRealTs());
        $key  = $real->format('Ym');
        $mnt  = number_format($this->getDonMnt(), 2);
        if (!isset($p_stats[$key])) {
            $p_stats[$key] = [
                'total' => 0
            ];
            $p_stats[$key]['donation'] = [
                'total' => 0
            ];
            $p_stats[$key]['sponsorship'] = [
                'total' => 0
            ];
            $payments = \FreeAsso\Model\PaymentType::find();
            foreach ($payments as $onePayment) {
                $p_stats[$key]['donation']['ptyp_' . $onePayment->getPtypId()] = 0;
                $p_stats[$key]['sponsorship']['ptyp_' . $onePayment->getPtypId()] = 0;
                $p_stats[$key][$onePayment->getPtypId()] = 0;
            }
            $causeType = \FreeAsso\Model\CauseType::find();
            foreach ($causeType as $oneType) {
                $p_stats[$key]['donation']['caut_' . $oneType->getCautId()] = 0;
                $p_stats[$key]['sponsorship']['caut_' . $oneType->getCautId()] = 0;
                $p_stats[$key][$oneType->getCautId()] = 0;
            }
        }
        $p_stats[$key]['total'] += $mnt;
        $p_stats[$key]['ptyp_' . $this->getPtypId()] += $mnt;
        $p_stats[$key]['caut_' . $this->getCause()->getCautId()] += $mnt;
        if ($this->getSpoId() > 0) {
            $p_stats[$key]['sponsorship']['total'] += $mnt;
            $p_stats[$key]['sponsorship']['ptyp_' . $this->getPtypId()] += $mnt;
            $p_stats[$key]['sponsorship']['caut_' . $this->getCause()->getCautId()] += $mnt;
        } else {
            $p_stats[$key]['donation']['total'] += $mnt;
            $p_stats[$key]['donation']['ptyp_' . $this->getPtypId()] += $mnt;
            $p_stats[$key]['donation']['caut_' . $this->getCause()->getCautId()] += $mnt;
        }
    }
}
