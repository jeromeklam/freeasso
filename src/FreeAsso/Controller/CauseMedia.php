<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class CauseMedia extends \FreeFW\Core\ApiMediaController
{

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
        $myMedia = \FreeAsso\Model\CauseMedia::findFirst(['caum_id' => $p_id]);
        if ($myMedia) {
            return $this->createMimeTypeResponse($myMedia->getCaumTitle(), $myMedia->getCaumBlob());
        }
        return $this->createResponse(409);
    }
    
    /**
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createOneBlob(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Cause.createOneBlob.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        //
        if ($apiParams->hasData()) {
            /**
             * @var \FreeFW\Core\StorageModel $data
             */
            $data = $apiParams->getData();
            if (!$data->isValid()) {
                $this->logger->debug('FreeAsso.Cause.createOneBlob.end');
                return $this->createResponse(409, $data);
            }
            $cau_id     = $data->getCauId();
            $myCause    = \FreeAsso\Model\Cause::findFirst(['cau_id' => $cau_id]);
            $causeMedia = false;
            $typeMedia  = $this->getMediaType($data->getTitle());
            if ($myCause) {
                $blob       = $this->decode_chunk($data->getBlob());
                $causeMedia = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMedia');
                $causeMedia
                    ->setCauId($myCause->getCauId())
                    ->setCaumType($typeMedia)
                    ->setCaumCode($typeMedia)
                    ->setCaumTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setCaumBlob($blob)
                    ->setCaumTitle($data->getTitle())
                ;
                if ($typeMedia === \FreeAsso\Model\CauseMedia::TYPE_PHOTO) {
                    $thumb = \FreeFW\Tools\ImageResizer::createFromString($blob);
                    $causeMedia->setCaumShortBlob($thumb->resizeToBestFit(200, 200));
                }
                if (!$causeMedia->create()) {
                    return $this->createResponse(409, $causeMedia->getErrors());
                }
            } else {
                return $this->createResponse(409);
            }
            $this->logger->debug('FreeAsso.Cause.createOneBlob.end');
            return $this->createResponse(201, $causeMedia);
        } else {
            return $this->createResponse(409);
        }
    }
}
