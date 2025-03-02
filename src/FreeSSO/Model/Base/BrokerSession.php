<?php
namespace FreeSSO\Model\Base;

/**
 * BrokerSession
 *
 * @author jeromeklam
 */
abstract class BrokerSession extends \FreeSSO\Model\StorageModel\BrokerSession
{

    protected $brs_id = 0;
    protected $brk_key = null;
    protected $brs_token = null;
    protected $brs_session_id = null;
    protected $brs_client_address = null;
    protected $brs_date_created = null;
    protected $brs_end = null;
    protected $sess_id = null;
}
