<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Receipt extends \FreeFW\Core\Service
{

    /**
     * Download receipts
     *
     * @param array $p_params
     * 
     * @return array
     */
    public function deferredDownload($p_params = [], $p_user_id)
    {
        $this->logger->debug('Receipt.download.start');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $model = \FreeFW\DI\DI::get($p_params['model']);
        $query = $model->getQuery();
        $params = unserialize($p_params['api']);
        /**
         *
         * @var \FreeFW\Model\Conditions $conditions
         */
        $conditions = $params->getFilters();
        $query
            ->addConditions($params->getFilters())
            ->addRelations($params->getInclude())
            ->setLimit($params->getStart(), $params->getlength())
            ->setSort($params->getSort())
        ;
        $tmpPrefix  = '/tmp/export_' . uniqid() . '_';
        $outputFile = '/tmp/export_' . uniqid() . '.pdf';
        $merger     = new \FreeOffice\Tools\PdfMerger();
        if ($query->execute()) {
            $files    = [];
            $receipts = $query->getResult();
            /**
             * @var \FreeAsso\Model\Receipt $oneReceipt
             */
            foreach ($receipts as $oneReceipt) {
                $file = $oneReceipt->getFile();
                if ($file) {
                    $filename = $tmpPrefix . $file->getFileId() . '.pdf';
                    $files[]  = $filename;
                    file_put_contents($filename, $file->getFileBlob());
                    $merger->addFile($filename);
                }
            }
            $merger->merge('file', $outputFile, true);
            foreach ($files as $oneFile) {
                @unlink($oneFile);
            }
        }
        
        // Add notification and inbox
        $object = str_replace('::Model::', '_', $p_params['model']);
        $parts  = explode('_', $object);
        $date   = \str_replace('-', '', \FreeFW\Tools\Date::getCurrentDate());
        $name   = array_pop($parts) . '_' . $date;
        $inbox  = new \FreeFW\Model\Inbox();
        $inbox
            ->setInboxFilename($name . '.pdf')
            ->setInboxObjectName($object)
            ->setInboxParams(json_encode($p_params))
            ->setInboxContent(file_get_contents($outputFile))
            ->setUserId($p_user_id)
        ;
        if (!$inbox->create()) {
            $result = false;
        }
        @unlink($outputFile);
        $notification = new \FreeFW\Model\Notification();
        $notification
            ->setNotifCode('EXPORT')
            ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
            ->setNotifSubject('Export terminé')
            ->setNotifObjectName($object)
            ->setUserId($p_user_id)
        ;
        if (!$notification->create()) {
            $result = false;
        }
        // data can be empty, but it's a 2*
        $this->logger->debug('Receipt.download.end');
        return $p_params;
    }
}
