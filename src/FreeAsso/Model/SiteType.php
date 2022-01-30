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
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

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
        $this->sitt_id       = 0;
        $this->brk_id        = 0;
        $this->sitt_name     = '';
        $this->sitt_string_1 = 0;
        $this->sitt_string_2 = 0;
        $this->sitt_string_3 = 0;
        $this->sitt_string_4 = 0;
        $this->sitt_string_5 = 0;
        $this->sitt_string_6 = 0;
        $this->sitt_string_7 = 0;
        $this->sitt_string_8 = 0;
        $this->sitt_bool_1   = 0;
        $this->sitt_bool_2   = 0;
        $this->sitt_bool_3   = 0;
        $this->sitt_bool_4   = 0;
        $this->sitt_date_1   = 0;
        $this->sitt_date_2   = 0;
        $this->sitt_date_3   = 0;
        $this->sitt_date_4   = 0;
        $this->sitt_text_1   = 0;
        $this->sitt_text_2   = 0;
        $this->sitt_text_3   = 0;
        $this->sitt_text_4   = 0;
        $this->sitt_number_1 = 0;
        $this->sitt_number_2 = 0;
        $this->sitt_number_3 = 0;
        $this->sitt_number_4 = 0;
        $this->sitt_number_5 = 0;
        $this->sitt_number_6 = 0;
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
