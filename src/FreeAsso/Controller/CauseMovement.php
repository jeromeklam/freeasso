<?php
namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class CauseMovement extends \FreeFW\Core\ApiController
{
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
        $apiParams  = $p_request->getAttribute('api_params', false);
        $myMovement = \FreeAsso\Model\CauseMovement::findFirst(['camv_id' => $p_id]);
        if ($myMovement) {
            $myCause = \FreeAsso\Model\Cause::findFirst(['cau_id' => $myMovement->getCauId()]);
            if ($myCause) {
                $myMovement->setCamvStatus(\FreeAsso\Model\Movement::STATUS_OK);
                if (!$myMovement->save()) {
                    return $this->createErrorResponse(FFCST::ERROR_NOT_UPDATE, $myMovement);
                }
                $data = $this->getModelById($apiParams, $myMovement, $myMovement->getApiId());
                return $this->createResponse(200, $data);
            }
        }
        return $this->createResponse(409);
    }

    /**
     * Get pendings movements
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPendings(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.CauseMovement.getPendings.start');
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
                'camv_status' => \FreeAsso\Model\CauseMovement::STATUS_WAIT
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
        $this->logger->debug('FreeAsso.CauseMovement.getPendings.end');
        return $this->createResponse(200, $data);
    }
}
