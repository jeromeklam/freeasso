<?php
namespace FreeSSO;

use \Psr\Http\Message\ServerRequestInterface;
use \FreeSSO\Model\Broker;
use \FreeSSO\Model\BrokerSession;
use \FreeSSO\Model\User as User;
use \FreeSSO\Model\PasswordToken;
use \FreeSSO\Model\Session as SSOSession;
use \FreeSSO\Http\Remote;

/**
 * Serveur de gestion des accès SSO
 *
 * @author jeromeklam
 * @package SSO\Server
 */
class Server implements
    \FreeFW\Interfaces\SSOInterface,
    \Psr\Log\LoggerAwareInterface
{

    /**
     * comportements
     */
    use \Psr\Log\LoggerAwareTrait;
    use \FreeFW\Behaviour\EventManagerAwareTrait;

    /**
     * Instance of server
     * @var Server
     */
    protected static $instance = null;

    /**
     * Domain instance
     * @var \FreeSSO\Model\Domain
     */
    protected $domain = null;

    /**
     * Broker instance
     * @var \FreeSSO\Model\Broker
     */
    protected $broker = null;

    /**
     * Session
     * @var \FreeSSO\Model\Session
     */
    protected $session = null;

    /**
     * User
     * @var User
     */
    protected $user = null;

    /**
     * Request
     * @var \Psr\Http\Message\ServerRequestInterface;
     */
    protected $request = null;

    /**
     * SsoId
     * @var string
     */
    protected $sso_id = null;

    /**
     * AppId
     * @var string
     */
    protected $app_id = null;

    /**
     * AutoLogin cookie
     * @var \FreeSSO\Model\AutologinCookie
     */
    protected $autologin = null;

    /**
     * Is it a new SSO_ID ?
     * @var boolean
     */
    protected $new_session = false;

    /**
     * User group
     * @var \FreeSSO\Model\Group
     */
    protected $user_group = null;

    /**
     * User scope
     * @var string
     */
    protected $scope = null;

    /**
     * Permissions (json)
     * @var string
     */
    protected $permissions = null;

    /**
     * Constructor
     *
     * @param array   $p_options
     */
    protected function __construct(ServerRequestInterface $p_request, array $p_options = array())
    {
        // Peut être un appel rest, ... en-tête Api-Id ??
        $this->request = $p_request;
        if ($this->request->hasHeader('Api-Key')) {
            $key = $this->request->getHeader('Api-Key');
            if (is_array($key)) {
                $key = $key[0];
            }
            $this->setBroker($key);
        } else {
            if ($this->request->hasHeader('Api-Id')) {
                $key = $this->request->getHeader('Api-Id');
                if (is_array($key)) {
                    $key = $key[0];
                }
                $this->setBroker($key);
            } else {
                if (!array_key_exists(\FreeSSO\Constants::BROKER_KEY, $p_options)) {
                    throw new \InvalidArgumentException(
                        'Erreur de configuration : La clef "client" est obligatoire !',
                        \FreeSSO\ErrorCodes::ERROR_OPTIONS_BROKER_REQUIRED
                    );
                } else {
                    $this->setBroker($p_options[\FreeSSO\Constants::BROKER_KEY]);
                }
            }
        }
    }

    /**
     * Get cookies
     *
     * @return string[]
     */
    public function getCookies()
    {
        return array(
            'ssoId' => $this->sso_cookie,
            'appId' => $this->app_cookie
        );
    }

    /**
     * Get SSOServer instance
     *
     * @param array $p_options
     *
     * @return \FreeSSO\Server
     */
    public static function getInstance(
        ServerRequestInterface $p_request = null,
        array $p_options = array()
    ) {
        if (self::$instance === null) {
            if (is_array($p_options) && count($p_options) > 0) {
                self::$instance = new self($p_request, $p_options);
            } else {
                throw new \InvalidArgumentException('Erreur de configuration : aucune option !');
            }
        }
        return self::$instance;
    }

    /**
     * Set broker
     *
     * @param string $p_brokerKey
     *
     * @throws \Exception
     */
    public function setBroker($p_brokerKey)
    {
        $myBroker = false;
        if (substr_count($p_brokerKey, '@') == 1) {
            $parts    = explode('@', $p_brokerKey);
            $myBroker = \FreeSSO\Model\Broker::findFirst(
                [
                    'brk_key'         => $parts[1],
                    'brk_certificate' => $parts[0]
                ]
            );
        } else {
            $myBroker = \FreeSSO\Model\Broker::findFirst(
                [
                    'brk_key'         => $p_brokerKey,
                    'brk_certificate' => [\FreeFW\Storage\Storage::COND_EQUAL_OR_NULL => '']
                ]
            );
        }
        if ($myBroker instanceof \FreeSSO\Model\Broker) {
            $this->broker = $myBroker;
            $domain = \FreeSSO\Model\Domain::findFirst(
                [
                    'dom_id' => $this->broker->getDomId()
                ]
            );
            $this->domain = $domain;
            if (!$this->domain instanceof \FreeSSO\Model\Domain) {
                throw new \FreeSSO\SsoException(
                    sprintf(
                        'Could not find %s domain !',
                        $this->broker->getDomId()
                    )
                );
            }
            if (!$this->broker->isActive()) {
                throw new \FreeSSO\SsoException(sprintf('Broker is not activated !'));
            }
            /**
             * Init the cookies, ....
             */
            $cliIp        = \FreeFW\Http\ServerRequest::getClientIp($this->request);
            $this->sso_id = Remote::getSsoId($this->request);
            $this->app_id = Remote::getAppId($this->request);
            /**
             * Try to get a broker session....
             */
            $this->verifyBrokerSession(
                $this->broker->getBrkKey(),
                $this->sso_id,
                $this->app_id,
                $cliIp,
                $this->domain->getDomSessionMinutes()
            );
        } else {
            throw new \FreeSSO\SsoException(sprintf('Broker %s not found !', $p_brokerKey));
        }
    }

    /**
     * Signin
     *
     * @param string $p_token
     *
     * @throws \FreeSSO\SsoException
     *
     * @return boolean
     */
    public function signinByUserToken($p_token)
    {
        try {
            $this->fireEvent('sso:beforeSigninByUserToken');
        } catch (\Exception $ex) {
        }
        $this->user = false;
        if ($p_token === null || $p_token == '') {
            throw new SsoException('Le token est obligatoire !', ErrorCodes::ERROR_LOGIN_EMPTY);
        }
        $userToken = \FreeSSO\Model\UserToken::findFirst([
            'utok_token' => $p_token
        ]);
        if ($userToken) {
            $user = User::findFirst([
                'user_id' => $userToken->getUserId()
            ]);
            if ($user instanceof User) {
                if (!$user->isActive()) {
                    throw new SsoException(
                        sprintf('L\'utilisateur n\'est plus actif !'),
                        ErrorCodes::ERROR_USER_DEACTIVATED
                    );
                }
                if (!$this->verifyUserGroup($user->getUserId())) {
                    throw new SsoException(
                        sprintf('L\'utilisateur n\'a pas de groupe courant !'),
                        ErrorCodes::ERROR_USER_GROUP
                    );
                }
                // Ok, save to session...
                if ($this->session instanceof SSOSession) {
                    $this->session->setUserId($user->getUserId());
                    $this->session->setSessContent($user->serialize());
                    $this->session->save();
                    $this->user = $user;
                } else {
                    throw new SsoException('Erreur : impossible de trouver la session !', ErrorCodes::ERROR_GENERAL);
                }
                if ($this->user->getUserLastUpdate() === null) {
                    try {
                        $this->fireEvent('sso:lastUserUpdateEmpty', $this, $this->user);
                    } catch (\Exception $ex) {
                        $this->user = false;
                    }
                }
            } else {
                throw new SsoException(
                    sprintf('Le token %s n\'existe pas !', $p_token),
                    ErrorCodes::ERROR_LOGIN_NOTFOUND
                );
            }
        } else {
            throw new SsoException(sprintf('Le token %s n\'existe pas !', $p_token), ErrorCodes::ERROR_LOGIN_NOTFOUND);
        }
        try {
            $this->fireEvent('sso:afterSigninByUserToken', $user);
        } catch (\Exception $ex) {
        }
        return $this->user;
    }

    /**
     * Signin
     *
     * @param string $p_cookie
     *
     * @throws \FreeSSO\SsoException
     *
     * @return boolean
     */
    public function signinByAutoLogin($p_cookie)
    {
        try {
            $this->fireEvent('sso:beforeSigninByAutoLogin');
        } catch (\Exception $ex) {
        }
        $this->user = false;
        if ($p_cookie === null || $p_cookie == '') {
            throw new SsoException('Le cookie est obligatoire !', ErrorCodes::ERROR_LOGIN_EMPTY);
        }
        $cookie = \FreeSSO\Model\AutologinCookie::findFirst([
            'auto_cookie' => $p_cookie
        ]);
        if ($cookie) {
            $user = User::findFirst([
                'user_id'    => $cookie->getUserId()
            ]);
            if ($user instanceof User) {
                if (!$user->isActive()) {
                    throw new SsoException(
                        sprintf('L\'utilisateur n\'est plus actif !'),
                        ErrorCodes::ERROR_USER_DEACTIVATED
                    );
                }
                if (!$this->verifyUserGroup($user->getUserId())) {
                    throw new SsoException(
                        sprintf('L\'utilisateur n\'a pas de groupe courant !'),
                        ErrorCodes::ERROR_USER_GROUP
                    );
                }
                // Ok, save to session...
                if ($this->session instanceof SSOSession) {
                    $this->session->setUserId($user->getUserId());
                    $this->session->setSessContent($user->serialize());
                    $this->session->save();
                    $this->user = $user;
                } else {
                    throw new SsoException('Erreur : impossible de trouver la session !', ErrorCodes::ERROR_GENERAL);
                }
                if ($this->user->getUserLastUpdate() === null) {
                    try {
                        $this->fireEvent('sso:lastUserUpdateEmpty', $this, $this->user);
                    } catch (\Exception $ex) {
                        $this->user = false;
                    }
                }
            } else {
                throw new SsoException(
                    sprintf('Le login %s n\'existe pas !', $p_cookie),
                    ErrorCodes::ERROR_LOGIN_NOTFOUND
                );
            }
        } else {
            throw new SsoException(
                sprintf('Le cookie %s n\'existe pas !', $p_cookie),
                ErrorCodes::ERROR_LOGIN_NOTFOUND
            );
        }
        try {
            $this->fireEvent('sso:afterSigninByAutoLogin', $user);
        } catch (\Exception $ex) {
        }
        return $this->user;
    }

    /**
     * Signin
     *
     * @param string  $p_login
     * @param string  $p_password
     * @param boolean $p_remember
     *
     * @throws \FreeSSO\SsoException
     *
     * @return boolean
     */
    public function signinByIdAndLogin($p_id, $p_login, $p_check_session = true)
    {
        // First, if new session, it is not possible... Server has revoked token...
        if ($p_check_session && $this->new_session) {
            $this->user = false;
            return $this->user;
        }
        try {
            $this->fireEvent('sso:beforeSigninByIdAndLogin');
        } catch (\Exception $ex) {
        }
        $this->user = false;
        if ($p_login === null || $p_login == '') {
            throw new SsoException('Le login est obligatoire !', ErrorCodes::ERROR_LOGIN_EMPTY);
        }
        $user = User::findFirst([
            'user_id'    => $p_id,
            'user_login' => $p_login
        ]);
        if ($user instanceof User) {
            if (!$user->isActive()) {
                throw new SsoException(
                    sprintf('L\'utilisateur n\'est plus actif !'),
                    ErrorCodes::ERROR_USER_DEACTIVATED
                );
            }
            if (!$this->verifyUserGroup($user->getUserId())) {
                throw new SsoException(
                    sprintf('L\'utilisateur n\'a pas de groupe courant !'),
                    ErrorCodes::ERROR_USER_GROUP
                );
            }
            // Ok, save to session...
            if ($this->session instanceof SSOSession) {
                if ($this->session->getUserId() != $user->getUserId()) {
                    $this->session->setUserId($user->getUserId());
                    $this->session->setSessContent($user->serialize());
                    $this->session->save();
                }
                $this->user = $user;
            } else {
                throw new SsoException('Erreur : impossible de trouver la session !', ErrorCodes::ERROR_GENERAL);
            }
            if ($this->user->getUserLastUpdate() === null) {
                try {
                    $this->fireEvent('sso:lastUserUpdateEmpty', $this, $this->user);
                } catch (\Exception $ex) {
                    $this->user = false;
                }
            }
        } else {
            throw new SsoException(sprintf('Le login %s n\'existe pas !', $p_login), ErrorCodes::ERROR_LOGIN_NOTFOUND);
        }
        try {
            $this->fireEvent('sso:afterSigninByIdAndLogin', $user);
        } catch (\Exception $ex) {
        }
        return $this->user;
    }

    /**
     * Signin
     *
     * @param string  $p_login
     * @param string  $p_password
     * @param boolean $p_remember
     *
     * @throws \FreeSSO\SsoException
     *
     * @return boolean
     */
    public function signinByLoginAndPassword($p_login, $p_password, $p_remember = false)
    {
        try {
            $this->fireEvent('sso:beforeSigninByLoginAndPassword');
        } catch (\Exception $ex) {
        }
        $this->user = false;
        if ($p_login === null || $p_login == '') {
            throw new SsoException('Le login est obligatoire !', ErrorCodes::ERROR_LOGIN_EMPTY);
        }
        $user = User::findFirst(
            [
                'user_login' => $p_login
            ]
        );
        if ($user instanceof User) {
            if (!$user->verifyPassword($p_password)) {
                throw new SsoException(sprintf('Le mot de passe est incorrect !'), ErrorCodes::ERROR_PASSWORD_WRONG);
            }
            if (!$user->isActive()) {
                if ($user->getUserValLogin() != '') {
                    throw new SsoException(
                        sprintf('Le compte n\'a pas été activé !'),
                        ErrorCodes::ERROR_USER_NOTACTIVATED
                    );
                } else {
                    throw new SsoException(
                        sprintf('Le compte n\'est plus actif !'),
                        ErrorCodes::ERROR_USER_DEACTIVATED
                    );
                }
            }
            if (!$this->verifyUserGroup($user->getUserId())) {
                throw new SsoException(
                    sprintf('L\'utilisateur n\'a pas de groupe courant !'),
                    ErrorCodes::ERROR_USER_GROUP
                );
            }
            // Ok, save to session...
            if ($this->session instanceof SSOSession) {
                $this->session->setUserId($user->getUserId());
                $this->session->setSessContent($user->serialize());
                $this->session->save();
                if ($p_remember) {
                    // @todo : set autologin cookie
                    $this->autologin = new \FreeSSO\Model\AutologinCookie();
                    $this->autologin
                        ->setUserId($user->getUserId())
                        ->setAutoTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ->setAutoExpire(\FreeFW\Tools\Date::getCurrentTimestamp(60*24*265))
                    ;
                    $this->autologin->create();
                    \FreeSSO\Model\AutologinCookie::delete(
                        [
                            'auto_expire' => [
                                \FreeFW\Storage\Storage::COND_LOWER => \FreeFW\Tools\Date::getCurrentTimestamp()
                            ]
                        ]
                    );
                }
                $this->user = $user;
            } else {
                throw new SsoException('Erreur : impossible de trouver la session !', ErrorCodes::ERROR_GENERAL);
            }
            if ($this->user->getUserLastUpdate() === null) {
                try {
                    $this->fireEvent('sso:lastUserUpdateEmpty', $this, $this->user);
                } catch (\Exception $ex) {
                    $this->user = false;
                }
            }
        } else {
            throw new SsoException(sprintf('Le login %s n\'existe pas !', $p_login), ErrorCodes::ERROR_LOGIN_NOTFOUND);
        }
        try {
            $this->fireEvent('sso:afterSigninByLoginAndPassword', $this->user);
        } catch (\Exception $ex) {
            // @todo
        }
        return $this->user;
    }

    /**
     * Logout current user
     *
     * @throws \FreeSSO\SsoException
     */
    public function logout()
    {
        $user = $this->user;
        if ($this->session instanceof SSOSession) {
            $this->session
                ->setUserId(null)
                ->setSessContent(null)
            ;
            $this->session->save();
        } else {
            throw new SsoException('Erreur : impossible de trouver la session !', ErrorCodes::ERROR_GENERAL);
        }
        $this->fireEvent('sso:afterUserLogout', $user);
    }

    /**
     * Get current loggedin user
     *
     * @throws SsoException
     *
     * @param boolean $p_light
     *
     * @return \FreeSSO\Model\User
     */
    public function getUser($p_light = false)
    {
        if ($this->new_session) {
            $this->user = null;
        }
        if ($this->user === null) {
            $this->user = false;
            if ($this->session instanceof SSOSession) {
                if ($this->session->getUserId() !== null) {
                    $this->user = User::findFirst(array(
                        'user_id' => $this->session->getUserId()
                    ));
                    if ($this->user instanceof User) {
                        if ($this->user->getUserLastUpdate() === null) {
                            try {
                                $this->fireEvent('sso:lastUserUpdateEmpty', $this->user);
                            } catch (\Exception $ex) {
                                $this->user = false;
                            }
                        }
                    } else {
                        $this->user = false;
                    }
                }
            } else {
                throw new SsoException('Erreur : impossible de trouver la session !', ErrorCodes::ERROR_GENERAL);
            }
        }
        return $this->user;
    }

    /**
     * Get Broker
     *
     * @return \FreeSSO\Model\Broker
     */
    protected function getBroker()
    {
        return $this->broker;
    }

    /**
     * Update session
     *
     * @param string $p_sess_id
     */
    protected function touchSession($p_sess_id)
    {
        SSOSession::update(
            [
                'sess_touch' => \FreeFW\Tools\Date::getCurrentTimestamp(),
                'sess_end'   => \FreeFW\Tools\Date::getCurrentTimestamp(60*24)
            ],
            [
                'sess_id' => $p_sess_id
            ]
        );
        SSOSession::delete(
            array(
                'sess_end' => [
                    \FreeFW\Storage\Storage::COND_LOWER => \FreeFW\Tools\Date::getCurrentTimestamp()
                ]
            )
        );
    }

    /**
     * Verify broker session, create one if necessary
     *
     * @param string $p_key
     * @param string $p_ssoId
     * @param string $p_appId
     * @param string $p_ip
     * @param string $p_lifetime
     */
    protected function verifyBrokerSession($p_key, $p_ssoId, $p_appId, $p_ip, $p_lifetime = 0)
    {
        $addNewBrokerSession = true;
        if ($p_lifetime <= 0) {
            $p_lifetime = \FreeSSO\Constants::BROKER_SESSION_LIFETIME;
        }
        // Read if application session exists
        $myBrokerSession = \FreeSSO\Model\BrokerSession::findFirst(
            [
                'brs_token' => $p_appId,
                'brk_key'   => $this->broker->getBrkKey()
            ]
        );
        if ($myBrokerSession instanceof \FreeSSO\Model\BrokerSession) {
            $addNewBrokerSession = false;
            // Must be for the same IP
            if ($myBrokerSession->getBrsClientAddress() != $p_ip) {
                $myBrokerSession->remove();
                $addNewBrokerSession = true;
            } else {
                // Must be the same SSO id
                if ($myBrokerSession->getBrsSessionId() != $p_ssoId) {
                    $myBrokerSession->remove();
                    $addNewBrokerSession = true;
                } else {
                    // Expired, delete ?
                    if (strtotime($myBrokerSession->getBrsEnd()) < time()) {
                        $myBrokerSession->remove();
                        $addNewBrokerSession = true;
                    } else {
                        $myBrokerSession->setBrsEnd(
                            \FreeFW\Tools\Date::getCurrentTimestamp($p_lifetime)
                        );
                        $myBrokerSession->save();
                        // Need to touch the session too...
                        $this->touchSession($myBrokerSession->getSessId());
                        $this->session = SSOSession::findFirst(array(
                            'sess_id' => $myBrokerSession->getSessId()
                        ));
                    }
                }
            }
        }
        if ($addNewBrokerSession) {
            // First, change sso et app id
            $this->sso_id = Remote::getRandomCookieValue();
            $this->app_id = Remote::getRandomCookieValue();
            $p_ssoId = $this->getSsoId();
            $p_appId = $this->getAppId();
            // Set to true to prevent reuse of JWT... with no session...
            $this->new_session = true;
            // First, is there a session for the same SSO id ?
            $myBrokerSession = \FreeSSO\Model\BrokerSession::findFirst(
                [
                    'brs_session_id' => $p_ssoId
                ]
            );
            $this->session = false;
            if ($myBrokerSession instanceof \FreeSSO\Model\BrokerSession) {
                if ($myBrokerSession->getBrsClientAddress() == $p_ip) {
                    // We share the same session
                    $this->session = \FreeSSO\Model\Session::findFirst(
                        [
                            'sess_id' => $myBrokerSession->getSessId()
                        ]
                    );
                    $this->new_session = false;
                }
            } else {
                $myBrokerSession = \FreeSSO\Model\BrokerSession::getNew();
            }
            $lifetime = \FreeFW\Tools\Date::getCurrentTimestamp($p_lifetime);
            if (!$this->session instanceof \FreeSSO\Model\Session) {
                $this->session = \FreeSSO\Model\Session::getNew();
                $this->session
                    ->setSessStart(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setSessClientAddr($p_ip)
                    ->setSessEnd($lifetime)
                    ->setUserId(null)
                ;
                // @todo : expiration is on domain
                if ($this->session->create() === false) {
                    throw new \FreeSSO\SSoException('Can\'t create session !');
                }
            }
            $myBrokerSession
                ->initModel()
                ->setBrkKey($p_key)
                ->setBrsToken($p_appId)
                ->setBrsSessionId($p_ssoId)
                ->setBrsClientAddress($p_ip)
                ->setSessId($this->session->getSessId())
                ->setBrsEnd($lifetime)
            ;
            if ($myBrokerSession->create() === false) {
                throw new \FreeSSO\SSoException('Can\'t create brokersession !');
            }
        }
        $query = BrokerSession::getQuery(\FreeFW\Model\Query::QUERY_DELETE);
        $query->addFromFilters(
            [
                'brs_end' => [\FreeFW\Storage\Storage::COND_LOWER => \FreeFW\Tools\Date::getCurrentTimestamp()]
            ]
        );
        $query->execute();
        $query = SSOSession::getQuery(\FreeFW\Model\Query::QUERY_DELETE);
        $query->addFromFilters(
            [
                'sess_end' => [\FreeFW\Storage\Storage::COND_LOWER => \FreeFW\Tools\Date::getCurrentTimestamp()]
            ]
        );
        $query->execute();
    }

    /**
     * Return identifier
     *
     * @return string | boolean
     */
    public function getIdentifier()
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            return $this->broker->getBrkKey();
        }
        return false;
    }

    /**
     * Return auth methods
     *
     * @return array
     */
    public function getAuthMethods()
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            return explode(',', $this->broker->getBrkAuth());
        }
        return [];
    }

    /**
     * Return broker id
     *
     * @return number
     */
    public function getBrokerId()
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            return $this->broker->getBrkId();
        }
        return false;
    }

    /**
     * Return broker group
     *
     * @return \FreeSSO\Model\Group
     */
    public function getBrokerGroup()
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            return $this->broker->getGroup();
        }
        return false;
    }

    /**
     * Return configuration
     *
     * @return array | boolean
     */
    public function getConfiguration()
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            $cfg = $this->broker->getBrkConfig();
            return json_decode($cfg, true);
        }
        return false;
    }

    /**
     * Update broker configuration
     *
     * @param array $p_config
     *
     * @return mixed|boolean
     */
    public function updateConfiguration($p_config)
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            $cfg = json_encode($p_config);
            $this->broker->setBrkConfig($cfg);
            return $this->broker->save();
        }
        return false;
    }

    /**
     * Return private key
     *
     * @return string | boolean
     */
    public function getPrivateKey()
    {
        if ($this->broker instanceof \FreeSSO\Model\Broker) {
            return $this->broker->getBrkCertificate();
        }
        return false;
    }

    /**
     * Get password token and email
     *
     * @param string $p_login
     *
     * @throws SsoException
     */
    public function getUserPasswordToken($p_login)
    {
        $user = User::findFirst(
            [
                'user_login' => $p_login
            ]
        );
        if ($user instanceof User) {
            // First delete olders
            $olders = PasswordToken::find(
                [
                    'user_id'   =>  $user->getUserId(),
                    'ptok_used' => 0
                ]
            );
            foreach ($olders as $oneToken) {
                if (!$oneToken->remove()) {
                    return false;
                }
            }
            // New one
            $data          = [];
            $token         = md5(uniqid(microtime(true)));
            $data['email'] = $user->getUserEmail();
            $data['token'] = $token;
            $pToken        = \FreeFW\DI\DI::get('FreeSSO::Model::PasswordToken');
            $pToken
                ->setPtokToken($token)
                ->setPtokEmail($user->getUserEmail())
                ->setUserId($user->getUserId())
                ->setPtokRequestIp('')
                ->setPtokUsed(0)
                ->setPtokEnd(\FreeFW\Tools\Date::getCurrentTimestamp(60))
            ;
            if ($pToken->create()) {
                return $data;
            }
        } else {
            throw new SsoException(
                sprintf('Le login %s n\'existe pas !', $p_login),
                ErrorCodes::ERROR_LOGIN_NOTFOUND
            );
        }
        return false;
    }

    /**
     * Verify password token and return user
     *
     * @param string $p_token
     *
     * @return false | User
     */
    public function getUserFromPasswordToken($p_token)
    {
        $token = PasswordToken::findFirst(
            [
                'ptok_token' => [\FreeFW\Storage\Storage::COND_EQUAL => $p_token],
                'ptok_used'  => [\FreeFW\Storage\Storage::COND_EQUAL => 0],
                'ptok_end'   => [\FreeFW\Storage\Storage::COND_GREATER => \FreeFW\Tools\Date::getCurrentTimestamp()]
            ]
        );
        if ($token instanceof PasswordToken) {
            $user = User::findFirst(
                [
                    'user_id' => $token->getUserId()
                ]
            );
            if ($user instanceof User) {
                return $user;
            }
        }
        return false;
    }

    /**
     * Retourne un utilisateur selon son identifiant
     *
     * @param string $p_id
     *
     * @return \FreeSSO\Model\User|false
     */
    public function getUserById($p_id)
    {
        $user = User::findFirst([
            'user_id' => $p_id
        ]);
        if ($user instanceof User) {
            if ($user->getUserLastUpdate() === null) {
                try {
                    $this->fireEvent('sso:lastUserUpdateEmpty', $this, $user);
                } catch (\Exception $ex) {
                    $user = false;
                }
            }
            return $user;
        }
        return false;
    }

    /**
     * Retourne un utilisateur selon son login
     *
     * @param string $p_login
     *
     * @return \FreeSSO\Model\User|boolean
     */
    public function getUserByLogin($p_login)
    {
        $user = User::findFirst(
            [
                'user_login' => $p_login
            ]
        );
        if ($user instanceof User) {
            if ($user->getUserLastUpdate() === null) {
                try {
                    $this->fireEvent('sso:lastUserUpdateEmpty', $this, $user);
                } catch (\Exception $ex) {
                    $user = false;
                }
            }
        }
        return $user;
    }

    /**
     * Change user password with its password token
     *
     * @param string $p_token
     * @param string $p_password
     *
     * @throws SsoException
     */
    public function changeUserPasswordFromToken($p_token, $p_password)
    {
        if (false !== ($user = $this->getUserFromPasswordToken($p_token))) {
            $user->setUserPassword(md5($user->getUserSalt() . $p_password));
            $user->save();
            $token = PasswordToken::findFirst(
                [
                    'ptok_token' => $p_token
                ]
            );
            if ($token instanceof PasswordToken) {
                $token->setPtokUsed(1);
                return $token->save();
            }
        }
        throw new SsoException(sprintf('Le token %s n\'existe pas !', $p_token), ErrorCodes::ERROR_TOKEN_NOTFOUND);
    }

    /**
     * Change user password
     *
     * @param User   $p_user
     * @param string $p_old
     * @param string $p_password
     *
     * @throws SsoException
     */
    public function changeUserPassword($p_user, $p_old, $p_password)
    {
        $oldCalc = md5($p_user->getUserSalt() . $p_old);
        if (strcmp($p_user->getUserPassword(), $oldCalc) == 0) {
            $p_user->setUserPassword(md5($p_user->getUserSalt() . $p_password));
            $p_user->save();
            return true;
        } else {
            throw new SsoException('Mot de passe incorrect !', ErrorCodes::ERROR_OLD_PASSWORD_WRONG);
        }
        throw new SsoException('Mot de passe incorrect !', ErrorCodes::ERROR_PASSWORD_WRONG);
    }

    /**
     * Register new user
     *
     * @param string  $p_login
     * @param string  $p_email
     * @param string  $p_password
     * @param array   $p_datas
     * @param boolean $p_withValidation
     *
     * @throws \FreeSSO\SsoException
     *
     * @return \FreeSSO\Model\User|boolean
     */
    public function registerNewUser(
        $p_login,
        $p_email,
        $p_password,
        array $p_datas = [],
        $p_withValidation = false,
        $p_type = \FreeSSO\Model\User::TYPE_USER,
        $p_lang = null
    ) {
        try {
            $this->fireEvent('sso:beforeRegisterNewUser');
        } catch (\Exception $ex) {
        }
        //On s'assure que l'utilisateur n'existe pas
        $allUsers = User::find();
        foreach ($allUsers as $item) {
            if ($item->getUserLogin() === $p_login) {
                throw new SsoException(
                    sprintf('L\'utilisateur avec le login %s n\'existe pas !', $p_login),
                    ErrorCodes::ERROR_LOGIN_EXISTS
                );
            }
        }
        $user = new User();
        $user
            ->setUserLogin($p_login)
            ->setUserEmail($p_email)
            ->createNewPassword($p_password)
            ->setUserActive(1)
        ;
        if (!in_array($p_type, [\FreeSSO\Model\User::TYPE_USER, \FreeSSO\Model\User::TYPE_REST])) {
            $p_type = \FreeSSO\Model\User::TYPE_USER;
        }
        if ($p_lang != '') {
            $lang = \FreeFW\Model\Lang::findFirst(['lang_code' => strtolower($p_lang)]);
            if ($lang) {
                $user->setlangId($lang->getlangId());
            }
        }
        $user->getUserType($p_type);
        if ($p_withValidation) {
            $user
                ->setUserActive(0)
                ->setUserValLogin($p_login)
                ->setUserValString(md5(uniqid($p_login)))
                ->setUserValEnd(\FreeFW\Tools\Date::getCurrentTimestamp(60*24*2))
            ;
        }
        if ($user->create()) {
            try {
                $this->fireEvent('sso:afterRegisterNewUser', $user);
            } catch (\Exception $ex) {
                // @todo
            }
            return $user;
        }
        return false;
    }

    /**
     * Mise à jour d'un utillsateur
     *
     * @param string $p_user
     * @param array  $p_datas
     */
    public function updateUser($p_user, $p_datas = array())
    {
        try {
            //On modifie dabord le password
            //effet de bord, verifie que les mots de passes tapé soit correct
            //sinon exception
            $bool = $this->changeUserPassword($p_user, $p_datas['oldPWD'], $p_datas['PWD']);
            if (strcmp($p_datas['PWD'], $p_datas['PWD2']) !== 0) {
                throw new SsoException(
                    sprintf('Erreur : les mots de passe sont differents !'),
                    ErrorCodes::ERROR_PASSWORD_WRONG
                );
            }
        } catch (\Exception $ex) {
            throw new SsoException(sprintf('Erreur de mot de passes!'), ErrorCodes::ERROR_PASSWORD_WRONG);
        }
        if ($bool) {
            $p_user = $this->updateUserFields($p_user, $p_datas);
            if ($p_user->save()) {
                try {
                    $this->fireEvent('sso:afterUpdateUser', $p_user);
                } catch (\Exception $ex) {
                    //var_dump($ex);
                    //die;
                    // @todo
                }
                return $p_user;
            }
        }
        return false;
    }

    /**
     * Send a validation email
     *
     * @param \FreeSSO\Model\User $p_user
     *
     * @return boolean
     */
    public function sendValidationEmail($p_user)
    {
        $p_user
            ->setUserValString(md5(uniqid('valid')))
            ->setUserValEnd(\FreeFW\Tools\Date::getCurrentTimestamp(60*24*2))
        ;
        if ($p_user->save()) {
            // Send email
            return true;
        }
        return false;
    }

    /**
     * Validate account
     *
     * @param string $p_token
     *
     * @throws SsoException
     *
     * @return \FreeSSO\Model\User|boolean
     */
    public function validateAccount($p_token)
    {
        $user = User::getFirst(
            array(
                'user_val_string' => $p_token
            )
        );
        if ($user) {
            // @todo : $user->getUserValEnd();
            $user
                ->setUserActive(1)
                ->setUserValString(null)
                ->setUserValEnd(null)
            ;
            if (!$user->save()) {
                throw new SsoException('Impossible de valider le compte !', ErrorCodes::ERROR_MODIFICATION);
            }
        } else {
            throw new SsoException(
                sprintf('Token de validation %s non trouvé !', $p_token),
                ErrorCodes::ERROR_TOKEN_NOT_FOUND
            );
        }
        return $user;
    }

    /**
     * Sets users avatar
     *
     * @param string $p_userId
     * @param string $p_avatar
     *
     * @throws SsoException
     *
     * @return \FreeSSO\Model\User|boolean
     */
    public function setUserAvatar($p_userId, $p_avatar)
    {
        $user = User::getFirst(
            array(
                'user_id' => $p_userId
            )
        );
        if (!$user instanceof User) {
            throw new SsoException(
                sprintf('l\'utilisateur avec le mot de passe %s n\'existe pas !', $p_login),
                ErrorCodes::ERROR_LOGIN_EXISTS
            );
        }
        $user->setUserAvatar($p_avatar);
        if ($user->save()) {
            return $user;
        }
        return false;
    }

    /**
     * Vérification de la route
     *
     * @param \FreeFW\Router\Route $p_route
     *
     * @return boolean
     */
    public function verifyAccess(\FreeFW\Router\Route $p_route)
    {
        if ($p_route->getSecure() == \FreeFW\Router\Route::SECURE_PUBLIC) {
            return true;
        } else {
            try {
                $user = $this->getUser();
            } catch (\Exception $ex) {
                $user = false;
            }
            if ($user !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verify that the required scope is present in the broker's config
     *
     * @param string $p_scope
     *
     * @return boolean
     */
    public function verifyApiScope($p_scope)
    {
        $broker = $this->getBroker();
        if ($broker instanceof Broker) {
            return $broker->verifyApiScope($p_scope);
        }
        return false;
    }

    /**
     * Update user fields
     *
     * @param User  $p_user
     * @param array $p_datas
     *
     * @return User
     */
    protected function updateUserFields($p_user, $p_datas = array())
    {
        foreach ($p_datas as $key => $value) {
            switch (strtolower($key)) {
                case 'title':
                    $p_user->setUserTitle($value);
                    break;
                case 'firstname':
                    $p_user->setUserFirstName($value);
                    break;
                case 'lastname':
                    $p_user->setUserLastName($value);
                    break;
                default:
                    $p_user->putInCache($key, $value);
                    break;
            }
        }
        return $p_user;
    }

    /**
     * Get domain name
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain->getDomName();
    }

    /**
     * Get SsoId
     *
     * @return string
     */
    public function getSsoId()
    {
        return $this->sso_id;
    }

    /**
     * Get AppId
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * Get autoLogin
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    public function getAutoLogin()
    {
        return $this->autologin;
    }

    /**
     * Verify user has current correct group
     *
     * @param int $p_user_id
     *
     * @return boolean
     */
    protected function verifyUserGroup($p_user_id)
    {
        $this->user_group  = null;
        $this->scope       = null;
        $this->permissions = null;
        $userBroker = \FreeSSO\Model\UserBroker::findFirst(
            [
                'user_id' => $p_user_id,
                'brk_id'  => $this->getBrokerId()
            ]
        );
        if ($userBroker) {
            $grp_id = $userBroker->getGrpId();
            if ($grp_id) {
                $conditions = new \FreeFW\Model\Conditions();
                $conditions->initFromArray(
                    [
                        //'group.grp_realm_id' => $this->getBrokerId(),
                        'user_id'            => $p_user_id,
                        'grp_id'             => $grp_id
                    ]
                );
                $query  = \FreeSSO\Model\GroupUser::getQuery();
                $rels   = [];
                $rels[] = 'group';
                $query
                    ->addConditions($conditions)
                    ->addRelations($rels)
                ;
                if ($query->execute()) {
                    foreach ($query->getResult() as $line) {
                        $this->scope       = $line->getGruScope();
                        $this->permissions = json_decode($line->getGruPermissions());
                        $this->user_group  = \FreeSSO\Model\Group::findFirst(['grp_id' => $grp_id]);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get user group
     *
     * @return \FreeSSO\Model\Group
     */
    public function getUserGroup()
    {
        return $this->user_group;
    }

    /**
     * Get permissions
     *
     * @return string
     */
    public function getPermissions() : string
    {
        if (!$this->permissions) {
            return '';
        }
        return $this->permissions;
    }

    /**
     * Force user
     *
     * @param [type] $p_user
     * @param [type] $p_group
     * 
     * @return void
     */
    public function forceUser($p_user, $p_group) 
    {
        $this->user = $p_user;
        $this->group = $p_group;
        return $this;
    }
}
