<?php
namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Client extends \FreeFW\Core\Service
{

    /**
     * For each client, get last donation
     *
     * @return void
     */
    public function updateAll()
    {
        $model = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
        $query = $model->getQuery();
        $query->execute([], 'updateLastDonation');
    }

    /**
     * Update last donation
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return boolean
     */
    public function updateLastDonation(\FreeAsso\Model\Client &$p_client)
    {
        $query = \FreeAsso\Model\Donation::getQuery();
        $filters = [
            'cli_id' => $p_client->getCliId(),
            'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
            'don_ts' => [
                \FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()
            ]
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
                    $p_client->setLastDonId($row->getDonId());
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Send email to new member
     *
     * @param \FreeAsso\Model\Client $p_client
     * @param string                 $p_event_name
     * @param \FreeFW\Model\Automate $p_automate
     *
     * @return boolean
     */
    public function notification($p_client, $p_event_name, \FreeFW\Model\Automate $p_automate)
    {
        if ($p_client->getCliEmail() != '') {
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
                    'email_code' => 'CLIENT'
                ];
            }
            /**
             *
             * @var \FreeFW\Model\Message $message
             */
            $message = $emailService->getEmailAsMessage($filters, $p_client->getLangId(), $p_client);
            if ($message) {
                $message
                    ->addDest($p_client->getCliEmail())
                ;
                $edi1Id = $p_automate->getAutoParam('edi1_id', 0);
                if ($edi1Id) {
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    $datas = $editionService->printEdition(
                        $edi1Id,
                        $p_client->getLangId(),
                        $p_client
                    );
                    if (isset($datas['filename']) && is_file($datas['filename'])) {
                        $message->addAttachment($datas['filename'], $datas['name']);
                    }
                }
                return $message->create();
            }
        } else {
            // Add notofication for manual send...
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifObjectName('FreeAsso_Client')
                ->setNotifObjectId($p_client->getCliId())
                ->setNotifSubject('Nouveau membre sans email')
                ->setNotifCode('CLIENT_WITHOUT_EMAIL')
                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ;
            return $notification->create();
        }
        return true;
    }
}
