<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Receipt
 *
 * @author jeromeklam
 */
class Receipt extends \FreeAsso\Model\Base\Receipt
{

    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\ReceiptType;
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeFW\Model\Behaviour\Country;
    use \FreeFW\Model\Behaviour\File;
}
