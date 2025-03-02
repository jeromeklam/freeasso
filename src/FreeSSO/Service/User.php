<?php
namespace FreeSSO\Service;

/**
 *
 * @author jeromeklam
 *
 */
class User extends \FreeFW\Core\Service
{

    /**
     * Send email to user
     *
     * @param \FreeSSO\Model\User    $p_user
     * @param string                 $p_event_name
     * @param \FreeFW\Model\Automate $p_automate
     *
     * @return boolean
     */
    public function notification(\FreeSSO\Model\User $p_user, $p_event_name, \FreeFW\Model\Automate $p_automate)
    {
        if ($p_user->getUserEmail() != '') {
            /**
             * @var \FreeFW\Service\Email
             */
            $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
            $emailId = $p_automate->getEmailId();
            if (!$emailId) {
                $emailId = $p_automate->getAutoParam('email_id', 0);
            }
            if ($emailId) {
                $filters = [
                    'email_id' => $emailId
                ];
            } else {
                $filters = [
                    'email_code' => 'CLIENT'
                ];
            }
            if ($p_automate->getGrpId()) {
                $filters = [
                    'grp_id' => $p_automate->getGrpId()
                ];
            }
            /**
             *
             * @var \FreeFW\Model\Message $message
             */
            $message = $emailService->getEmailAsMessage($filters, $p_user->getLangId(), $p_user);
            if ($message) {
                $message
                    ->addDest($p_user->getUserEmail())
                    ->setDestId($p_user->getUserId())
                ;
                return $message->create();
            }
        } else {
            // Add notofication for manual send...
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifObjectName('FreeSSO_User')
                ->setNotifObjectId($p_user->getUserId())
                ->setNotifSubject($p_automate->getAutoName() . ' : ' . $p_user->getUserLogin())
                ->setNotifCode('USER_WITHOUT_EMAIL')
                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ;
            return $notification->create();
        }
        return true;
    }
}
