<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Session extends \FreeFW\Core\ApiController
{

    /**
     * Comportement
     */
    use \FreeAsso\Controller\Behavior\Group;

    /**
     * Demande de purge
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param number $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cleanOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $this->logger->debug('FreeAsso.Session.cleanOne.start');
        $session = \FreeAsso\Model\Session::findFirst(['sess_id' => $p_id]);
        if ($session) {
            $params = new \stdClass();
            $params->year  = $session->getSessYear();
            $params->month = $session->getSessMonth();
            $jobQueue = new \FreeFW\Model\Jobqueue();
            $jobQueue
                ->setJobqName('Vérification période ' . $session->getSessMonth() . '/' . $session->getSessYear())
                ->setJobqService('FreeAsso::Service::Accounting')
                ->setJobqMethod('cleanLines')
                ->setJobqStatus(\FreeFW\Model\Jobqueue::STATUS_WAITING)
                ->setJobqParams(json_encode($params))
                ->setJobqType(\FreeFW\Model\Jobqueue::TYPE_ONCE)
                ->setJobqNextRetry(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setJobqMaxHour(1)
            ;
            $jobQueue->startTransaction();
            if ($jobQueue->create()) {
                $session->setSessVerif(\FreeAsso\Model\Session::VERIF_PENDING);
                if ($session->save()) {
                    $jobQueue->commitTransaction();
                    $this->logger->debug('FreeAsso.Session.cleanOne.end');
                    return $this->createSuccessOkResponse($session);
                }
                $jobQueue->rollbackTransaction();
                $session->addErors($jobQueue->getErrors());
                $this->logger->debug('FreeAsso.Session.cleanOne.end');
                return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_INSERT, $session);
            }
            $jobQueue->rollbackTransaction();
            $session->addErors($jobQueue->getErrors());
            $this->logger->debug('FreeAsso.Session.cleanOne.error');
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_INSERT, $session);
        }
        $this->logger->debug('FreeAsso.Session.cleanOne.404');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND);
    }

    /**
     * Demande de vérification
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param number $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function verifOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $this->logger->debug('FreeAsso.Session.verifOne.start');
        $session = \FreeAsso\Model\Session::findFirst(['sess_id' => $p_id]);
        if ($session) {
            $params = new \stdClass();
            $params->year  = $session->getSessYear();
            $params->month = $session->getSessMonth();
            $jobQueue = new \FreeFW\Model\Jobqueue();
            $jobQueue
                ->setJobqName('Vérification période ' . $session->getSessMonth() . '/' . $session->getSessYear())
                ->setJobqService('FreeAsso::Service::Accounting')
                ->setJobqMethod('verifyLines')
                ->setJobqStatus(\FreeFW\Model\Jobqueue::STATUS_WAITING)
                ->setJobqParams(json_encode($params))
                ->setJobqType(\FreeFW\Model\Jobqueue::TYPE_ONCE)
                ->setJobqNextRetry(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setJobqMaxHour(1)
            ;
            $jobQueue->startTransaction();
            if ($jobQueue->create()) {
                $session->setSessVerif(\FreeAsso\Model\Session::VERIF_PENDING);
                if ($session->save()) {
                    $jobQueue->commitTransaction();
                    $this->logger->debug('FreeAsso.Session.verifOne.end');
                    return $this->createSuccessOkResponse($session);
                }
                $jobQueue->rollbackTransaction();
                $session->addErors($jobQueue->getErrors());
                $this->logger->debug('FreeAsso.Session.verifOne.end');
                return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_INSERT, $session);
            }
            $jobQueue->rollbackTransaction();
            $session->addErors($jobQueue->getErrors());
            $this->logger->debug('FreeAsso.Session.verifOne.error');
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_INSERT, $session);
        }
        $this->logger->debug('FreeAsso.Session.verifOne.404');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND);
    }
}
