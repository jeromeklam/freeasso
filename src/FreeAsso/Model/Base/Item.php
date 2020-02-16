<?php
namespace FreeAsso\Model\Base;

/**
 * Item
 *
 * @author jeromeklam
 */
abstract class Item extends \FreeAsso\Model\StorageModel\Item
{

    /**
     * item_id
     * @var int
     */
    protected $item_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * item_name
     * @var string
     */
    protected $item_name = null;

    /**
     * item_code
     * @var string
     */
    protected $item_code = null;

    /**
     * item_barcode
     * @var string
     */
    protected $item_barcode = null;

    /**
     * item_from
     * @var string
     */
    protected $item_from = null;

    /**
     * item_to
     * @var string
     */
    protected $item_to = null;

    /**
     * item_desc
     * @var mixed
     */
    protected $item_desc = null;

    /**
     * item_stock
     * @var string
     */
    protected $item_stock = null;

    /**
     * item_type
     * @var string
     */
    protected $item_type = null;

    /**
     * item_mark
     * @var string
     */
    protected $item_mark = null;

    /**
     * item_color
     * @var string
     */
    protected $item_color = null;

    /**
     * item_weight
     * @var string
     */
    protected $item_weight = null;

    /**
     * item_width
     * @var string
     */
    protected $item_width = null;

    /**
     * item_height
     * @var string
     */
    protected $item_height = null;

    /**
     * item_depth
     * @var string
     */
    protected $item_depth = null;

    /**
     * item_dangerous
     * @var int
     */
    protected $item_dangerous = null;

    /**
     * item_qte
     * @var string
     */
    protected $item_qte = null;

    /**
     * item_min_qte
     * @var string
     */
    protected $item_min_qte = null;

    /**
     * item_disposition
     * @var mixed
     */
    protected $item_disposition = null;

    /**
     * item_sto_unit_id
     * @var int
     */
    protected $item_sto_unit_id = null;

    /**
     * item_sto_qte
     * @var string
     */
    protected $item_sto_qte = null;

    /**
     * item_content_unit_id
     * @var int
     */
    protected $item_content_unit_id = null;

    /**
     * item_content_qte
     * @var string
     */
    protected $item_content_qte = null;

    /**
     * fam_id
     * @var int
     */
    protected $fam_id = null;

    /**
     * item_order
     * @var string
     */
    protected $item_order = null;

    /**
     * default_provider_id
     * @var int
     */
    protected $default_provider_id = null;

    /**
     * Set item_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemId($p_value)
    {
        $this->item_id = $p_value;
        return $this;
    }

    /**
     * Get item_id
     *
     * @return int
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }

    /**
     * Get brk_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }

    /**
     * Set item_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemName($p_value)
    {
        $this->item_name = $p_value;
        return $this;
    }

    /**
     * Get item_name
     *
     * @return string
     */
    public function getItemName()
    {
        return $this->item_name;
    }

    /**
     * Set item_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemCode($p_value)
    {
        $this->item_code = $p_value;
        return $this;
    }

    /**
     * Get item_code
     *
     * @return string
     */
    public function getItemCode()
    {
        return $this->item_code;
    }

    /**
     * Set item_barcode
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemBarcode($p_value)
    {
        $this->item_barcode = $p_value;
        return $this;
    }

    /**
     * Get item_barcode
     *
     * @return string
     */
    public function getItemBarcode()
    {
        return $this->item_barcode;
    }

    /**
     * Set item_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemFrom($p_value)
    {
        $this->item_from = $p_value;
        return $this;
    }

    /**
     * Get item_from
     *
     * @return string
     */
    public function getItemFrom()
    {
        return $this->item_from;
    }

    /**
     * Set item_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemTo($p_value)
    {
        $this->item_to = $p_value;
        return $this;
    }

    /**
     * Get item_to
     *
     * @return string
     */
    public function getItemTo()
    {
        return $this->item_to;
    }

    /**
     * Set item_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemDesc($p_value)
    {
        $this->item_desc = $p_value;
        return $this;
    }

    /**
     * Get item_desc
     *
     * @return mixed
     */
    public function getItemDesc()
    {
        return $this->item_desc;
    }

    /**
     * Set item_stock
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemStock($p_value)
    {
        $this->item_stock = $p_value;
        return $this;
    }

    /**
     * Get item_stock
     *
     * @return string
     */
    public function getItemStock()
    {
        return $this->item_stock;
    }

    /**
     * Set item_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemType($p_value)
    {
        $this->item_type = $p_value;
        return $this;
    }

    /**
     * Get item_type
     *
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * Set item_mark
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemMark($p_value)
    {
        $this->item_mark = $p_value;
        return $this;
    }

    /**
     * Get item_mark
     *
     * @return string
     */
    public function getItemMark()
    {
        return $this->item_mark;
    }

    /**
     * Set item_color
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemColor($p_value)
    {
        $this->item_color = $p_value;
        return $this;
    }

    /**
     * Get item_color
     *
     * @return string
     */
    public function getItemColor()
    {
        return $this->item_color;
    }

    /**
     * Set item_weight
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemWeight($p_value)
    {
        $this->item_weight = $p_value;
        return $this;
    }

    /**
     * Get item_weight
     *
     * @return string
     */
    public function getItemWeight()
    {
        return $this->item_weight;
    }

    /**
     * Set item_width
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemWidth($p_value)
    {
        $this->item_width = $p_value;
        return $this;
    }

    /**
     * Get item_width
     *
     * @return string
     */
    public function getItemWidth()
    {
        return $this->item_width;
    }

    /**
     * Set item_height
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemHeight($p_value)
    {
        $this->item_height = $p_value;
        return $this;
    }

    /**
     * Get item_height
     *
     * @return string
     */
    public function getItemHeight()
    {
        return $this->item_height;
    }

    /**
     * Set item_depth
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemDepth($p_value)
    {
        $this->item_depth = $p_value;
        return $this;
    }

    /**
     * Get item_depth
     *
     * @return string
     */
    public function getItemDepth()
    {
        return $this->item_depth;
    }

    /**
     * Set item_dangerous
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemDangerous($p_value)
    {
        $this->item_dangerous = $p_value;
        return $this;
    }

    /**
     * Get item_dangerous
     *
     * @return int
     */
    public function getItemDangerous()
    {
        return $this->item_dangerous;
    }

    /**
     * Set item_qte
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemQte($p_value)
    {
        $this->item_qte = $p_value;
        return $this;
    }

    /**
     * Get item_qte
     *
     * @return string
     */
    public function getItemQte()
    {
        return $this->item_qte;
    }

    /**
     * Set item_min_qte
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemMinQte($p_value)
    {
        $this->item_min_qte = $p_value;
        return $this;
    }

    /**
     * Get item_min_qte
     *
     * @return string
     */
    public function getItemMinQte()
    {
        return $this->item_min_qte;
    }

    /**
     * Set item_disposition
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemDisposition($p_value)
    {
        $this->item_disposition = $p_value;
        return $this;
    }

    /**
     * Get item_disposition
     *
     * @return mixed
     */
    public function getItemDisposition()
    {
        return $this->item_disposition;
    }

    /**
     * Set item_sto_unit_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemStoUnitId($p_value)
    {
        $this->item_sto_unit_id = $p_value;
        return $this;
    }

    /**
     * Get item_sto_unit_id
     *
     * @return int
     */
    public function getItemStoUnitId()
    {
        return $this->item_sto_unit_id;
    }

    /**
     * Set item_sto_qte
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemStoQte($p_value)
    {
        $this->item_sto_qte = $p_value;
        return $this;
    }

    /**
     * Get item_sto_qte
     *
     * @return string
     */
    public function getItemStoQte()
    {
        return $this->item_sto_qte;
    }

    /**
     * Set item_content_unit_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemContentUnitId($p_value)
    {
        $this->item_content_unit_id = $p_value;
        return $this;
    }

    /**
     * Get item_content_unit_id
     *
     * @return int
     */
    public function getItemContentUnitId()
    {
        return $this->item_content_unit_id;
    }

    /**
     * Set item_content_qte
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemContentQte($p_value)
    {
        $this->item_content_qte = $p_value;
        return $this;
    }

    /**
     * Get item_content_qte
     *
     * @return string
     */
    public function getItemContentQte()
    {
        return $this->item_content_qte;
    }

    /**
     * Set fam_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setFamId($p_value)
    {
        $this->fam_id = $p_value;
        return $this;
    }

    /**
     * Get fam_id
     *
     * @return int
     */
    public function getFamId()
    {
        return $this->fam_id;
    }

    /**
     * Set item_order
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setItemOrder($p_value)
    {
        $this->item_order = $p_value;
        return $this;
    }

    /**
     * Get item_order
     *
     * @return string
     */
    public function getItemOrder()
    {
        return $this->item_order;
    }

    /**
     * Set default_provider_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Item
     */
    public function setDefaultProviderId($p_value)
    {
        $this->default_provider_id = $p_value;
        return $this;
    }

    /**
     * Get default_provider_id
     *
     * @return int
     */
    public function getDefaultProviderId()
    {
        return $this->default_provider_id;
    }
}
