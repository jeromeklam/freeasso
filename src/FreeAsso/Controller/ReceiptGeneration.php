<?php
namespace FreeAsso\Controller;

/**
 * Controller ReceiptGeneration
 *
 * @author jeromeklam
 */
class ReceiptGeneration extends \FreeFW\Core\ApiController
{

    /**
     * Comportement
     */
    use \FreeAsso\Controller\Behaviour\Group;

    /**
     * Action on single element
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param integer                                  $p_id
     * @param string                                   $p_action
     */
    public function sendAction(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id, $p_action)
    {
        $this->logger->debug('FreeAsso.ReceiptGenerationController.sendAction.start');
        /**
         * @var \FreeAsso\Model\ReceipGeneration $receiptGen
         */
        $receiptGen = \FreeAsso\Model\ReceiptGeneration::findFirst(['recg_id' => $p_id]);
        if ($receiptGen) {
            switch (strtoupper($p_action)) {
                case 'GENERATE':
                    $receiptGen->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_WAITING);
                    $receiptGen->startTransaction();
                    if ($receiptGen->save(false)) {
                        /**
                         * @var \FreeFW\Model\Jobqueue $jobqueue
                         */
                        $jobqueue = \FreeFW\Model\Jobqueue::getFactory(
                            $receiptGen->getRecgName(),
                            'FreeAsso::Service::ReceiptGeneration',
                            'generate',
                            [
                                'recg_id' => $receiptGen->getRecgId()
                            ]
                        );
                        if ($jobqueue->create(false)) {
                            $receiptGen->commitTransaction();
                            return $this->createSuccessOkResponse($receiptGen);
                        } else {
                            $receiptGen->rollbackTransaction();
                            return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES, $jobqueue->getErrors());
                        }
                    } else {
                        $receiptGen->rollbackTransaction();
                        return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES, $receiptGen->getErrors());
                    }
                    break;
                case 'REMOVE':
                    $receiptGen->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_WAITING);
                    $receiptGen->startTransaction();
                    if ($receiptGen->save(false)) {
                        /**
                         * @var \FreeFW\Model\Jobqueue $jobqueue
                         */
                        $jobqueue = \FreeFW\Model\Jobqueue::getFactory(
                            $receiptGen->getRecgName(),
                            'FreeAsso::Service::ReceiptGeneration',
                            'undo',
                            [
                                'recg_id' => $receiptGen->getRecgId()
                            ]
                        );
                        if ($jobqueue->create(false)) {
                            $receiptGen->commitTransaction();
                            return $this->createSuccessOkResponse($receiptGen);
                        } else {
                            $receiptGen->rollbackTransaction();
                            return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES, $jobqueue->getErrors());
                        }
                    } else {
                        $receiptGen->rollbackTransaction();
                        return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES, $receiptGen->getErrors());
                    }
                    break;
                case 'SEND':
                    $receiptGen->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_WAITING);
                    $receiptGen->startTransaction();
                    if ($receiptGen->save(false)) {
                        /**
                         * @var \FreeFW\Model\Jobqueue $jobqueue
                         */
                        $jobqueue = \FreeFW\Model\Jobqueue::getFactory(
                            $receiptGen->getRecgName(),
                            'FreeAsso::Service::ReceiptGeneration',
                            'send',
                            [
                                'recg_id' => $receiptGen->getRecgId()
                            ]
                        );
                        if ($jobqueue->create(false)) {
                            $receiptGen->commitTransaction();
                            return $this->createSuccessOkResponse($receiptGen);
                        } else {
                            $receiptGen->rollbackTransaction();
                            return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES, $jobqueue->getErrors());
                        }
                    } else {
                        $receiptGen->rollbackTransaction();
                        return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES, $receiptGen->getErrors());
                    }
                    break;
                default:
                    $this->logger->debug('FreeAsso.ReceiptGenerationController.sendAction.error');
                    return $this->createErrorResponse(\FreeFW\Constants::ERROR_VALUES);
                    break;
            }
        }
        $this->logger->debug('FreeAsso.ReceiptGenerationController.sendAction.error');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND);
    }
}
