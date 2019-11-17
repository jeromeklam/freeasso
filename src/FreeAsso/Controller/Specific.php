<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Specific extends \FreeFW\Core\ApiController
{

    /**
     * Specific 404 response
     * 
     * @return \FreeFW\Http\ApiServerResponse
     */
    public function specific404(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        return new \FreeFW\Http\ApiServerResponse(404);
    }
}
