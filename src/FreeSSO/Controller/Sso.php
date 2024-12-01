<?php
/**
 * Classe de controle de la partie SSO
 *
 * @author jeromeklam
 * @package SSO\Controller
 */
namespace FreeSSO\Controller;

use \FreeFW\Constants as FFCST;
use \FreeSSO\Server as SsoServer;
use \FreeSSO\ErrorCodes as SsoErrors;

/**
 * Classe controlleur SSO
 * @author jeromeklam
 */
class Sso extends \FreeFW\Core\Controller
{

    /**
     * Change current group
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param int                                      $p_grp_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function switchGroup(\Psr\Http\Message\ServerRequestInterface $p_request, $p_grp_id)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.login.start');
        /**
         * @var \FreeSSO\Server $sso
         */
        $sso  = \FreeFW\DI\Di::getShared('sso');
        $user = $sso->getUser();
        if ($user) {
            $userBroker = \FreeSSO\Model\UserBroker::findFirst(
                [
                    'user_id' => $user->getUserId(),
                    'brk_id'  => $sso->getBrokerId()
                ]
            );
            if ($userBroker) {
                $userGroup = \FreeSSO\Model\GroupUser::findFirst(
                    [
                        'user_id' => $user->getUserId(),
                        'grp_id'  => $p_grp_id
                    ]
                );
                if ($userGroup) {
                    $userBroker->setGrpId($p_grp_id);
                    if ($userBroker->save()) {
                        $this->logger->debug('FreeSSO.Controller.Sso.login.end');
                        return $this->createSuccessOkResponse($user);
                    }
                }
            }
        }
        $this->logger->debug('FreeSSO.Controller.Sso.login.end');
        return $this->createErrorResponse(FFCST::ERROR_GROUP_SWITCH);
    }

    /**
     * Check and touch session
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function check(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.login.start');
        $sso  = \FreeFW\DI\Di::getShared('sso');
        $user = $sso->getUser();
        if ($user) {
            $this->logger->debug('FreeSSO.Controller.Sso.login.end');
            return $this->createSuccessOkResponse($user);
        } else {
            $this->logger->debug('FreeSSO.Controller.Sso.login.end');
            return $this->createErrorResponse(FFCST::ERROR_NOT_AUTHENTICATED);
        }
    }

    /**
     * Save
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function save(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.save.start');
        $this->logger->debug('FreeSSO.Controller.Sso.save.end');
        $sso  = \FreeFW\DI\Di::getShared('sso');
        /**
         *
         * @var \FreeSSO\Model\User $user
         */
        $user = $sso->getUser();
        if ($user) {
            $apiParams = $p_request->getAttribute('api_params', false);
            $data      = null;
            if ($apiParams->hasData()) {
                /**
                 * @var \POSSO\Model\User $data
                 */
                $data = $apiParams->getData();
                $user->merge($data);
                if ($user->save()) {
                    return $this->createSuccessOkResponse($user);
                }
                return $this->createErrorResponse(FFCST::ERROR_NOT_UPDATE, $user);
            }
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        } else {
            return $this->createErrorResponse(FFCST::ERROR_NOT_AUTHENTICATED);
        }
    }

    /**
     * Update config
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateConfig(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.save.start');
        $this->logger->debug('FreeSSO.Controller.Sso.save.end');
        $sso  = \FreeFW\DI\Di::getShared('sso');
        /**
         *
         * @var \FreeSSO\Model\User $user
         */
        $user = $sso->getUser();
        if ($user) {
            $apiParams = $p_request->getAttribute('api_params', false);
            $data      = null;
            if ($apiParams->hasData()) {
                /**
                 * @var \FreeSSO\Model\ConfigRequest $data
                 */
                $data = $apiParams->getData();
                // I only update some fields...
                $config = $user->getConfig();
                if (strtoupper($data->getConfigType()) === 'SETTINGS') {
                    $config->setUbrkConfig($data->getConfig());
                } else {
                    if (strtoupper($data->getConfigType()) === 'CACHE') {
                        $config->setUbrkCache($data->getConfig());
                    }
                }
                if ($config->save()) {
                    return $this->createSuccessOkResponse($user);
                }
                return $this->createErrorResponse(FFCST::ERROR_NOT_UPDATE, $config);
            }
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        } else {
            return $this->createErrorResponse(FFCST::ERROR_NOT_AUTHENTICATED);
        }
    }

    /**
     * signIn
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function signIn(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.signIn.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        $data      = null;
        //
        if ($apiParams->hasData()) {
            /**
             * @var \FreeSSO\Model\LoginRequest $data
             */
            $data = $apiParams->getData();
            if ($data->getLogin() != '') {
                if ($data->getPassword() == '') {
                    $data->addError(
                        SsoErrors::ERROR_PASSWORD_EMPTY,
                        sprintf('Password required !'),
                        \FreeFW\Core\Error::TYPE_PRECONDITION,
                        'password'
                    );
                    $this->logger->debug('FreeSSO.Controller.Sso.login.end');
                    return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
                }
                /**
                 * @var \FreeSSO\Server $sso
                 */
                try {
                    $sso      = \FreeFW\DI\Di::getShared('sso');
                    $user     = $sso->signinByLoginAndPassword(
                        $data->getLogin(),
                        $data->getPassword(),
                        $data->getRemember()
                    );
                    $response = $this->createSuccessAddResponse($user);
                    if ($data->getRemember()) {
                        $cookie = $sso-> getAutoLogin();
                        if ($cookie instanceof \FreeSSO\Model\AutologinCookie) {
                            $response = $response->withHeader('AutoLogin', $cookie->getAutoCookie());
                        }
                    }
                    $this->logger->debug('FreeSSO.Controller.Sso.signIn.end');
                    return $response;
                } catch (\Exception $ex) {
                    // @todo
                    $error = \FreeSSO\Model\Error::getFromException(409, $ex);
                    $this->logger->debug('FreeSSO.Controller.Sso.signIn.end');
                    return $this->createErrorResponse(FFCST::ERROR_NOT_INSERT, $error);
                }
            } else {
                $data->addError(
                    SsoErrors::ERROR_LOGIN_EMPTY,
                    sprintf('Login required !'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION,
                    'login'
                );
                $this->logger->debug('FreeSSO.Controller.Sso.signIn.end');
                return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
            }
        } else {
            $this->logger->debug('FreeSSO.Controller.Sso.signIn.end');
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        }
    }

    /**
     * AskPassword
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function askPassword(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.askPassword.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        $data      = null;
        if ($apiParams->hasData()) {
            /**
             * @var \FreeSSO\Model\LoginRequest $data
             */
            $data = $apiParams->getData();
            if ($data->getLogin() != '') {
                /**
                 * @var \FreeSSO\Server $sso
                 */
                try {
                    $sso   = \FreeFW\DI\Di::getShared('sso');
                    $user  = $sso->getUserByLogin($data->getLogin());
                    if ($user) {
                        $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
                        $langId       = intval($user->getLangId());
                        if ($langId <= 0) {
                            $langId = $this->getAppConfig()->get('default:lang_id');
                        }
                        /**
                         *
                         * @var \FreeFW\Mail\Email $email
                         */
                        $email = $emailService->getEmail('ASK_PASSWORD', $langId);
                        if ($email) {
                            $token = $sso->getUserPasswordToken($data->getLogin());
                            $datas = [
                                'broker' => $sso->getConfiguration(),
                                'login'  => $user->getUserLogin(),
                                'token'  => $token['token']
                            ];
                            if ($token) {
                                $group = $sso->getBrokerGroup();
                                $datas['header'] = $group->getGrpEmailHeader();
                                $datas['footer'] = $group->getGrpEmailFooter();
                                $datas['sign'] = $group->getGrpSign();
                                $datas = \FreeFW\Tools\PBXArray::reduceKeys($datas);
                                $email->mergeDatas($datas);
                                /**
                                 * @var \FreeFW\Model\Message $message
                                 */
                                $message = \FreeFW\DI\DI::get('FreeFW::Model::Message');
                                $message
                                    ->setMsgType(\FreeFW\Model\Message::TYPE_EMAIL)
                                    ->setMsgStatus(\FreeFW\Model\Message::STATUS_WAITING)
                                    ->setLangId($langId)
                                    ->setMsgObjectName('FreeSSO_User')
                                    ->setMsgObjectId($user->getUserId())
                                    ->setMsgSubject($email->getSubject())
                                    ->setMsgBody($email->getHtmlBody())
                                    ->addDest($user->getUserLogin())
                                    ->setFrom($email->getFromEmail(), $email->getFromName())
                                    ->setReplyTo($email->getReplyToEmail(), $email->getReplyToName())
                                ;
                                if ($message->create()) {
                                    $message->send();
                                }
                                //
                                $this->logger->debug('FreeSSO.Controller.Sso.askPassword.end');
                                return $this->createSuccessAddResponse('');
                            }
                        }
                    }
                    $this->logger->debug('FreeSSO.Controller.Sso.askPassword.end');
                    return $this->createErrorResponse(FFCST::ERROR_IN_DATA);
                } catch (\Exception $ex) {
                    // @todo
                    $error = \FreeSSO\Model\Error::getFromException(409, $ex);
                    $this->logger->debug('FreeSSO.Controller.Sso.askPassword.end');
                    return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $error);
                }
            } else {
                $data->addError(
                    SsoErrors::ERROR_LOGIN_EMPTY,
                    sprintf('Login required !'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION,
                    'login'
                );
                $this->logger->debug('FreeSSO.Controller.Sso.askPassword.end');
                return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
            }
        } else {
            $this->logger->debug('FreeSSO.Controller.Sso.askPassword.end');
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        }
    }

    /**
     * changePassword
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function changePassword(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.changePassword.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        $data      = null;
        if ($apiParams->hasData()) {
            /**
             * @var \FreeSSO\Model\ChangePassword $data
             */
            $data = $apiParams->getData();
            if ($data->getPassword() != '') {
                $token = $data->getToken();
                /**
                 * @var \FreeSSO\Server $sso
                 */
                try {
                    $sso   = \FreeFW\DI\Di::getShared('sso');
                    if ($token != '') {
                        $user = $sso->getUserFromPasswordToken($token);
                        if ($user) {
                            $sso->changeUserPasswordFromToken($token, $data->getPassword());
                            $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
                            return $this->createSuccessEmptyResponse();
                        } else {
                            $data->addError(
                                SsoErrors::ERROR_TOKEN_NOT_FOUND,
                                sprintf('Token not found or invalid !'),
                                \FreeFW\Core\Error::TYPE_PRECONDITION,
                                'token'
                            );
                            $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
                            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
                        }
                    } else {
                        $user = $sso->getUser();
                        if ($user) {
                            if ($sso->changeUserPassword($user, $data->getPassword2(), $data->getPassword())) {
                                $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
                                return $this->createSuccessEmptyResponse();
                            }
                        }
                    }
                    $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
                    return $this->createErrorResponse(FFCST::ERROR_IN_DATA);
                } catch (\Exception $ex) {
                    // @todo
                    $error = \FreeSSO\Model\Error::getFromException(409, $ex);
                    $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
                    return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $error);
                }
            } else {
                $data->addError(
                    SsoErrors::ERROR_PASSWORD_EMPTY,
                    sprintf('Password is mandatory !'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION,
                    'password'
                );
                $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
                return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
            }
        } else {
            $this->logger->debug('FreeSSO.Controller.Sso.changePassword.end');
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        }
    }

    /**
     * signOut
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function signOut(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.logout.start');
        /**
         * @var \FreeSSO\Server $sso
         */
        try {
            $sso  = \FreeFW\DI\Di::getShared('sso');
            $user = $sso->logout();
            $this->logger->debug('FreeSSO.Controller.Sso.logout.end');
            return $this->createSuccessEmptyResponse();
        } catch (\Exception $ex) {
            // @todo
            $error = \FreeFW\Model\Error::getFromException(409, $ex);
            $this->logger->debug('FreeSSO.Controller.Sso.logout.end');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $error);
        }
    }

    /**
     * Retourne les collègues de l'utilisateur
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function colleagues(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.colleagues.start');
        /**
         * @var \FreeSSO\Server $sso
         */
        try {
            $sso   = \FreeFW\DI\Di::getShared('sso');
            $users = \FreeSSO\Model\User::find();
            $this->logger->debug('FreeSSO.Controller.Sso.colleagues.end');
            return $this->createSuccessOkResponse($users);
        } catch (\Exception $ex) {
            // @todo
            $error = \FreeFW\Model\Error::getFromException(409, $ex);
            $this->logger->debug('FreeSSO.Controller.Sso.colleagues.end');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $error);
        }
    }

    /**
     * Création d'un compte utilisateur avec demande de validation
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function register(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        $data = null;
        if (!$apiParams->hasData()) {
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        }
        /**
         * @var \POSSO\Model\UserCreateAccount $data
         */
        $data = $apiParams->getData();
        if (empty($data->getLogin())) {
            $data->addError(
                SsoErrors::ERROR_LOGIN_EMPTY,
                sprintf('Login required !'),
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                'user_login'
            );
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }
        if (empty($data->getPassword())) {
            $data->addError(
                SsoErrors::ERROR_PASSWORD_EMPTY,
                sprintf('Password required !'),
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                'user_password'
            );
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }
        if ($data->getType() === \FreeSSO\Model\User::TYPE_USER && !\FreeFW\Tools\Email::verifyFormatting($data->getLogin())) {
            $data->addError(
                SsoErrors::ERROR_BAD_LOGIN,
                sprintf('Bad login !'),
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                'user_login'
            );
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }
        $user = \FreeSSO\Model\User::findFirst(
            [
                'user_login' => $data->getLogin()
            ]
        );
        if ($user instanceof \FreeSSO\Model\User) {
            if (!empty($user->getUserValString())) {
                $data->addError(
                    SsoErrors::ERROR_USER_NOTACTIVATED,
                    sprintf('Le compte n\'a pas été activé !'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION
                );
            } else {
                $data->addError(
                    SsoErrors::ERROR_LOGIN_EXISTS,
                    sprintf('L\'utilisateur avec le login %s existe !', $data->getLogin()),
                    \FreeFW\Core\Error::TYPE_PRECONDITION,
                    'user_login'
                );
            }
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }
        /**
         * @var \POSSO\Server $sso
         * @var \POSSO\Model\User $user
         */
        try {
            /**
             * @var \FreeSSO\Server $sso
             */
            $sso = \FreeFW\DI\DI::getShared('sso');
            $user = $sso->registerNewUser(
                $data->getLogin(),
                $data->getEmail(),
                $data->getPassword(),
                [],
                true,
                $data->getType(),
                $data->getLang()
            );
            if ($user === false || $user->hasErrors()) {
                if ($user->hasErrors()) {
                    $data->addErrors($user->getErrors());
                }
                $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
                return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
            } else {
                $user->forwardRawEvent(\FreeSSO\Constants::EVENT_USER_VALIDATION, $user);
                $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.end');
                return $this->createSuccessAddResponse($sso->getUserById($user->getUserId()));
            }
        } catch (\FreeSSO\SsoException $ex) {
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            return $this->createErrorResponse(409, \FreeSSO\Model\Error::getFromException(409, $ex)); // 409. Le second 409 correspond à errors.status
        } catch (\Exception $ex) {
            $this->logger->debug('FreeSSO.Controller.Sso.createUserAccount.error');
            throw new \Exception($ex->getMessage(), $ex->getCode()); // 500
        }
    }

    /**
     * Envoyer un mail de validation de création d'un compte utilisateur
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendUserValidationEmail(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        $data = null;
        if (!$apiParams->hasData()) {
            $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
            return $this->createErrorResponse(FFCST::ERROR_NO_DATA);
        }
        /**
         * @var \POSSO\Model\UserValidationEmail $data
         */
        $data = $apiParams->getData();
        if (empty($data->getLogin())) {
            $data->addError(
                SsoErrors::ERROR_LOGIN_EMPTY,
                sprintf('Login required !'),
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                'user_login'
            );
            $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }
        if (!\FreeFW\Tools\Email::verifyFormatting($data->getLogin())) {
            $data->addError(
                SsoErrors::ERROR_BAD_LOGIN,
                sprintf('Bad login !'),
                \FreeFW\Core\Error::TYPE_PRECONDITION,
                'user_login'
            );
            $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }
        $user = \FreeSSO\Model\User::findFirst(
            [
                'user_login' => $data->getLogin()
            ]
        );
        /**
         * @var \POSSO\Server $sso
         * @var \POSSO\Model\User $user
         */
        if ($user instanceof \FreeSSO\Model\User) {
            if (empty($user->getUserValString())) {
                $data->addError(
                    SsoErrors::ERROR_BAD_LOGIN, // oui oui, on renvoie un bad login !
                    sprintf('Bad login !'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION
                );
                $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
                return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
            }
        } else {
            $data->addError(
                SsoErrors::ERROR_BAD_LOGIN,
                sprintf('Bad login !'),
                \FreeFW\Core\Error::TYPE_PRECONDITION
            );
            $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA, $data);
        }

        try {
            /**
             * @var \FreeSSO\Server $sso
             */
            $sso = \FreeFW\DI\DI::getShared('sso');
            if ($sso->sendValidationEmail($user)) {
                $user->forwardRawEvent(\FreeSSO\Constants::EVENT_USER_VALIDATION, $user);
                $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.end');
                return $this->createSuccessAddResponse($user);
            }
        } catch (\FreeSSO\SsoException $ex) {
            $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
            return $this->createErrorResponse(409, \FreeSSO\Model\Error::getFromException(409, $ex)); // 409. Le second 409 correspond à errors.status
        } catch (\Exception $ex) {
            $this->logger->debug('FreeSSO.Controller.Sso.sendUserValidationEmail.error');
            throw new \Exception($ex->getMessage(), $ex->getCode()); // 500
        }
    }

}
