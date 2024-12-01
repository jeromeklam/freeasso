<?php
namespace FreeFW\Service;

/**
 * Email service
 *
 * @author jeromeklam
 */
class Email extends \FreeFW\Core\Service
{

    /**
     * Get new message from email
     *
     * @param array                                                   $p_filters
     * @param number                                                  $p_lang_id
     * @param \FreeFW\Core\StorageModel | [\FreeFW\Core\StorageModel] $p_model
     * @param boolean                                                 $p_merge
     *
     * @return NULL|\FreeFW\Model\Message
     */
    public function getEmailAsMessage(array $p_filters, int $p_lang_id, $p_model, $p_merge = true, $p_grpId = null)
    {
        $message = null;
        $emails  = \FreeFW\Model\Email::find($p_filters);
        /**
         * @var \FreeFW\Model\Email $oneEmail
         */
        foreach ($emails as $oneEmail) {
            $emailVersion = null;
            /**
             * @var \FreeFW\Model\EmailLang $oneVersion
             */
            foreach ($oneEmail->getVersions() as $oneVersion) {
                if ($oneVersion->getLangId() == $p_lang_id) {
                    $emailVersion = $oneVersion;
                    break;
                }
            }
            if ($emailVersion === null) {
                foreach ($oneEmail->getVersions() as $oneVersion) {
                    if ($oneVersion->getLangId() == $oneEmail->getLangId()) {
                        $emailVersion = $oneVersion;
                        $p_lang_id = $oneEmail->getLangId();
                        break;
                    }
                }
            }
            $lang = \FreeFW\Model\Lang::findFirst(['lang_id' => $p_lang_id]);
            if ($emailVersion !== null) {
                // Get group and user
                $sso    = \FreeFW\DI\DI::getShared('sso');
                $user   = $sso->getUser();
                // @todo : rechercher le groupe principal de l'utilisateur
                $grpId  = $p_grpId;
                $models = $p_model;
                $lModel = null;
                if (!is_array($models)) {
                    $models   = [];
                    $models[] = $p_model;
                }
                /**
                 * @var \FreeFW\Core\Model $oneModel
                 */
                foreach ($models as $oneModel) {
                    if (!$lModel) {
                        $lModel = $oneModel;
                    }
                    $datas = $oneModel->getMergeData(true, '', '', false, $lang->getLangCode());
                    if (!$grpId) {
                        if (method_exists($oneModel, 'getGrpId')) {
                            $grpId = $oneModel->getGrpId();
                        }
                        if (!$grpId) {
                            $group = $sso->getUserGroup();
                            if ($group) {
                                $grpId = $group->getGrpId();
                            }
                        }
                    }
                    if ($grpId) {
                        $group = \FreeSSO\Model\Group::findFirst(
                            [
                                'grp_id' => $grpId
                            ]
                        );
                        if ($user) {
                            $mergeUser = $user->getMergeData(true, '', '', false, $lang->getLangCode(), 'head_user');
                            $datas->merge($mergeUser);
                        }
                        if ($group) {
                            $mergeGroup = $group->getMergeData(true, '', '', false, $lang->getLangCode(), 'head_group');
                            $datas->merge($mergeGroup);
                        }
                    }
                    
                    $fields = $datas->__toArray();
                }
                //
                //
                $message = new \FreeFW\Model\Message();
                $subject = $oneVersion->getEmaillSubject();
                $body    = $oneVersion->getEmaillBody();
                if ($p_merge) {
                    $subject = \FreeFW\Tools\PBXString::parse($subject, $fields);
                    $body    = \FreeFW\Tools\PBXString::parse($body, $fields);
                    if ($oneEmail->getTplId() > 0) {
                        $template = $oneEmail->getTemplate();
                        $tplBody = $template->getTplContent();
                        $body = \FreeFW\Tools\PBXString::parse(
                            $tplBody,
                            [
                                'template_lang'    => $lang->getLangCode(),
                                'template_subject' => $subject,
                                'template_body'    => $body
                            ]
                        );
                    }
                    if ($oneEmail->getEmailEdi1Id()) {
                        try {
                            $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                            $datas = $editionService->printEdition(
                                $oneEmail->getEmailEdi1Id(),
                                $p_lang_id,
                                $lModel
                            );
                            if (isset($datas['filename']) && is_file($datas['filename'])) {
                                $message->addAttachment($datas['filename'], $datas['name']);
                            }
                        } catch (\Exception $ex) {
                            // @todo
                        }
                    }
                    if ($oneEmail->getEmailEdi2Id()) {
                        try {
                            $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                            $datas = $editionService->printEdition(
                                $oneEmail->getEmailEdi2Id(),
                                $p_lang_id,
                                $lModel
                            );
                            if (isset($datas['filename']) && is_file($datas['filename'])) {
                                $message
                                    ->setMsgPj2($datas['filename'])
                                    ->setMsgPj2Name($datas['name'])
                                ;
                            }
                        } catch (\Exception $ex) {
                            // @todo
                        }
                    }
                }
                $message
                    ->setMsgObjectName($lModel->getApiType())
                    ->setMsgObjectId($lModel->getApiId())
                    ->setMsgSubject($subject)
                    ->setMsgBody($body)
                    ->setMsgStatus(\FreeFW\Model\Message::STATUS_WAITING)
                    ->setMsgType(\FreeFW\Model\Message::TYPE_EMAIL)
                    ->setLangId($p_lang_id)
                    ->setReplyTo($oneEmail->getEmailReplyTo())
                    ->setFrom($oneEmail->getEmailFrom(), $oneEmail->getEmailFromName())
                ;
                $bcc = explode(',', $oneEmail->getEmailBcc());
                foreach ($bcc as $oneCourriel) {
                    if (trim($oneCourriel) != '') {
                        $message->addBCC($oneCourriel);
                    }
                }
                if ($oneVersion->getEmaillPj1()) {
                    $cfg  = $this->getAppConfig();
                    $dir  = $cfg->get('ged:dir');
                    $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
                    $filename = $bDir . '/' . uniqid(true);
                    file_put_contents($filename, $oneVersion->getEmaillPj1());
                    $message->addAttachment($filename, $oneVersion->getEmaillPj1Name());
                }
                if ($oneVersion->getEmaillPj2()) {
                    $cfg  = $this->getAppConfig();
                    $dir  = $cfg->get('ged:dir');
                    $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
                    $filename = $bDir . '/' . uniqid(true);
                    file_put_contents($filename, $oneVersion->getEmaillPj2());
                    $message->addAttachment($filename, $oneVersion->getEmaillPj2Name());
                }
            }
        }
        return $message;
    }

    /**
     * Find email by code and lang
     *
     * @param string $p_code
     * @param number $p_lang_id
     *
     * @return \FreeFW\Core\StorageModel
     */
    public function getEmail($p_code, $p_lang_id = null)
    {
        /**
         * @var \FreeFW\Model\Email $email
         */
        $email = \FreeFW\Model\Email::findFirst(
            [
                'email_code' => $p_code,
                'lang_id'    => $p_lang_id,
            ]
        );
        /**
         * @var \FreeFW\Model\EmailLang $emailLang
         */
        $emailLang = null;
        if ($email) {
            $emailLang = \FreeFW\Model\EmailLang::findFirst(
                [
                    'email_id' => $email->getEmailId(),
                    'lang_id'  => $p_lang_id
                ]
            );
            if (!$emailLang) {
                $emailLang = \FreeFW\Model\EmailLang::findFirst(
                    [
                        'email_id' => $email->getEmailId(),
                        'lang_id'  => $email->getLangId()
                    ]
                );
            }
        }
        $result = null;
        if ($emailLang) {
            $result = new \FreeFW\Mail\Email();
            $result
                ->setSubject($emailLang->getEmaillSubject())
                ->setHtmlBody($emailLang->getEmaillBody())
                ->setFrom($email->getEmailFrom(), $email->getEmailFromName())
                ->setReplyTo($email->getEmailReplyTo())
            ;
        }
        // @todo : en by default...
        return $result;
    }
}
