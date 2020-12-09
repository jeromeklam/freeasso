<?php
namespace FreeAsso\Service;

use \Ratchet\ConnectionInterface;
use \Ratchet\MessageComponentInterface;
use \Psr\Log\LoggerAwareInterface;
use \Psr\Log\LoggerAwareTrait;
use \FreeWS\Socket\Topic;
use \FreeFW\Interfaces\ConfigAwareTraitInterface;
use \FreeFW\Behaviour\ConfigAwareTrait;

/**
 *
 * @author jeromeklam
 *
 */
class SimpleStorageListener implements MessageComponentInterface, LoggerAwareInterface, ConfigAwareTraitInterface
{

    /**
     * WAMP2 messages types
     * @var integer
     */
    const MSG_HELLO        = "1";
    const MSG_WELCOME      = "2";
    const MSG_ABORT        = "3";
    const MSG_GOODBYE      = "6";
    const MSG_ERROR        = "8";
    const MSG_PUBLISH      = "16";
    const MSG_PUBLISHED    = "17";
    const MSG_SUBSCRIBE    = "32";
    const MSG_SUBSCRIBED   = "33";
    const MSG_UNSUBSCRIBE  = "34";
    const MSG_UNSUBSCRIBED = "35";
    const MSG_EVENT        = "36";
    const MSG_CALL         = "48";
    const MSG_RESULT       = "50";
    const MSG_REGISTER     = "64";
    const MSG_REGISTERED   = "65";
    const MSG_UNREGISTER   = "66";
    const MSG_UNREGISTERED = "67";
    const MSG_INVOCATION   = "68";
    const MSG_YIELD        = "70";

    /**
     * Behaviour
     */
    use LoggerAwareTrait;
    use ConfigAwareTrait;

    /**
     * @var array
     */
    protected static $topicLookup = array();

    /**
     *
     * @var array
     */
    protected $subscribedTopics = array();

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
     * @param ConnectionInterface $from
     * @param Topic               $topic
     */
    public function onSubscribe(ConnectionInterface $from, $topic)
    {
        $this->logger->info('FreeAsso.Wamp2.onSubscribe');
        $this->logger->debug(print_r($topic, true));
        $this->subscribedTopics[$topic->getUri()] = $topic;
    }

    /**
     *
     * @param ConnectionInterface $from
     * @param mixed               $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->logger->info('FreeAsso.Wamp2.onMessage');
        $this->logger->debug(print_r($msg, true));
        $errCode    = 0;
        $errMessage = "Unknown error !";
        try {
            $json = json_decode($msg);
            $this->logger->debug(print_r($json, true));
            while (true) {
                $this->logger->debug(print_r($json, true));
                if (!$json) {
                    $errMessage = "Unknown format !";
                    break;
                }
                if (!isset($json->message)) {
                    $errMessage = "Message code missing !";
                    break;
                }
                if (!isset($json->request)) {
                    $errMessage = "Request id missing !";
                    break;
                }
                switch ($json->message) {
                    case self::MSG_HELLO:
                        $toSend = new \stdClass();
                        $toSend->message = self::MSG_WELCOME;
                        $toSend->request = $json->request;
                        $toSend->uri = "fr.jvsonline.fr";
                        $from->send(json_encode($toSend));
                        return true;
                    case self::MSG_SUBSCRIBE:
                        if (!isset($json->topic)) {
                            $errMessage = "Topic is missing !";
                            break;
                        }
                        $toSend = new \stdClass();
                        $toSend->message = self::MSG_SUBSCRIBED;
                        $toSend->request = $json->request;
                        $toSend->subscription = mt_rand();
                        $topic = $this->getTopic($json->topic);
                        $topic->add($from);
                        $this->onSubscribe($from, $topic);
                        $from->send(json_encode($toSend));
                        return true;
                    case self::MSG_PUBLISH:
                        $toSend = new \stdClass();
                        $toSend->message = self::MSG_PUBLISHED;
                        $toSend->request = $json->request;
                        $toSend->publication = mt_rand();
                        $from->send(json_encode($toSend));
                        return true;
                    default:
                        $errMessage = "Unknown message code !";
                        break;
                }
                break;
            }
        } catch (\Exception $ex) {
            $errCode    = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
        $toSend = new \stdClass();
        $toSend->message = self::MSG_ERROR;
        $toSend->request = $errCode;
        $toSend->content = $errMessage;
        $from->send(json_encode($toSend));
        return false;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Ratchet\ComponentInterface::onClose()
     */
    public function onClose(ConnectionInterface $conn)
    {
        $this->logger->info('FreeAsso.Wamp2.onClose');
    }

    /**
     *
     * {@inheritDoc}
     * @see \Ratchet\ComponentInterface::onOpen()
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->logger->info('FreeAsso.Wamp2.onOpen');
    }

    /**
     * @param string uri
     *
     * @return Topic
     */
    protected function getTopic($topic)
    {
        if (!array_key_exists($topic, self::$topicLookup)) {
            self::$topicLookup[$topic] = new Topic($topic);
        }
        return self::$topicLookup[$topic];
    }

    /**
     *
     * @param Topic $topic
     * @param ConnectionInterface $conn
     */
    protected function cleanTopic(Topic $topic, ConnectionInterface $conn)
    {
        if ($conn->WAMP->subscriptions->contains($topic)) {
            $conn->WAMP->subscriptions->detach($topic);
        }
        if (array_key_exists($topic->getUri(), self::$topicLookup)) {
            self::$topicLookup[$topic->getUri()]->remove($conn);
            if (0 === $topic->count()) {
                unset(self::$topicLookup[$topic->getUri()]);
            }
        }
    }

    /**
     *
     * @param string $entry
     */
    public function onEvent($entry)
    {
        $this->logger->info('FreeAsso.Wamp2.onEvent');
        $this->logger->debug(print_r($entry, true));
        $this->logger->debug(print_r($this->subscribedTopics, true));
        $uri = 'fr.freeasso.storage';
        if (array_key_exists($uri, $this->subscribedTopics)) {
            try {
                $object          = unserialize($entry);
                $topic           = $this->subscribedTopics[$uri];
                $toSend          = new \stdClass();
                $toSend->message = self::MSG_EVENT;
                $toSend->uri     = $topic->getUri();
                $toSend->content = $object;
                $json            = json_encode($toSend);
                $topic->broadcast($json);
            } catch (\Exception $ex) {
                $this->logger->critical($ex->getMessage);
            }
        } else {
            $this->logger->info('FreeAsso.Wamp2.onEvent topic not attached');
        }
    }
}
