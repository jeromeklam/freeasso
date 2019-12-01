<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * SiteTypeData
 *
 * @author jeromeklam
 */
class SiteTypeData extends \FreeAsso\Model\Base\SiteTypeData implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Site type
     * @var \FreeAsso\Model\SiteType
     */
    protected $site_type = null;

    /**
     * Data
     * @var \FreeAsso\Model\Data
     */
    protected $data = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sittd_id = 0;
        $this->sitt_id  = 0;
        $this->data_id  = 0;
        return $this;
    }
}
