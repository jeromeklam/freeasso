<?php

namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Movement extends \FreeFW\Core\ApiController
{
    /**
     * Get pendings movements
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPendings(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Movement.getPendings.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        $default = $p_request->getAttribute('default_model');
        $model   = \FreeFW\DI\DI::get($default);
        $filters = new \FreeFW\Model\Conditions();
        $filters->initFromArray(
            [
                'move_status' => \FreeAsso\Model\Movement::STATUS_WAIT
            ]
        );
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = $model->getQuery();
        $query
            ->addConditions($filters)
            ->addRelations($apiParams->getInclude())
            ->setSort($apiParams->getSort())
        ;
        $data = new \FreeFW\Model\ResultSet();
        if ($query->execute()) {
            $data = $query->getResult();
        }
        $this->logger->debug('FreeAsso.Movement.getPendings.end');
        return $this->createResponse(200, $data);
    }

    /**
     * Get file content for download
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param string                                   $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function validate(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $ret = true;
        $apiParams  = $p_request->getAttribute('api_params', false);
        $myMovement = \FreeAsso\Model\Movement::findFirst(['move_id' => $p_id]);
        if ($myMovement) {
            if ($myMovement->canValidate()) {
                $causeMovements = \FreeAsso\Model\CauseMovement::find(['move_id' => $myMovement->getMoveId()]);
                if ($causeMovements) {
                    $myMovement->startTransaction();
                    foreach ($causeMovements as $causeMovement) {
                        $causeMovement->setCamvStatus(\FreeAsso\Model\Movement::STATUS_OK);
                        if (!$causeMovement->save()) {
                            $myMovement->addErrors($causeMovement->getErrors());
                            $ret = false;
                            break;
                        }
                    }
                    if ($ret) {
                        $myMovement->setMoveStatus(\FreeAsso\Model\Movement::STATUS_OK);
                        $ret = $myMovement->save();
                    }
                    if (!$ret) {
                        $myMovement->rollbackTransaction();
                        return $this->createErrorResponse(FFCST::ERROR_NOT_UPDATE, $myMovement);
                    }
                    $myMovement->commitTransaction();
                    $data = $this->getModelById($apiParams, $myMovement, $myMovement->getApiId());
                    return $this->createResponse(200, $data);
                }
            } else {
                return $this->createErrorResponse(FFCST::ERROR_NOT_UPDATE, $myMovement);
            }
        }
        return $this->createResponse(409);
    }
}
