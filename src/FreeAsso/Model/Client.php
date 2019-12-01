<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Client
 *
 * @author jeromeklam
 */
class Client extends \FreeAsso\Model\Base\Client implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cli_id     = 0;
        $this->brk_id     = 0;
        $this->clic_id    = 0;
        $this->clit_it    = '';
        $this->cli_active = 1;
        return $this;
    }
}
