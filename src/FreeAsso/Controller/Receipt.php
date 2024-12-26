<?php

namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Receipt extends \FreeFW\Core\ApiController
{
    /**
     * Comportement
     */
    use \FreeAsso\Controller\Behaviour\Group;

    /**
     * Download all
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function download(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.ReceiptController.download.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        /**
         * Must add some extra params, filters, ...
         */
        if (method_exists($this, 'adaptApiParams')) {
            $apiParams = $this->adaptApiParams($apiParams, 'getAll');
        }
        /**
         *
         */
        $print = $apiParams->getData();
        if (!$print instanceof \FreeFW\Model\PrintOptions) {
            $this->logger->info('FreeAsso.ReceiptController.download.error.wrong_body');
            return $this->createErrorResponse(FFCST::ERROR_IN_DATA);
        }
        /**
         * Save for deferred action
         */
        $params = new \stdClass();
        $params->model = $p_request->getAttribute('default_model');
        $params->api = serialize($apiParams);
        /**
         *
         * @var \FreeFW\Model\Jobqueue $jobqueue
         */
        $jobqueue = new \FreeFW\Model\Jobqueue();
        /**
         * All in one sheet
         */
        $jobqueue
            ->setJobqService('FreeAsso::Service::Receipt')
            ->setJobqMethod('deferredDownload')
            ->setJobqStatus(\FreeFW\Model\Jobqueue::STATUS_WAITING)
            ->setJobqName('Demande de téléchargement')
            ->setJobqType(\FreeFW\Model\Jobqueue::TYPE_ONCE)
            ->setJobqParams(json_encode($params));
        $jobqueue->create();
        $this->logger->debug('FreeAsso.ReceiptController.download.end');
        return $this->createSuccessAddResponse($jobqueue);
    }

    /**
     * Print one by id
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function downloadOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.ReceiptController.downloadOne.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        if (method_exists($this, 'adaptApiParams')) {
            $apiParams = $this->adaptApiParams($apiParams, 'downloadOne');
        }
        $code    = FFCST::ERROR_VALUES;
        $default = $p_request->getAttribute('default_model');
        $model   = \FreeFW\DI\DI::get($default);
        /**
         * Id
         */
        if (intval($p_id) > 0) {
            /**
             * @var \FreeAsso\Model\Receipt $receipt
             */
            $receipt = \FreeAsso\Model\Receipt::findFirst(['rec_id' => $p_id]);
            if ($receipt) {
                /**
                 * @var \FreeFW\Model\File $file
                 */
                $file = \FreeFW\Model\File::findFirst(['file_id' => $receipt->getFileId()]);
                if ($file) {
                    $this->logger->info('FreeAsso.ReceiptController.downloadOne.end');
                    return $this->createMimeTypeResponse($receipt->getRecNumber() . '.pdf', $file->getFileBlob());
                } else {
                    $data = null;
                    $code = FFCST::ERROR_NOT_FOUND;
                }
            } else {
                $data = null;
                $code = FFCST::ERROR_NOT_FOUND;
            }
        } else {
            $data = null;
            $code = FFCST::ERROR_ID_IS_MANDATORY; // 409
        }
        $this->logger->info('FreeAsso.ReceiptController.downloadOne.end');
        return $this->createErrorResponse($code);
    }

    /**
     * Generate one by id
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function generateOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.ReceiptController.generateOne.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        if (method_exists($this, 'adaptApiParams')) {
            $apiParams = $this->adaptApiParams($apiParams, 'generateOne');
        }
        $code    = FFCST::ERROR_VALUES;
        /**
         * Id
         */
        if (intval($p_id) > 0) {
            /**
             * @var \FreeAsso\Model\Receipt $receipt
             */
            $receipt = \FreeAsso\Model\Receipt::findFirst(['rec_id' => $p_id]);
            if ($receipt) {
                // Detect edition.........
                $receipt_generation = $receipt->getReceiptGeneration();
                if ($receipt_generation) {
                    $edition = $receipt_generation->getEdition();
                    if ($edition) {
                        if ($receipt->generatePDF($edition->getEdiId())) {
                            $this->logger->info('FreeAsso.ReceiptController.printOne.end');
                            return $this->createSuccessUpdateResponse($receipt);
                        }
                    }
                }
                die('tretretre');
            } else {
                $code = FFCST::ERROR_NOT_FOUND;
            }
        } else {
            $code = FFCST::ERROR_ID_IS_MANDATORY; // 409
        }
        $this->logger->info('FreeAsso.ReceiptController.generateOne.end');
        return $this->createErrorResponse($code);
    }
}
