<?php
namespace FreeSSO\Middleware;

use \Psr\Http\Server\MiddlewareInterface;
use \Psr\Http\Server\RequestHandlerInterface;
use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

/**
 *
 * @author jerome.klam
 *
 */
class Broker implements
    MiddlewareInterface,
    \Psr\Log\LoggerAwareInterface,
    \FreeFW\Interfaces\ConfigAwareTraitInterface
{

    /**
     * comportements
     */
    use \Psr\Log\LoggerAwareTrait;
    use \FreeFW\Behaviour\EventManagerAwareTrait;
    use \FreeFW\Behaviour\ConfigAwareTrait;
    use \FreeFW\Behaviour\HttpFactoryTrait;

    /**
     * before Middleware
     *
     * @param ServerRequestInterface $p_request
     */
    protected function beforeProcess(ServerRequestInterface $p_request)
    {
        $ssoServer = \FreeFW\DI\DI::getShared('sso');
        if ($ssoServer === null || $ssoServer === false) {
            $ssoConfig = $this->getAppConfig()->get('sso');
            $ssoServer = \FreeSSO\Server::getInstance($p_request, $ssoConfig);
            \FreeFW\DI\DI::setShared('sso', $ssoServer);
        }
        return $ssoServer;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface  $p_request
     * @param RequestHandlerInterface $p_handler
     *
     * @return ResponseInterface
     */
    public function process(
        ServerRequestInterface $p_request,
        RequestHandlerInterface $p_handler
    ): ResponseInterface {
        try {
            $sso = $this->beforeProcess($p_request);
            if ($sso !== false) {
                $p_request = $p_request->withAttribute('broker', $sso->getIdentifier());
                $p_request = $p_request->withAttribute('broker_auth_methods', $sso->getAuthMethods());
                $p_request = $p_request->withAttribute('broker_config', $sso->getConfiguration());
                // Injected for DI
                \FreeFw\DI\DI::setShared('broker', $sso->getBrokerId());
                $response = $p_handler->handle($p_request);
                // Add to header
                $response = $response->withHeader(\FreeSSO\Constants::HEADER_APP, $sso->getAppId());
                $response = $response->withHeader(\FreeSSO\Constants::HEADER_CDSSO, $sso->getSsoId());
                // Add as cookies
                $cookies = new \FreeFW\Http\Cookies();
                $cookies->add(
                    \FreeSSO\Constants::COOKIE_CDSSO,
                    $sso->getSsoId(),
                    null,
                    '/',
                    false,
                    $sso->getDomain()
                );
                $cookies->add(
                    \FreeSSO\Constants::COOKIE_APP,
                    $sso->getAppId(),
                    null,
                    '/',
                    false,
                    $sso->getDomain()
                );
                $response = $cookies->addToResponse($response);
            } else {
                $this->logger->debug('broker.401');
                $response = $this->createResponse(401);
            }
            // response must be converted to correct type
            return $response;
        } catch (\Exception $ex) {
            $this->logger->critical($ex->getMessage());
            return $this->createResponse(500);
        }
    }
}
