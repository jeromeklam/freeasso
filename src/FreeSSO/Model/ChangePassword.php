<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * Signin
 *
 * @author jeromeklam
 */
class ChangePassword extends \FreeSSO\Model\Base\Signin
{

    /**
     * Prevent from saving history
     * @var bool
     */
    protected $no_history = true;
}
