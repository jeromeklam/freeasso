<?php
namespace FreeFW\Interfaces;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

/**
 * Standard API Adapter interface
 *
 * @author jeromeklam
 */
interface ApiAdapterInterface
{

    /**
     * Decode the request
     *
     * @param ServerRequestInterface $p_request
     *
     * @return ServerRequestInterface
     */
    public function decodeRequest(ServerRequestInterface $p_request) : \FreeFW\Http\ApiParams;

    /**
     * Encode the response
     *
     * @param ResponseInterface $p_response
     *
     * @return ResponseInterface
     */
    public function encodeResponse(ResponseInterface $p_response, \FreeFW\Http\ApiParams $p_api_params) : ResponseInterface;
}
