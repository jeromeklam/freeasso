<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Cause extends \FreeFW\Core\ApiController
{

    /**
     * Get all active sponsors
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param mixed                                    $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCurrentSponsors(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        /**
         * @var \FreeAsso\Service\Cause $causeService
         */
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $this->logger->debug('FreeFW.CauseController.getCurrentSponsors.start');
        $data = $causeService->getSponsors($p_id);
        $this->logger->debug('FreeFW.CauseController.getCurrentSponsors.end');
        return $this->createResponse(200, $data);
    }
}
