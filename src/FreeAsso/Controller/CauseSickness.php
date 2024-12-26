<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class CauseSickness extends \FreeFW\Core\ApiController
{
    
    /**
     * Get pendings sickness
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPendings(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.CauseSickness.getPendings.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        $today   = \FreeFW\Tools\Date::getCurrentTimestamp();
        $default = $p_request->getAttribute('default_model');
        $model   = \FreeFW\DI\DI::get($default);
        $filters = new \FreeFW\Model\Conditions();
        $filters->initFromArray(
            [
                'caus_to' => $today
            ],
            \FreeFW\Storage\Storage::COND_AND,
            \FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL
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
        $this->logger->debug('FreeAsso.CauseSickness.getPendings.end');
        return $this->createResponse(200, $data);
    }
}
