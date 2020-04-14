<?php
namespace FreeAsso\Service;

/**
 * 
 * @author jeromeklam
 *
 */
class Cause extends \FreeFW\Core\Service
{

    /**
     * For each cause, update mnts
     * 
     * @return void
     */
    public function updateMnts()
    {
        $model = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
        $query = $model->getQuery();
        $query->execute([], 'updateMnt');
    }
}
