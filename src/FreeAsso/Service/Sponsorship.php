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
        $day    = intval($p_date->format('d'));
        $errors = false;
        /**
         * @var \FreeAsso\Model\Sponsorship $sponsorship
         */
        $sponsorship = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsorship');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $dStart = $p_date;
        $dEnd   = $p_date;
        $dStart->setTime(0, 0, 1, 0);
        $dEnd->setTime(23, 59, 59, 0);
        $query = $sponsorship->getQuery();
        $query
            ->addFromFilters(
                [
                    'spo_from' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::datetimeToMysql($dStart)],
                    'spo_to' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::datetimeToMysql($dEnd)],
                    'spo_freq_when' => $day,
                    'spo_freq' => \FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH
                ]
            )
            ->addRelations(['client', 'cause'])
        ;
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
                    ->setDonoTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ;
                $report = '<ul>';
                if (!$donOrig->create()) {
                    return false;
                }
                if (!$session) {
                    $donOrig
                        ->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_ERROR)
                        ->save()
                    ;
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
                        ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ;
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
                        ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK)
                    ;
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
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ;
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
                                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                            ;
                            $notification->create();
                        }
                    }
                    if (!$donation->create()) {
                        // @todo
                        $report .= ' **ERROR** ';
                        $errors .= print_r($donation->getErrors(), true) . PHP_EOL;
                        $this->logger->error(sprintf($donation->getErrors(), true));
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
                    ->save()
                ;
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
                        ->setNotifText($errors)
                    ;
                    $notification->create();
                    $this->logger->error(sprintf($notification->getErrors(), true));
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
        $lastOk = \FreeFW\Tools\Date::getServerDatetime();
        if (array_key_exists('last', $p_params)) {
            $lastOk = \FreeFW\Tools\Date::mysqlToDatetime($p_params['last']);
        }
        $now = \FreeFW\Tools\Date::getServerDatetime();
        // Force same time...
        $now->setTime(23, 59, 59, 0);
        $lastOk->setTime(23, 59, 59, 0);
        while ($lastOk < $now) {
            $lastOk->add(new \DateInterval('P1D'));
            $this->logger->debug('Generating ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . '...');
            $this->generateOneDebit($lastOk);
        }
        $this->logger->debug('Start from ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . ' excluded');
        $p_params['last'] = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->logger->debug('Sponsorship.generateDebit.END');
        return $p_params;
    }
}