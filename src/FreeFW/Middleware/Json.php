<?php
namespace FreeFW\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use function GuzzleHttp\json_encode;

/**
 * JsonApi Middleware
 *
 * @author jeromeklam
 */
class Json implements
    \FreeFW\Interfaces\ApiAdapterInterface,
    \Psr\Log\LoggerAwareInterface
{

    /**
     * comportements
     */
    use \Psr\Log\LoggerAwareTrait;
    use \FreeFW\Behaviour\EventManagerAwareTrait;
    use \FreeFW\Behaviour\ConfigAwareTrait;
    use \FreeFW\Behaviour\HttpFactoryTrait;

    /**
     * Allowed types
     * @var array
     */
    protected $contentTypes = ['application/json'];

    /**
     * convertion de données en modèle
     * 
     * @param mixed $p_json
     * 
     * @return \FreeFW\Core\Model
     */
    protected function dataToModel($p_json)
    {
        $model = null;
        $data  = null;
        if ($p_json) {
            $typeMember = '@type';
            if (isset($p_json->{$typeMember})) {
                $type = $p_json->{$typeMember};
                if (class_exists($type)) {
                    $class = str_replace('\\', '::', trim($type, '\\'));
                    /**
                     * @var \FreeFW\Core\Model $model
                     */
                    $model = \FreeFW\DI\DI::get($class);
                    $parts = (array)$p_json;
                    foreach ($parts as $key => $value) {
                        $model->$key = $value;
                    }
                }
            }
        }
        return $model;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\ApiAdapterInterface::decodeRequest()
     */
    public function decodeRequest(ServerRequestInterface $p_request): \FreeFW\Http\ApiParams
    {
        $this->logger->debug(sprintf('FreeFW.Middleware.Json.decode.start'));
        $apiParams = new \FreeFW\Http\ApiParams();
        $params = $p_request->getQueryParams();
        /**
         * Handle specific parameters
         */
        // Fields
        if (array_key_exists('fields', $params)) {
            $apiParams->setFields($params['fields']);
        }
        // Include
        if (array_key_exists('include', $params)) {
            $apiParams->setInclude($params['include']);
        }
        // Option
        if (array_key_exists('option', $params)) {
            $options = $params['option'];
            $apiParams->setOption($options);
            if (is_array($options) && isset($options['lang'])) {
                \FreeFW\DI\DI::setShared('lang', $options['lang']);
            }
            if (is_array($options) && isset($options['money'])) {
                \FreeFW\DI\DI::setShared('money', $options['money']);
            }
        }
        // Filters
        if (array_key_exists('filter', $params)) {
            $filters = $params['filter'];
            // Transform filters to \FreeFW\Model\Conditions...
            $conditions = new \FreeFW\Model\Conditions();
            $conditions->initFromArray($filters);
            $apiParams->setFilters($conditions);
        }
        // Sort
        if (array_key_exists('sort', $params)) {
            $apiParams->setSort($params['sort']);
        }
        // Page
        if (array_key_exists('page', $params)) {
            $page = $params['page'];
            if (is_array($page)) {
                $start = 0;
                $len   = 25;
                if (array_key_exists('number', $page) || array_key_exists('size', $page)) {
                    $number = 1;
                    $size   = 25;
                    if (array_key_exists('number', $page)) {
                        $number = intval($page['number']);
                    }
                    if (array_key_exists('size', $page)) {
                        $size = intval($page['size']);
                    }
                    $start = ($number - 1) * $size;
                    $len   = $size;
                }
                if (array_key_exists('offset', $page) || array_key_exists('limit', $page)) {
                    $offset = 1;
                    $limit  = 25;
                    if (array_key_exists('offset', $page)) {
                        $offset = intval($page['offset']);
                    }
                    if (array_key_exists('limit', $page)) {
                        $limit = intval($page['limit']);
                    }
                    $start = $offset - 1;
                    $len   = $limit - $offset;
                }
            } else {
                throw new \FreeFW\JsonApi\FreeFWJsonApiException(
                    sprintf('Incorrect values for page parameter !')
                );
            }
            $apiParams
                ->setStart($start)
                ->setLength($len)
            ;
        }
        // Datas
        $contents = $p_request->getBody()->getContents();
        $json     = json_decode($contents, false);
        $datas    = $this->dataToModel($json);
        if ($datas) {
            $apiParams->setData($datas);
        }
        // Next
        $this->logger->debug(sprintf('FreeFW.Middleware.Json.decode.end'));
        return $apiParams;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\ApiAdapterInterface::encodeResponse()
     */
    public function encodeResponse(ResponseInterface $p_response, \FreeFW\Http\ApiParams $p_api_params): ResponseInterface
    {
        $this->logger->debug(sprintf('FreeFW.Middleware.Json.encode.start'));
        $body       = $p_response->getBody();
        if (is_object($body)) {
            if ($body instanceof StreamInterface) {
                $content = $body->getContents();
                $object  = @unserialize($content);
                if ($object !== false) {
                    $serializer = new \Zumba\JsonSerializer\JsonSerializer();
                    if (is_object($object) && method_exists($object, '__toArrayFiltered')) {
                        $result = new \stdClass();
                        $result->data = $object->__toArrayFiltered(
                            $p_api_params->getFields(),
                            $p_api_params->getInclude()
                        );
                        if (method_exists($object, 'getTotalCount')) {
                            $result->total_count = $object->getTotalCount();
                        }
                        $result = $serializer->serialize($result);
                    } else {
                        if (is_object($object) && method_exists($object, 'unset')) {
                            $result = $serializer->serialize($object->unset());
                        } else {
                            $result = $serializer->serialize($object);
                        }
                    }
                } else {
                    $result = $content;
                }
                $p_response = $p_response->withBody(
                    \GuzzleHttp\Psr7\Utils::streamFor($result)
                );
            }
        }
        $this->logger->debug(sprintf('FreeFW.Middleware.Json.encode.end'));
        return $p_response->withHeader('Content-Type', 'application/json');
    }
}
