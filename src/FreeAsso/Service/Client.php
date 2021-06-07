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
     * @param array                  $p_params
     *
     * @return boolean
     */
    public function notification($p_client, $p_event_name, array $p_params = [])
    {
        if ($p_client->getCliEmail() != '') {
            $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
            $filters = [
                'email_code' => 'CLIENT'
            ];
            if (is_array($p_params) && isset($p_params['email_id'])) {
                $filters = [
                    'email_id' => $p_params['email_id']
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
                if (is_array($p_params) && isset($p_params['edi1_id'])) {
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    $datas = $editionService->printEdition(
                        $p_params['edi1_id'],
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
