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
                        $SiteMedia->setSitmShortBlob($thumb->resizeToBestFit(100, 100));
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
