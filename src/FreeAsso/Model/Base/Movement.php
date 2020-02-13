<?php
namespace FreeAsso\Model\Base;

/**
 * Movement
 *
 * @author jeromeklam
 */
abstract class Movement extends \FreeAsso\Model\StorageModel\Movement
{

    /**
     * move_id
     * @var int
     */
    protected $move_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * move_from
     * @var string
     */
    protected $move_from = null;

    /**
     * move_to
     * @var string
     */
    protected $move_to = null;

    /**
     * site_from_id
     * @var int
     */
    protected $site_from_id = null;

    /**
     * site_to_id
     * @var int
     */
    protected $site_to_id = null;

    /**
     * Set move_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveId($p_value)
    {
        $this->move_id = $p_value;
        return $this;
    }

    /**
     * Get move_id
     *
     * @return int
     */
    public function getMoveId()
    {
        return $this->move_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
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
     * Set move_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFrom($p_value)
    {
        $this->move_from = $p_value;
        return $this;
    }

    /**
     * Get move_from
     *
     * @return string
     */
    public function getMoveFrom()
    {
        return $this->move_from;
    }

    /**
     * Set move_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveTo($p_value)
    {
        $this->move_to = $p_value;
        return $this;
    }

    /**
     * Get move_to
     *
     * @return string
     */
    public function getMoveTo()
    {
        return $this->move_to;
    }

    /**
     * Set site_from_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setSiteFromId($p_value)
    {
        $this->site_from_id = $p_value;
        return $this;
    }

    /**
     * Get site_from_id
     *
     * @return int
     */
    public function getSiteFromId()
    {
        return $this->site_from_id;
    }

    /**
     * Set site_to_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setSiteToId($p_value)
    {
        $this->site_to_id = $p_value;
        return $this;
    }

    /**
     * Get site_to_id
     *
     * @return int
     */
    public function getSiteToId()
    {
        return $this->site_to_id;
    }
}
