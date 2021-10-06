<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Sponsorship extends \FreeFW\Core\Service
{

    /**
     * Send notification
     *
     * @param \FreeAsso\Model\Donation $p_sponsorship
     * @param string                   $p_event_name
     * @param \FreeFW\Model\Automate   $p_automate
     *
     * @return boolean
     */
    public function notification($p_sponsorship, $p_event_name, \FreeFW\Model\Automate $p_automate)
    {
        $client = $p_sponsorship->getClient();
        if ($client->getCliEmail() != '') {
            /**
             * @var \FreeFW\Service\Email $emailService
             */
            $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
            $emailId = $p_automate->getEmailId();
            if (!$emailId) {
                $emailId = $p_automate->getAutoParam('email_id', 0);
            }
            if ($emailId) {
                $filters = [
                    'email_id' => $emailId
                ];
            } else {
                $filters = [
                    'email_code' => 'DONATION'
                ];
            }
            /**
             *
             * @var \FreeFW\Model\Message $message
             */
            $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), $p_sponsorship);
            if ($message) {
                $message
                    ->addDest($client->getCliEmail())
                ;
                $sendIdentity = $p_automate->getAutoParam('send_identity', false);
                if ($sendIdentity) {
                    $cause = $p_sponsorship->getCause();
                    if ($cause) {
                        $causeType = $cause->getCauseType();
                        $ediId = $causeType->getCautIdentEdiId();
                        if ($ediId > 0) {
                            /**
                             * @var \FreeFW\Service\Edition $editionService
                             */
                            $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                            $datas = $editionService->printEdition(
                                $ediId,
                                $client->getLangId(),
                                $cause
                            );
                            if (isset($datas['filename']) && is_file($datas['filename'])) {
                                $message->addAttachment($datas['filename'], $cause->getCauName() . '.pdf');
                            }
                        }
                    }
                }
                return $message->create();
            }
        } else {
            $cause = $p_sponsorship->getCause();
            // Add notofication for manual send...
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifObjectName('FreeAsso_Sponsorship')
                ->setNotifObjectId($p_sponsorship->getSpoId())
                ->setNotifSubject('Nouvel ami sans email : ' . $client->getFullname() . ' ' . $cause->getCauName())
                ->setNotifCode('SPONSORSHIP_WITHOUT_EMAIL')
                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
            return $notification->create();
        }
        return true;
    }

    /**
     * generate debit for one day
     *
     * @param \Datetime $p_date
     *
     * @return boolean
     */
    public function generateOneDebit(\Datetime $p_date)
    {
        $year   = intval($p_date->format('Y'));
        $month  = intval($p_date->format('m'));
        $day    = intval(1);
        $errors = false;
        /**
         * @var \FreeAsso\Model\Sponsorship $sponsorship
         */
        $sponsorship = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsorship');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $dStart = $p_date;
        $dStart->setTime(0, 0, 0, 0);
        $dEnd   = $p_date;
        $dEnd->add(new \DateInterval('P1M'));
        $query  = $sponsorship->getQuery();
        $query
            ->addFromFilters(
                [
                    'spo_from' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::datetimeToMysql($dStart)],
                    'spo_to' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::datetimeToMysql($dEnd)],
                    'spo_freq' => \FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH
                ]
            )
            ->addRelations(['client', 'cause'])
            ->setSort('cli_firstname,cli_lastname');
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            if ($results->count() > 0) {
                /**
                 * Get first active session, else quit...
                 * @var \FreeAsso\Model\Session $session
                 */
                $session = \FreeAsso\Model\Session::findFirst(
                    [
                        'sess_status' => \FreeAsso\Model\Session::STATUS_OPEN
                    ]
                );
                /**
                 * First create Donation Origin
                 * @var \FreeAsso\Model\DonationOrigin $donOrig
                 */
                $donOrig = \FreeFW\DI\DI::get('FreeAsso::Model::DonationOrigin');
                $donOrig
                    ->setDonoDay($day)
                    ->setDonoMonth($month)
                    ->setDonoYear($year)
                    ->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_PENDING)
                    ->setDonoTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                $report = '<ul>';
                if (!$donOrig->create()) {
                    return false;
                }
                if (!$session) {
                    $donOrig
                        ->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_ERROR)
                        ->save();
                    /**
                     * Add notification
                     * @var \FreeFW\Model\Notification $notification
                     */
                    $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                    $notification
                        ->setNotifType(\FreeFW\Model\Notification::TYPE_ERROR)
                        ->setNotifObjectName('FreeAsso_DonationOrigin')
                        ->setNotifObjectId($donOrig->getDonoId())
                        ->setNotifSubject('Error generating donations !')
                        ->setNotifCode('DONATION_GENERATION_NO_SESSION')
                        ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                    $notification->create();
                    return false;
                }
                foreach ($results as $sponsorship) {
                    /**
                     * New donation
                     * @var \FreeAsso\Model\Donation $donation
                     */
                    $donation = $sponsorship->getNewDonation($p_date);
                    $donation
                        ->setDonoId($donOrig->getDonoId())
                        ->setSessId($session->getSessId())
                        ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK);
                    $report .= '<li>';
                    $client = $sponsorship->getClient();
                    $report .= $client->getFullname();
                    if (!$client->isActive($p_date)) {
                        /**
                         * Add notification
                         * @var \FreeFW\Model\Notification $notification
                         */
                        $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                        $notification
                            ->setNotifType(\FreeFW\Model\Notification::TYPE_WARNING)
                            ->setNotifObjectName('FreeAsso_Client')
                            ->setNotifObjectId($client->getCliId())
                            ->setNotifSubject('Active sponsorship on a disabled member !')
                            ->setNotifCode('DONATION_ON_DISABLED_MEMBER')
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        $notification->create();
                    }
                    $report .= ' ' . $donation->getDonMnt() . ' ' . $donation->getDonMoney();
                    $cause = $sponsorship->getCause();
                    if ($cause) {
                        $report .= ' (' . $cause->getCauName() . ')';
                        if (!$cause->isActive($p_date)) {
                            /**
                             * Add notification
                             * @var \FreeFW\Model\Notification $notification
                             */
                            $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                            $notification
                                ->setNotifType(\FreeFW\Model\Notification::TYPE_WARNING)
                                ->setNotifObjectName('FreeAsso_Cause')
                                ->setNotifObjectId($cause->getCauId())
                                ->setNotifSubject('Active sponsorship on a disabled cause !')
                                ->setNotifCode('DONATION_ON_DISABLED_CAUSE')
                                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                            $notification->create();
                        }
                    }
                    if (!$donation->create()) {
                        // @todo
                        $report .= ' **ERROR** ';
                        $errors .= print_r($donation->getErrors(), true) . PHP_EOL;
                        $this->logger->error(print_r($donation->getErrors(), true));
                    }
                    $report .= '</li>';
                }
                $report .= '</ul>';
                if ($errors) {
                    $donOrig->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_ERROR);
                } else {
                    $donOrig->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_OK);
                }
                $donOrig
                    ->setDonoComments($report)
                    ->save();
                if ($errors) {
                    /**
                     * Add notification
                     * @var \FreeFW\Model\Notification $notification
                     */
                    $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                    $notification
                        ->setNotifType(\FreeFW\Model\Notification::TYPE_ERROR)
                        ->setNotifObjectName('FreeAsso_DonationOrigin')
                        ->setNotifObjectId($donOrig->getDonoId())
                        ->setNotifSubject('Error generating donations !')
                        ->setNotifCode('DONATION_GENERATION_ERROR')
                        ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ->setNotifText($errors);
                    $notification->create();
                    $this->logger->error(print_r($notification->getErrors(), true));
                }
            }
        }
        return true;
    }

    /**
     * For each client, get last donation
     *
     * @param array params
     *
     * @return array
     */
    public function generateDebit($p_params = [])
    {
        $this->logger->debug('Sponsorship.generateDebit.START');
        /**
         * @var \DateTime  $lastOk
         */
        $lastOk = \FreeFW\Tools\Date::getServerDatetime();
        /**
         * @var \DateTime  $now
         */
        $now    = \FreeFW\Tools\Date::getServerDatetime();
        if (array_key_exists('last', $p_params)) {
            $lastOk = \FreeFW\Tools\Date::mysqlToDatetime($p_params['last']);
        }
        $year   = intval($lastOk->format('Y'));
        $month  = intval($lastOk->format('m'));
        $nYear  = intval($now->format('Y'));
        $nMonth = intval($now->format('m'));
        // Force same time...
        while (($month < $nMonth && $year === $nYear) || $year < $nYear) {
            $lastOk->add(new \DateInterval('P1M'));
            $this->logger->debug('Generating ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . '...');
            $this->generateOneDebit(clone $lastOk);
        }
        $this->logger->debug('Start from ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . ' excluded');
        $p_params['last'] = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->logger->debug('Sponsorship.generateDebit.END');
        return $p_params;
    }
}
