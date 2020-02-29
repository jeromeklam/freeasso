<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Item
 *
 * @author jeromeklam
 */
class Item extends \FreeAsso\Model\Base\Item
{

    /**
     * Family
     * @var \FreeAsso\Model\Family
     */
    protected $family = null;

    /**
     * Stock unit
     * @var \FreeAsso\Model\Unit
     */
    protected $stock_unit = null;

    /**
     * Content unit
     * @var \FreeAsso\Model\Unit
     */
    protected $content_unit = null;

    /**
     * Default provider
     * @var \FreeAsso\Model\Client
     */
    protected $default_provider = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->item_id        = 0;
        $this->brk_id         = 0;
        $this->item_dangerous = false;
        return $this;
    }

    /**
     * Set family
     * 
     * @param \FreeAsso\Model\Family $p_family
     * 
     * @return \FreeAsso\Model\Item
     */
    public function setFamily($p_family)
    {
        $this->family = $p_family;
        return $this;
    }

    /**
     * Get family
     * 
     * @return \FreeAsso\Model\Family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set stock unit
     * 
     * @param \FreeAsso\Model\Unit $p_stock_unit
     * 
     * @return \FreeAsso\Model\Item
     */
    public function setStockUnit($p_stock_unit)
    {
        $this->stock_unit =$p_stock_unit;
        return $this;
    }

    /**
     * Get stock unit
     * 
     * @return \FreeAsso\Model\Unit
     */
    public function getStockUnit()
    {
        return $this->stock_unit;
    }

    /**
     * Set content unit
     *
     * @param \FreeAsso\Model\Unit $p_stock_unit
     *
     * @return \FreeAsso\Model\Item
     */
    public function setContentUnit($p_stock_unit)
    {
        $this->content_unit =$p_stock_unit;
        return $this;
    }

    /**
     * Get content unit
     *
     * @return \FreeAsso\Model\Unit
     */
    public function getContentUnit()
    {
        return $this->content_unit;
    }

    /**
     * Set default provider
     * 
     * @param \FreeAsso\Model\Client $p_default_provider
     * 
     * @return \FreeAsso\Model\Item
     */
    public function setDefaultProvider($p_default_provider)
    {
        $this->default_provider = $p_default_provider;
        return $this;
    }

    /**
     * Get default provider
     * 
     * @return \FreeAsso\Model\Client
     */
    public function getDefaultProvider()
    {
        return $this->default_provider;
    }
}
