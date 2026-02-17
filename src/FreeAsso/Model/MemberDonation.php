<?php

namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Movement
 *
 * @author jeromeklam
 */
class MemberDonation
{

    use \FreeFW\Behavior\LlmAwareTrait;

    public $don_id = null;
    public $don_ts = null;
    public $don_mnt = null;
    public $don_money = null;
    public $don_status = null;
    public $cau_id = null;
    public $cau_name = null;
}