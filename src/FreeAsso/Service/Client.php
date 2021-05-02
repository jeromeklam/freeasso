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
        $query   = \FreeAsso\Model\Donation::getQuery();
        $filters = [
            'cli_id'     => $p_client->getCliId(),
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
    public function newMember($p_client, $p_event_name, array $p_params = [])
    {
        if ($p_event_name === \FreeFW\Constants::EVENT_STORAGE_CREATE) {
            if ($p_client->getCliEmail() != '') {
                $filename = '';
                try {
                    if (is_array($p_params) && isset($p_params['ediId'])) {
                        $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                        $fileName       = $editionService->printEdition($p_params['ediId'], $p_client->getLangId(), $p_client);
                    }
                } catch (\Exception $ex) {
                    // @todo
                }
                $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
                $emailCode    = 'NEW_CLIENT';
                if (is_array($p_params) && isset($p_params['emailCode'])) {
                    $emailCode = $p_params['emailCode'];
                }
                /**
                 * @var \FreeFW\Model\Message $message
                 */
                $message      = $emailService->getEmailAsMessage(
                    $emailCode,
                    $p_client->getLangId(),
                    $p_client
                );
                $message
                    ->addDest($p_client->getCliEmail())
                    ->setMsgPj1($fileName)
                    ->setMsgPj1Name('carte_membre.pdf')
                ;
                return $message->create();
            }
            return false;
        }
        return true;
    }
}
