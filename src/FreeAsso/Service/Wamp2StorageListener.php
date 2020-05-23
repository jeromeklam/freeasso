<?php
namespace FreeAsso\Service;

use \Ratchet\ConnectionInterface;
use \FreeWS\Wamp2\WampServerInterface;
use \FreeWS\Wamp2\Topic;
use \Psr\Log\LoggerAwareInterface;
use \Psr\Log\LoggerAwareTrait;

/**
 *
 * @author jeromeklam
 *
 */
class Wamp2StorageListener implements WampServerInterface, LoggerAwareInterface
{

    /**
     * Behaviour
     */
    use LoggerAwareTrait;

    /**
     *
     * @var array
     */
    protected $subscribedTopics = array();

    /**
     *
     * @param ConnectionInterface $conn
     * @param Topic               $topic
     *
     * @return boolean
     */
    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->logger->info('FreeAsso.Wamp2.onSubscribe');
        $this->subscribedTopics[$topic->getUri()] = $topic;
        return true;
    }

    /**
     *
     * @param ConnectionInterface $conn
     * @param Topic               $topic
     *
     * @return boolean
     */
    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->logger->info('FreeAsso.Wamp2.onUnSubscribe');
        if (array_key_exists($topic->getUri(), $this->subscribedTopics)) {
            unset($this->subscribedTopics[$topic->getUri()]);
        }
        return true;
    }

    /**
     *
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->logger->info('FreeAsso.Wamp2.onOpen');
    }

    /**
     *
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        $this->logger->info('FreeAsso.Wamp2.onClose');
    }

    /**
     *
     * @param ConnectionInterface $conn
     * @param mixed               $id
     * @param Topic               $topic
     * @param array               $params
     */
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $this->logger->info('FreeAsso.Wamp2.onCall');
    }

    /**
     *
     * @param ConnectionInterface $conn
     * @param Topic               $topic
     * @param mixed               $event
     * @param array               $exclude
     * @param array               $eligible
     */
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $this->logger->info('FreeAsso.Wamp2.onPublish');
    }

    /**
     *
     * @param ConnectionInterface $conn
     * @param \Exception          $ex
     */
    public function onError(ConnectionInterface $conn, \Exception $ex)
    {
        $this->logger->info('FreeAsso.Wamp2.onError');
    }

    /**
     *
     * @param string $entry
     */
    public function onEvent($entry)
    {
        $this->logger->info('FreeAsso.Wamp2.onEvent');
        $this->logger->debug(print_r($entry, true));
        $uri = 'fr.freeasso.storage';
        if (array_key_exists($uri, $this->subscribedTopics)) {
            try {
                $object = unserialize($entry);
                $topic  = $this->subscribedTopics[$uri];
                $json   = json_encode($object);
                $topic->broadcast($json);
            } catch (\Exception $ex) {
                $this->logger->critical($ex->getMessage);
            }
        } else {
            $this->logger->info('FreeAsso.Wamp2.onEvent topic not attached');
        }
    }
}
