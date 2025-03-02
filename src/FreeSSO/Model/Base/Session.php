<?php
namespace FreeSSO\Model\Base;

/**
 * Session
 *
 * @author jeromeklam
 */
abstract class Session extends \FreeSSO\Model\StorageModel\Session
{

    protected $sess_id = 0;
    protected $user_id = null;
    protected $sess_start = null;
    protected $sess_end = null;
    protected $sess_touch = null;
    protected $sess_content = null;
    protected $sess_client_addr = null;
}
