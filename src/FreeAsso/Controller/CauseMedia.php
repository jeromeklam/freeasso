<?php
namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class CauseMedia extends \FreeFW\Core\ApiMediaController
{

    /**
     * Passe le media en valeur par défaut sur la cause
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param number $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $this->logger->debug('FreeAsso.CauseMedia.checkOne.start');
        $myMedia = \FreeAsso\Model\CauseMedia::findFirst(['caum_id' => $p_id]);
        if ($myMedia) {
            /**
             * @var \FreeAsso\Model\Cause $cause
             */
            $cause = \FreeAsso\Model\Cause::findFirst(['cau_id' => $myMedia->getCauId()]);
            if ($cause) {
                $cause->setCaumBlobId($p_id);
                if ($cause->save(true, true)) {
                    $this->logger->debug('FreeAsso.Cause.createOneBlob.end');
                    return $this->createRedirect(
                        'FreeAsso_Cause',
                        \FreeFW\Router\Route::ROLE_GET_ONE,
                        ['cau_id' => $cause->getCauId()]
                    );
                } else {
                    $this->logger->debug('FreeAsso.CauseMedia.updateOneDesc.409');
                    return $this->createResponse(409);
                }
            }
        }
        $this->logger->debug('FreeAsso.CauseMedia.checkOne.404');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND);
    }

    /**
     * Mise à jour de la description
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param number $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOneDesc(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id)
    {
        $this->logger->debug('FreeAsso.CauseMedia.updateOneDesc.start');
        $myMedia = \FreeAsso\Model\CauseMedia::findFirst(['caum_id' => $p_id]);
        if ($myMedia) {
            $apiParams = $p_request->getAttribute('api_params', false);
            if ($apiParams->hasData()) {
                /**
                 * @var \FreeAsso\Model\CauseMediaBlob $data
                 */
                $data = $apiParams->getData();
                $myMedia->setCaumDesc($data->getDesc());
                if (!$myMedia->save()) {
                    return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $myMedia);
                }
                $this->logger->debug('FreeAsso.CauseMedia.updateOneDesc.end');
                return $this->createSuccessOkResponse($myMedia);
            } else {
                $this->logger->debug('FreeAsso.CauseMedia.updateOneDesc.409');
                return $this->createResponse(409);
            }
        }
        $this->logger->debug('FreeAsso.CauseMedia.updateOneDesc.404');
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
        $this->logger->debug('FreeAsso.Cause.downloadOneBlob.start');
        $myMedia = \FreeAsso\Model\CauseMedia::findFirst(['caum_id' => $p_id]);
        if ($myMedia) {
            $this->logger->debug('FreeAsso.Cause.downloadOneBlob.end');
            return $this->createMimeTypeResponse($myMedia->getCaumTitle(), $myMedia->getCaumBlob());
        }
        $this->logger->debug('FreeAsso.Cause.downloadOneBlob.404');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND);
    }

    /**
     * Add one blob
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
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
            /**
             *
             * @var \FreeAsso\Model\Cause $myCause
             */
            $myCause    = \FreeAsso\Model\Cause::findFirst(['cau_id' => $cau_id]);
            $causeMedia = false;
            $typeMedia  = $this->getMediaType($data->getTitle());
            if ($myCause) {
                $blob       = $data->getBlob();
                /**
                 * @var \FreeAsso\Model\CauseMedia $causeMedia
                 */
                $causeMedia = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMedia');
                $causeMedia
                    ->setCauId($myCause->getCauId())
                    ->setCaumType($typeMedia)
                    ->setCaumCode($typeMedia)
                    ->setCaumTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setCaumBlob($blob)
                    ->setCaumTitle($data->getTitle())
                ;
                try {
                    if ($typeMedia === \FreeAsso\Model\CauseMedia::TYPE_PHOTO) {
                        $thumb = \FreeFW\Tools\ImageResizer::createFromString($blob);
                        $image = $thumb->resizeToBestFit(150, 150);
                        if ($image) {
                            $causeMedia->setCaumShortBlob((string)$image);
                        }
                    }
                } catch (\Exception $ex) {
                    // @todo
                }
                if (!$causeMedia->create()) {
                    $this->logger->debug('FreeAsso.Cause.createOneBlob.409');
                    return $this->createResponse(409, $causeMedia);
                }
                if ($typeMedia === \FreeAsso\Model\CauseMedia::TYPE_PHOTO) {
                    if (!$myCause->getCaumBlobId()) {
                        $myCause->setCaumBlobId($causeMedia->getCaumId());
                        $myCause->save();
                    }
                }
                return $this->createRedirect(
                    'FreeAsso_Cause',
                    \FreeFW\Router\Route::ROLE_GET_ONE,
                    ['cau_id' => $myCause->getCauId()]
                );
            } else {
                $this->logger->debug('FreeAsso.Cause.createOneBlob.409s');
                return $this->createResponse(409);
            }
            $this->logger->debug('FreeAsso.Cause.createOneBlob.end');
            return $this->createResponse(201, $causeMedia);
        } else {
            return $this->createResponse(409);
        }
    }
}
