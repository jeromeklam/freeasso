<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * SiteType
 *
 * @author jeromeklam
 */
class SiteType extends \FreeAsso\Model\Base\SiteType implements
\FreeFW\Interfaces\ApiResponseInterface
{
    
    /**
     * Datas
     * @var \FreeFW\Model\ResultSet
     */
    protected $site_type_datas = null;
    
    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sitt_id   = 0;
        $this->brk_id    = 0;
        $this->sitt_name = '';
        return $this;
    }
    
    /**
     * Get relationships
     *
     * @return array[]
     */
    public static function getRelationships()
    {
        return [
            'site_type_datas' => [
                'model' => 'FreeAsso::Model::SiteTypeData',
                'field' => 'sitt_id',
                'type'  => \FreeFW\Model\Query::JOIN_LEFT
            ]
        ];
    }
    
    /**
     * Default site datas
     *
     * @return \FreeFW\Model\ResultSet
     */
    public function getSiteTypeDatas()
    {
        if ($this->site_type_datas === null) {
            $this->site_type_datas = \FreeAsso\Model\SiteTypeData::find(
                [
                    'sitt_id' => $this->sitt_id
                ]
            );
        }
        return $this->site_type_datas;
    }
}
