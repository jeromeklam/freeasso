<?php
namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Certificate extends \FreeFW\Core\ApiController
{

    /**
     * Comportement
     */
    use \FreeAsso\Controller\Behaviour\Group;

    /**
     * Renew edition
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function generateOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.CertificateController.generateOne.start');
        /**
         * @var \FreeAsso\Model\Certificate $certificate
         */
        $certificate = \FreeAsso\Model\Certificate::findFirst(['cert_id' => $p_id]);
        if ($certificate) {
            if (!$certificate->generate()) {
                $this->logger->debug('FreeAsso.CertificateController.getOne.error');
                return $this->createErrorResponse(\FreeAsso\Constants::ERROR_CERTIFICATE_GENERATE, null);
            }
            return $this->createSuccessOkResponse($certificate);
        } else {
            $this->logger->debug('FreeAsso.CertificateController.getOne.end');
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
        }
        $this->logger->debug('FreeAsso.CertificateController.generateOne.end');
    }

    /**
     * Send by email
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function sendOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.CertificateController.sendOne.start');
        /**
         * @var \FreeAsso\Model\Certificate $certificate
         */
        $certificate = \FreeAsso\Model\Certificate::findFirst(['cert_id' => $p_id]);
        if ($certificate) {
        } else {
            $this->logger->debug('FreeAsso.CertificateController.getOne.end');
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
        }
        $this->logger->debug('FreeAsso.CertificateController.sendOne.end');
    }

    /**
     * Print one by id
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function downloadOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.CertificateController.getOne.start');
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
            $apiParams = $this->adaptApiParams($apiParams, 'getOne');
        }
        $default = $p_request->getAttribute('default_model');
        $model   = \FreeFW\DI\DI::get($default);
        /**
         * Id
         */
        if (intval($p_id) > 0) {
            $filters  = new \FreeFW\Model\Conditions();
            $pk_field = $model->getPkField();
            $aField   = new \FreeFW\Model\ConditionMember();
            $aValue   = new \FreeFW\Model\ConditionValue();
            $aValue->setValue($p_id);
            $aField->setValue($pk_field);
            $aCondition = new \FreeFW\Model\SimpleCondition();
            $aCondition->setLeftMember($aField);
            $aCondition->setOperator(\FreeFW\Storage\Storage::COND_EQUAL);
            $aCondition->setRightMember($aValue);
            $filters->add($aCondition);
            /**
             * @var \FreeFW\Model\Query $query
             */
            $query = $model->getQuery();
            $query
                ->addConditions($filters)
                ->addConditions($apiParams->getFilters())
                ->addRelations($apiParams->getInclude())
                ->setLimit(0, 1);
            $data = new \FreeFW\Model\ResultSet();
            if ($query->execute()) {
                $data = $query->getResult();
            }
            if (count($data) > 0) {
                $model = $data[0];
                /**
                 *
                 * @var \FreeFW\Model\File $file
                 */
                $file = \FreeFW\Model\File::findFirst(['file_id' => $model->getFileId()]);
                if ($file) {
                    $model->setCertPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                    $model->save();
                    $this->logger->info('FreeAsso.CertificateController.printOne.end');
                    return $this->createMimeTypeResponse('certificat.pdf', $file->getFileBlob());
                } else {
                    $data = null;
                    $code = FFCST::ERROR_NOT_FOUND; // 404
                }
            } else {
                $data = null;
                $code = FFCST::ERROR_NOT_FOUND; // 404
            }
        } else {
            $data = null;
            $code = FFCST::ERROR_ID_IS_MANDATORY; // 409
        }
        $this->logger->info('FreeAsso.CertificateController.printOne.end');
        return $this->createErrorResponse($code);
    }
}
