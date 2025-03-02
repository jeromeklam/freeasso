<?php
namespace FreeSSO\Model;

use \FreeSSO\ErrorCodes as SsoErrors;

/**
 *
 * @author jeromeklam
 *
 */
class Error extends \FreeFW\Core\Model
{

    /**
     * Get new error from exception
     *
     * @param integer $p_status
     *
     * @param \Exception $p_ex
     *
     * @return \FreeFW\Model\Error
     */
    public static function getFromException($p_status, \Exception $p_ex)
    {
        $me = new \FreeFW\Model\Error();
        switch ($p_ex->getCode()) {
            case SsoErrors::ERROR_LOGIN_EXISTS:
            case SsoErrors::ERROR_LOGIN_NOTFOUND:
                $me->addError($p_ex->getCode(), $p_ex->getMessage(), $p_status, 'login');
                break;
            case SsoErrors::ERROR_PASSWORD_DIFFERENT:
            case SsoErrors::ERROR_PASSWORD_WRONG:
            case SsoErrors::ERROR_PASSWORD_EMPTY:
                $me->addError($p_ex->getCode(), $p_ex->getMessage(), $p_status, 'password');
                break;
            case SsoErrors::ERROR_OLD_PASSWORD_WRONG:
                $me->addError($p_ex->getCode(), $p_ex->getMessage(), $p_status, 'old_password');
                break;
            default:
                $me->addError($p_ex->getCode(), $p_ex->getMessage(), $p_status);
                break;
        }
        return $me;
    }
}
