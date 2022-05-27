<?php

namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Movement
 *
 * @author jeromeklam
 */
class Member extends \FreeFW\Core\Model
{

    public $mbr_id = null;
    public $mbr_firstname = null;
    public $mbr_lastname = null;
    public $mbr_address1 = null;
    public $mbr_address2 = null;
    public $mbr_address3 = null;
    public $mbr_zipcode = null;
    public $mbr_city = null;
    public $mbr_country = null;
    public $mbr_email = null;
    public $mbr_phone = null;
    public $mbr_langage = null;
    public $mbr_send_receipt = true;
}