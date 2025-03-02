<?php
namespace FreeAsso\Model\Base;

/**
 * ContractMediaBlob
 *
 * @author jeromeklam
 */
abstract class ContractMediaBlob extends \FreeAsso\Model\StorageModel\ContractMediaBlob
{

    /**
     * ct_id
     * @var int
     */
    protected $ct_id = null;

    /**
     * blob
     * @var mixed
     */
    protected $blob = null;

    /**
     * title
     * @var string
     */
    protected $title = null;

    /**
     * desc
     * @var string
     */
    protected $desc = null;

    /**
     * Set ct_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ContractMediaBlob
     */
    public function setCtId($p_value)
    {
        $this->ct_id = $p_value;
        return $this;
    }

    /**
     * Get site_id
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->site_id;
    }

    /**
     * Set blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMediaBlob
     */
    public function setBlob($p_value)
    {
        $this->blob = $p_value;
        return $this;
    }

    /**
     * Get blob
     *
     * @return mixed
     */
    public function getBlob()
    {
        return $this->blob;
    }

    /**
     * Set title
     *
     * @param string $p_title
     *
     * @return \FreeAsso\Model\ContractMediaBlob
     */
    public function setTitle($p_title)
    {
        $this->title = $p_title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set desc
     *
     * @param string $p_desc
     *
     * @return \FreeAsso\Model\ContractMediaBlob
     */
    public function setDesc($p_desc)
    {
        $this->desc = $p_desc;
        return $this;
    }

    /**
     * Get desc
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }
}
