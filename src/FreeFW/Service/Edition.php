<?php

namespace FreeFW\Service;

/**
 * Edition service
 *
 * @author jeromeklam
 */
class Edition extends \FreeFW\Core\Service
{

    /**
     * Generate pdf
     *
     * @param int                  $p_edi_id
     * @param int                  $p_lang_id
     * @param \FreeFW\Core\Model   $p_model
     * @param \FreeSSO\Model\Group $p_grp_id
     *
     * @return array
     */
    public function printEdition($p_edi_id, $p_lang_id, \FreeFW\Core\Model $p_model)
    {
        $filename = '';
        $name     = '';
        /**
         * @var \FreeFW\Model\EditionLang $editionVersion
         */
        $editionVersion = null;
        /**
         * @var \FreeFW\Model\Edition $edition
         */
        $edition = \FreeFW\Model\Edition::findFirst(['edi_id' => $p_edi_id]);
        if ($edition instanceof \FreeFW\Model\Edition) {
            foreach ($edition->getVersions() as $oneVersion) {
                if ($oneVersion->getLangId() == $p_lang_id) {
                    $editionVersion = $oneVersion;
                    break;
                }
            }
            if ($editionVersion === null) {
                foreach ($edition->getVersions() as $oneVersion) {
                    $editionVersion = $oneVersion;
                    if ($oneVersion->getLangId() == $edition->getLangId()) {
                        $p_lang_id = $edition->getLangId();
                        break;
                    }
                }
            }
        }
        if ($editionVersion) {
            $includes = true;
            // Les includes de l'édition sont prioritaires
            if ($edition->getEdiIncludes() != '') {
                $includes = explode(',', $edition->getEdiIncludes());
            }
            $lang = \FreeFW\Model\Lang::findFirst(['lang_id' => $p_lang_id]);
            $name = $editionVersion->getEdilFilename();
            if (method_exists($p_model, 'afterRead')) {
                $p_model->afterRead();
            }
            $mergeDatas = $p_model->getMergeData($includes, '', '', false, $lang->getLangCode());
            // Get group and user
            $sso        = \FreeFW\DI\DI::getShared('sso');
            $user       = $sso->getUser();
            // @todo : rechercher le groupe principal de l'utilisateur
            if (method_exists($p_model, 'getGrpId')) {
                $grpId = $p_model->getGrpId();
            }
            if (!$grpId) {
                $group = $sso->getUserGroup();
                if ($group) {
                    $grpId = $group->getGrpId();
                }
            }
            $group = \FreeSSO\Model\Group::findFirst(
                [
                    'grp_id' => $grpId
                ]
            );
            //
            $mergeDatas->addBlock('main');
            $mergeDatas->addData(['now' => \FreeFW\Tools\Date::mysqlToddmmyyyy(\FreeFW\Tools\Date::getCurrentTimestamp(), false, false)], 'main');
            if ($user) {
                $mergeUser = $user->getMergeData(true, '', '', false, $lang->getLangCode(), 'head_user');
                $mergeDatas->merge($mergeUser);
            }
            if ($group) {
                $mergeGroup = $group->getMergeData(true, '', '', false, $lang->getLangCode(), 'head_group');
                $mergeDatas->merge($mergeGroup);
            }
            //
            $cfg  = $this->getAppConfig();
            $dir  = $cfg->get('ged:dir');
            if (!is_dir($dir)) {
                $dir = '/tmp/';
            }
            $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
            $file = uniqid(true, 'edition');
            if ($edition->getEdiType() == \FreeFW\Model\Edition::TYPE_PDF) {
                $src  = $bDir . '/print_' . $file . '_tpl.pdf';
                $dPdf = $bDir . '/print_' . $file . '_dest.pdf';
                $this->logger->debug("before " . $dPdf);
                $ediContent = $editionVersion->getEdilData();
                file_put_contents($src, $ediContent);
                $this->logger->debug("data ok " . $dPdf);
                $mapping = json_decode($edition->getEdiMapping(), true);
                if (!$mapping) {
                    $this->logger->error('Mapping for edition not found or not json !');
                    return false;
                }
                $mergedDatas = $mergeDatas->computeFromMapping($mapping);
                $this->logger->debug("computing " . $dPdf);
                $mergeService = \FreeFW\DI\DI::get('FreeOffice::Service::Pdf');
                $mergeService->merge($src, $dPdf, $mergedDatas);
                @unlink($src);
                $this->logger->debug("done " . $dPdf);
            } else {
                $src  = $bDir . '/print_' . $file . '_tpl.odt';
                $dest = $bDir . '/print_' . $file . '_dest.odt';
                $dPdf = $bDir . '/print_' . $file . '_dest.pdf';

                $this->logger->debug("before " . $dPdf);
                $ediContent = $editionVersion->getEdilData();
                file_put_contents($src, $ediContent);
                file_put_contents($dest, $ediContent);
                $mergeService = \FreeFW\DI\DI::get('FreeOffice::Service::Merge');
                $mergeService->merge($src, $dest, $mergeDatas);
                $try = 5;
                $exitcode = 255;
                while ($try > 0 && $exitcode > 0) {
                    $result = \FreeFW\Tools\Shell::exec_timeout('/usr/bin/unoconv -f pdf -o ' . $dPdf . ' ' . $dest . ' 2>/dev/null', 60);
                    if (is_array($result) && isset($result['exitcode'])) {
                        $exitcode = $result['exitcode'];
                    }
                    if ($exitcode > 0) {
                        var_dump('retry');
                    }
                    $try--;
                }
                @unlink($dest);
                @unlink($src);
            }
            $filename = $dPdf;
            $this->logger->debug("after " . $filename);
        }
        return [
            'name' => $name,
            'filename' => $filename,
        ];
    }
}
