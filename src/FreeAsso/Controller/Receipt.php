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
     * Print one by id
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function downloadOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.ReceiptController.getOne.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        if (method_exists($this, 'adaptApiParams')) {
            $apiParams = $this->adaptApiParams($apiParams, 'getOne');
        }
        $code    = FFCST::ERROR_VALUES;
        $default = $p_request->default_model;
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
                    $this->logger->info('FreeAsso.ReceiptController.printOne.end');
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
        $this->logger->info('FreeAsso.ReceiptController.printOne.end');
        return $this->createErrorResponse($code);
    }
}
