<?php
namespace FreeAsso\Controller;

/**
 * Api controller
 *
 * @author jeromeklam
 */
class Api extends \FreeFW\Core\ApiController
{

    /**
     * Mie à jour de la description
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param number $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function siret(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Sirene.siret.start');
        $params = $p_request->getQueryParams();
        $config  = $this->getAppConfig();
        $api_cfg = $config->get('api:insee');
        $api     = \FreeAPI\INSEE\Sirene\Siret::getInstance($api_cfg);
        $result  = $api->find($params); //['nom' => '*zoo*', 'ville' => 'amneville']);
        $this->logger->debug('FreeAsso.Sirene.siret.end');
        if ($result) {
            return $this->createSuccessOkResponse(json_encode($result));
        }
        return $this->createErrorResponse(404);
    }
}
