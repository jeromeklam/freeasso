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
}
