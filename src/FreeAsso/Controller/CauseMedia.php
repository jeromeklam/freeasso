<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class CauseMedia extends \FreeFW\Core\ApiController
{

    /**
     * Get base64 src format
     * 
     * @param mixed $p_data
     * 
     * @return boolean|string
     */
    public function decode_chunk($p_data)
    {
        $data = explode(';base64,', $p_data);
        if (!is_array($data) || !isset($data[1])) {
            return false;
        }
        $data = base64_decode($data[1]);
        if (!$data) {
            return false;
        }
        return $data;
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
            $myCause    = \FreeAsso\Model\Cause::findFirst([cau_id => $cau_id]);
            $causeMedia = false;
            if ($myCause) {
                $blob       = $this->decode_chunk($data->getBlob());
                $thumb      = \FreeFW\Tools\ImageResizer::createFromString($blob);
                $causeMedia = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMedia');
                $causeMedia
                    ->setCauId($myCause->getCauId())
                    ->setCaumType(\FreeAsso\Model\CauseMedia::TYPE_PHOTO)
                    ->setCaumCode('PHOTO')
                    ->setCaumTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setCaumBlob($blob)
                    ->setCaumShortBlob($thumb->resizeToBestFit(200, 200))
                ;
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
