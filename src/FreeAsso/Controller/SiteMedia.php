<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class SiteMedia extends \FreeFW\Core\ApiMediaController
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
        $this->logger->debug('FreeAsso.Site.updateOneDesc.start');
        $myMedia = \FreeAsso\Model\SiteMedia::findFirst(['sitm_id' => $p_id]);
        if ($myMedia) {
            $apiParams = $p_request->getAttribute('api_params', false);
            if ($apiParams->hasData()) {
                /**
                 * @var \FreeAsso\Model\SiteMediaBlob $data
                 */
                $data = $apiParams->getData();
                $myMedia->setSitmDesc($data->getDesc());
                if (!$myMedia->save()) {
                    return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $myMedia);
                }
                $this->logger->debug('FreeAsso.Site.updateOneDesc.end');
                return $this->createSuccessOkResponse($myMedia);
            } else {
                $this->logger->debug('FreeAsso.Site.updateOneDesc.409');
                return $this->createResponse(409);
            }
        }
        $this->logger->debug('FreeAsso.Site.updateOneDesc.404');
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
        $myMedia = \FreeAsso\Model\SiteMedia::findFirst(['sitm_id' => $p_id]);
        if ($myMedia) {
            return $this->createMimeTypeResponse($myMedia->getSitmTitle(), $myMedia->getSitmBlob());
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
        $this->logger->debug('FreeAsso.Site.createOneBlob.start');
        $apiParams = $p_request->getAttribute('api_params', false);
        //
        if ($apiParams->hasData()) {
            /**
             * @var \FreeFW\Core\StorageModel $data
             */
            $data = $apiParams->getData();
            if (!$data->isValid()) {
                $this->logger->debug('FreeAsso.SiteMedia.createOneBlob.end');
                return $this->createResponse(409, $data);
            }
            $site_id   = $data->getSiteId();
            $mySite    = \FreeAsso\Model\Site::findFirst(['site_id' => $site_id]);
            $SiteMedia = false;
            $typeMedia = $this->getMediaType($data->getTitle());
            if ($mySite) {
                $blob      = $data->getBlob();
                $SiteMedia = \FreeFW\DI\DI::get('FreeAsso::Model::SiteMedia');
                $SiteMedia
                    ->setSiteId($mySite->getSiteId())
                    ->setSitmType($typeMedia)
                    ->setSitmCode($typeMedia)
                    ->setSitmTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setSitmBlob($blob)
                    ->setSitmTitle($data->getTitle())
                ;
                try {
                    if ($typeMedia === \FreeAsso\Model\SiteMedia::TYPE_PHOTO) {
                        $thumb = \FreeFW\Tools\ImageResizer::createFromString($blob);
                        $image = $thumb->resizeToBestFit(100, 100);
                        if ($image) {
                            $SiteMedia->setSitmShortBlob((string)$image);
                        }
                    }
                } catch (\Exception $ex) {
                    // @todo
                }
                if (!$SiteMedia->create()) {
                    return $this->createResponse(409, $SiteMedia);
                }
            } else {
                return $this->createResponse(409);
            }
            $this->logger->debug('FreeAsso.SiteMedia.createOneBlob.end');
            return $this->createResponse(201, $SiteMedia);
        } else {
            return $this->createResponse(409);
        }
    }
}
