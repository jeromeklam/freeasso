<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class CauseMovement extends \FreeFW\Core\ApiController
{

    /**
     * Status
     * @var string
     */
    const STATUS_WAIT = 'WAIT';
    const STATUS_OK   = 'OK';
    const STATUS_KO   = 'KO';

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
                $myMovement->setCamvStatus(self::STATUS_OK);
                $myMovement->save();
                $mySite = \FreeAsso\Model\Site::findFirst(['site_id' => $myMovement->getCamvSiteToId()]);
                if ($mySite) {
                    $myCause->setSite($mySite);
                    $myCause->setSiteId($myMovement->getCamvSiteToId());
                    if ($myCause->save()) {
                        $data = $this->getModelById($apiParams, $myMovement, $myMovement->getApiId());
                        return $this->createResponse(200, $data);
                    }
                }
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
        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        $default = $p_request->default_model;
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
