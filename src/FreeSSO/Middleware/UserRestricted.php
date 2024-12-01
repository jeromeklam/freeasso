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
class UserRestricted implements
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
            $userId    = 0;
            $ssoServer = \FreeFW\DI\DI::getShared('sso');
            if ($ssoServer) {
                $user = $ssoServer->getUser();
                if ($user) {
                    $userId = $user->getUserId();
                }
            }
            /**
             *
             * @var \FreeFW\Http\ApiParams $apiParams
             */
            $apiParams = $p_request->getAttribute('api_params', false);
            if ($apiParams) {
                $conditions = $apiParams->getFilters();
                if (!$conditions) {
                    $conditions = new \FreeFW\Model\Conditions();
                }
                $aField = new \FreeFW\Model\ConditionMember();
                $aField->setValue('user_id');
                $aValue = new \FreeFW\Model\ConditionValue();
                $aValue->setValue($userId);
                $aCondition = new \FreeFW\Model\SimpleCondition();
                $aCondition->setLeftMember($aField);
                $aCondition->setRightMember($aValue);
                $aCondition->setOperator(\FreeFW\Storage\Storage::COND_EQUAL);
                $conditions->add($aCondition);
                $apiParams->setFilters($conditions);
            }
            $newRequest = $p_request->withAttribute('api_params', $apiParams);
            $response = $p_handler->handle($newRequest);
            // response must be converted to correct type
            return $response;
        } catch (\Exception $ex) {
            $this->logger->critical($ex->getMessage());
            return $this->createResponse(500);
        }
    }
}
