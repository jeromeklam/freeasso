<?php
namespace FreeFW\Http;

/**
 * Uses
 */
use \FreeFW\Constants AS FFCST;

/**
 * FreeFW Router
 *
 * @author jeromeklam
 */
class Router
{

    /**
     * Behaviour
     */
    use \Psr\Log\LoggerAwareTrait;

    /**
     * routes
     * @var \FreeFW\Router\RouteCollection
     */
    protected $routes = null;

    /**
     * Router base path
     * @var string
     */
    protected $base_path = '';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routes = new \FreeFW\Router\RouteCollection();
    }

    /**
     * Set basepath
     *
     * @param string $p_basepath
     *
     * @return \FreeFW\Http\Router
     */
    public function setBasePath($p_basepath = '')
    {
        $this->base_path = $p_basepath;
        return $this;
    }

    /**
     * Delete all routes
     *
     * @return \FreeFW\Http\Router
     */
    public function flush()
    {
        $this->routes = null;
        return $this;
    }

    /**
     * Add routes
     *
     * @param \FreeFW\Router\RouteCollection $p_collection
     *
     * @return \FreeFW\Http\Router
     */
    public function addRoutes(\FreeFW\Router\RouteCollection $p_collection)
    {
        $this->routes->addRoutes($p_collection);
        return $this;
    }

    /**
     * Get all routes
     *
     * @return \FreeFW\Router\RouteCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Find specific route
     *
     * @param string $p_http_code
     *
     * @return boolean|array
     */
    public function findSpecificRoute($p_http_code)
    {
        $retRoute = false;
        if ($this->routes instanceof \FreeFW\Router\RouteCollection) {
            /**
             * @var \FreeFW\Router\Route $oneRoute
             */
            foreach ($this->routes->getRoutes() as $idx => $oneRoute) {
                if ($oneRoute->getFunction() == 'specific' . $p_http_code) {
                    $retRoute = $oneRoute;
                    break;
                }
            }
        }
        return $retRoute;
    }

    /**
     *
     * @param string $p_object
     * @param string $p_role
     *
     * @return \FreeFW\Router\Route || null
     */
    public function findRouteByModelAndRole($p_model, $p_role)
    {
        $route = null;
        if ($this->routes instanceof \FreeFW\Router\RouteCollection) {
            /**
             * @var \FreeFW\Router\Route $oneRoute
             */
            foreach ($this->routes->getRoutes() as $oneRoute) {
                if ($oneRoute->getDefaultModel() == $p_model && $p_role == $oneRoute->getRole()) {
                    $route = $oneRoute;
                    break;
                }
            }
        }
        return $route;
    }

    /**
     * Find called route
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \FreeFW\Router\Route | false
     */
    public function findRoute(\Psr\Http\Message\ServerRequestInterface &$p_request)
    {
        if ($this->routes instanceof \FreeFW\Router\RouteCollection) {
            $params     = $p_request->getServerParams();
            $currentDir = '/';
            $requestUrl = '';
            $requestUrl = $p_request->getUri()->getPath();
            if (($pos = strpos($requestUrl, '?')) !== false) {
                if (isset($_GET['_url'])) {
                    $requestUrl = $_GET['_url'];
                } else {
                    $requestUrl = substr($requestUrl, 0, $pos);
                }
            }
            $currentDir = rtrim($this->base_path, '/');
            $requestUrl = urldecode($requestUrl);
            if ($currentDir != '/') {
                if (strpos($requestUrl, $currentDir) === 0) {
                    $requestUrl = substr($requestUrl, strlen($currentDir));
                }
                //$requestUrl = str_replace($currentDir, '', $requestUrl);
            }
            //var_dump($requestUrl);
            $this->logger->info('router.findRoute.request : ' . $requestUrl);
            foreach ($this->routes->getRoutes() as $idx => $oneRoute) {
                //$this->logger->debug('router.findRoute.test : ' . $oneRoute->getUrl());
                //var_dump($oneRoute->getUrl());
                if (strtoupper($p_request->getMethod()) == strtoupper($oneRoute->getMethod())) {
                    $params = array();
                    if ($oneRoute->getUrl() == $requestUrl) {
                        // Ok, pas besoin de compliquer....
                    } else {
                        // @todo : ajouter la notion obligatoire pour les paramètres
                        if (!preg_match("#^" . $oneRoute->getRegex() . "$#", $requestUrl, $matches)) {
                            continue;
                        }
                        // Ok
                        // On a trouvé une route, on récupère les paramètres.
                        // On va en profiter pour les injecter dans la requête
                        $matchedText = array_shift($matches);
                        if (preg_match_all("/:(" . FFCST::PARAM_REGEX . ")/", $oneRoute->getUrl(), $argument_keys)) {
                            $argument_keys = $argument_keys[1];
                            if (count($argument_keys) != count($matches)) {
                                continue;
                            }
                            foreach ($argument_keys as $key => $name) {
                                if (isset($matches[$key]) && $matches[$key] !== null
                                    && $matches[$key] != '' && $matches[$key] != '/'
                                ) {
                                    $params[$name] = ltrim($matches[$key], '/'); // Pour les paramètres optionnel
                                } else {
                                    $params[$name] = '';
                                }
                            }
                        }
                        foreach ($params as $name => $value) {
                            $p_request = $p_request->withAttribute($name, $value);
                        }
                        $oneRoute->setParams($params);
                    }
                    $this->logger->debug('router.findRoute.match : ' . $oneRoute->getUrl());
                    return $oneRoute;
                }
            }
        }
        return false;
    }
}
