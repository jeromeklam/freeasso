<?php
namespace FreeAsso\Controller;

/**
 * Controller ContractMedia
 *
 * @author jeromeklam
 */
class ContractMedia extends \FreeFW\Core\ApiMediaController
{

    /**
     * Mie à jour de la description
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param number $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOneDesc(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $this->logger->debug('FreeAsso.Contract.updateOneDesc.start');
        $myMedia = \FreeAsso\Model\ContractMedia::findFirst(['ctm_id' => $p_id]);
        if ($myMedia) {
            $apiParams = $p_request->getAttribute('api_params', false);
            if ($apiParams->hasData()) {
                /**
                 * @var \FreeAsso\Model\ContractMediaBlob $data
                 */
                $data = $apiParams->getData();
                $myMedia->setCtmDesc($data->getDesc());
                if (!$myMedia->save()) {
                    return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $myMedia);
                }
                $this->logger->debug('FreeAsso.Contract.updateOneDesc.end');
                return $this->createSuccessOkResponse($myMedia);
            } else {
                $this->logger->debug('FreeAsso.Contract.updateOneDesc.409');
                return $this->createResponse(409);
            }
        }
        $this->logger->debug('FreeAsso.Contract.updateOneDesc.404');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND);
    }

    /**
     * Get file content for download
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param string                                   $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadOneBlob(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $myMedia = \FreeAsso\Model\ContractMedia::findFirst(['ctm_id' => $p_id]);
        if ($myMedia) {
            return $this->createMimeTypeResponse($myMedia->getCtmTitle(), $myMedia->getCtmBlob());
        }
        return $this->createResponse(409);
    }

    /**
     * CreateOne
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createOneBlob(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Contract.createOneBlob.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        //
        if ($apiParams->hasData()) {
            /**
             * @var \FreeFW\Core\StorageModel $data
             */
            $data = $apiParams->getData();
            if (!$data->isValid()) {
                $this->logger->debug('FreeAsso.ContractMedia.createOneBlob.end');
                return $this->createResponse(409, $data);
            }
            $ct_id   = $data->getCtId();
            $myContract    = \FreeAsso\Model\Contract::findFirst(['ct_id' => $ct_id]);
            $ContractMedia = false;
            $typeMedia = $this->getMediaType($data->getTitle());
            if ($myContract) {
                $blob      = $data->getBlob();
                $ContractMedia = \FreeFW\DI\DI::get('FreeAsso::Model::ContractMedia');
                $ContractMedia
                    ->setCtId($myContract->getCtId())
                    ->setCtmType($typeMedia)
                    ->setCtmCode($typeMedia)
                    ->setCtmTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setCtmBlob($blob)
                    ->setCtmTitle($data->getTitle())
                ;
                try {
                    if ($typeMedia === \FreeAsso\Model\ContractMedia::TYPE_PHOTO) {
                        $thumb = \FreeFW\Tools\ImageResizer::createFromString($blob);
                        $image = $thumb->resizeToBestFit(100, 100);
                        if ($image) {
                            $ContractMedia->setCtmShortBlob((string)$image);
                        }
                    }
                } catch (\Exception $ex) {
                    // @todo
                }
                if (!$ContractMedia->create()) {
                    return $this->createResponse(409, $ContractMedia);
                }
            } else {
                return $this->createResponse(409);
            }
            $this->logger->debug('FreeAsso.ContractMedia.createOneBlob.end');
            return $this->createResponse(201, $ContractMedia);
        } else {
            return $this->createResponse(409);
        }
    }
}
