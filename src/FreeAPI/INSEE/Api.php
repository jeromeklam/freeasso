<?php
namespace FreeAPI\INSEE;

/**
 * API
 */
class Api
{

    /**
     * url_api
     * @var string
     */
    protected $url_api = "https://api.insee.fr/entreprises/sirene/V3";

    /**
     * url_jwt
     * @var string
     */
    protected $url_jwt = "https://api.insee.fr/token";

    /**
     * Instance
     * @var \FreeAPI\INSEE\Api
     */
    protected static $instance = null;

    /**
     * Config
     * @var array
     */
    protected $config = null;

    /**
     * Constructor
     * 
     * @param array $p_config
     */
    protected function __construct($p_config)
    {
        $this->config = $p_config;
        if (!is_array($this->config)) {
            throw new \InvalidArgumentException('API : config is not an array !');
        }
        if (!isset($this->config['key'])) {
            throw new \InvalidArgumentException('API : key config is missing !');
        }
        if (!isset($this->config['secret'])) {
            throw new \InvalidArgumentException('API : secret config is missing !');
        }
        if (!isset($this->config['path'])) {
            throw new \InvalidArgumentException('API : path config is missing !');
        }
        $path = $this->config['path'];
        if (!is_dir($path)) {
            throw new \InvalidArgumentException('API : path config is not a directory !');
        }
    }

    /**
     * Get instance
     * 
     * @param array $p_config
     * 
     * @return self
     */
    public function getInstance($p_config = null)
    {
        if (self::$instance === null) {
            self::$instance = new static($p_config);
        }
        return self::$instance;
    }

    /**
     * Get token
     * 
     * @return \FreeAPI\INSEE\Auth\Token
     */
    public function getToken()
    {
        $token = new \FreeAPI\INSEE\Auth\Token();
        $file  = rtrim($this->config['path'], '/') . '/insee_token_' . date('Y-m-d') . '.token';
        // maybe existing token ?
        if (is_file($file)) {
            $content = file_get_contents($file);
            $token->init($content);
        }
        // get new if not valid or no existing token
        if (!$token->isValid()) {
            $token = $this->getNewToken();
            file_put_contents($file, $token->__toString());
        }
        return $token;
    }

    /**
     * Get new token
     * 
     * @return \FreeAPI\INSEE\Auth\Token
     */
    protected function getNewToken()
    {
        $now = new \DateTime();
         // adds 674165 secs
        $token  = '';
        $obj    = new \FreeAPI\INSEE\Auth\Token();
        $result = ($this->apiCallToken());
        if ($result && isset($result['access_token']) && isset($result['expires_in'])) {
            $sec = $result['expires_in'];
            $now = new \DateTime();
            $now->add(new \DateInterval('PT' . $sec . 'S'));
            $obj->setToken($result['access_token']);
            $obj->setExpires($now);
        }
        return $obj;
    }

    /**
     * Get secret;
     * 
     * @return string
     */
    protected function getSecret()
    {
        return base64_encode($this->config['key'] . ':' . $this->config['secret']);
    }

    /**
     * Get validity
     * 
     * @return int
     */
    protected function getValidity()
    {
        $str = date('Y-m-d 23:59:00');
        return strtotime($str) - time();
    }

    /**
     * Token API CALL
     * 
     * @return array | false
     */
    protected function apiCallToken()
    {
        $ch  = curl_init();
        $val = $this->getValidity();
        curl_setopt($ch, CURLOPT_URL, $this->url_jwt);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&validity_period=' . $val);
        $headers = [
            'Authorization: Basic ' . $this->getSecret(),
            'Content-Type: application/x-www-form-urlencoded'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        }
        curl_close($ch);
        return json_decode($result, true);
    }

       /**
     * @return array|bool
     */
    public function apiCallInformations()
    {
        $token = $this->getToken();
        if ($token->isValid()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url_api . '/informations');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = [
                'Accept: application/json',
                'Authorization: ' . $token->getAuthorizationHeader()
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return false;
            }
            curl_close($ch);
            return json_decode($result, true);
        } else {
            return false;
        }
    }

    /**
     * Encode param
     * 
     * @param string $p_param
     * 
     * @return string
     */
    protected function encodeParam($p_param)
    {
        $val   = strtoupper(\FreeAPI\Tools::withoutAccent($p_param));
        $first = false;
        $last  = false;
        if ($val[0] == '*') {
            $first = true;
        }
        if ($val[strlen($val)-1] == '*') {
            $last = true;
        }
        $wild = true;
        $val  = str_replace('*', '', $val);
        if (strpos($val, ' ') !== false) {
            $val  = '%22' . $val . '%22';
            $wild = false;
        }
        $val = str_replace(' ', '%20', $val);
        //$val = urlencode($val);
        if ($wild && $first) {
            $val = '*' . $val;
        }
        if ($wild && $last) {
            $val = $val . '*';
        }
        return $val;
    }
}
