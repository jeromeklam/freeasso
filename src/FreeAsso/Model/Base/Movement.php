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
     * move_from_site_id
     * @var int
     */
    protected $move_from_site_id = null;

    /**
     * move_to_site_id
     * @var int
     */
    protected $move_to_site_id = null;

    /**
     * move_tr_name
     * @var string
     */
    protected $move_tr_name = null;

    /**
     * move_tr_num
     * @var string
     */
    protected $move_tr_num = null;

    /**
     * move_tr_num2
     * @var string
     */
    protected $move_tr_num2 = null;

    /**
     * move_from
     * @var mixed
     */
    protected $move_from = null;

    /**
     * move_from_empty
     * @var bool
     */
    protected $move_from_empty = null;

    /**
     * move_from_type
     * @var string
     */
    protected $move_from_type = null;

    /**
     * move_from_cli_id
     * @var int
     */
    protected $move_from_cli_id = null;

    /**
     * move_from_num
     * @var string
     */
    protected $move_from_num = null;

    /**
     * move_from_name
     * @var string
     */
    protected $move_from_name = null;

    /**
     * move_from_address
     * @var string
     */
    protected $move_from_address = null;

    /**
     * move_from_cp
     * @var string
     */
    protected $move_from_cp = null;

    /**
     * move_from_town
     * @var string
     */
    protected $move_from_town = null;

    /**
     * move_from_number_1
     * @var int
     */
    protected $move_from_number_1 = null;

    /**
     * move_from_number_2
     * @var int
     */
    protected $move_from_number_2 = null;

    /**
     * move_from_number_3
     * @var int
     */
    protected $move_from_number_3 = null;

    /**
     * move_from_number_4
     * @var int
     */
    protected $move_from_number_4 = null;

    /**
     * move_from_number_5
     * @var int
     */
    protected $move_from_number_5 = null;

    /**
     * move_from_number_6
     * @var int
     */
    protected $move_from_number_6 = null;

    /**
     * move_to
     * @var mixed
     */
    protected $move_to = null;

    /**
     * move_to_empty
     * @var bool
     */
    protected $move_to_empty = null;

    /**
     * move_to_type
     * @var string
     */
    protected $move_to_type = null;

    /**
     * move_to_cli_id
     * @var int
     */
    protected $move_to_cli_id = null;

    /**
     * move_to_num
     * @var string
     */
    protected $move_to_num = null;

    /**
     * move_to_name
     * @var string
     */
    protected $move_to_name = null;

    /**
     * move_to_address
     * @var string
     */
    protected $move_to_address = null;

    /**
     * move_to_cp
     * @var string
     */
    protected $move_to_cp = null;

    /**
     * move_to_town
     * @var string
     */
    protected $move_to_town = null;

    /**
     * move_to_number_1
     * @var int
     */
    protected $move_to_number_1 = null;

    /**
     * move_to_number_2
     * @var int
     */
    protected $move_to_number_2 = null;

    /**
     * move_to_number_3
     * @var int
     */
    protected $move_to_number_3 = null;

    /**
     * move_to_number_4
     * @var int
     */
    protected $move_to_number_4 = null;

    /**
     * move_to_number_5
     * @var int
     */
    protected $move_to_number_5 = null;

    /**
     * move_to_number_6
     * @var int
     */
    protected $move_to_number_6 = null;

    /**
     * move_group_name_1
     * @var string
     */
    protected $move_group_name_1 = null;

    /**
     * move_group_num_1
     * @var int
     */
    protected $move_group_num_1 = null;

    /**
     * move_group_name_2
     * @var string
     */
    protected $move_group_name_2 = null;

    /**
     * move_group_num_2
     * @var int
     */
    protected $move_group_num_2 = null;

    /**
     * move_group_name_3
     * @var string
     */
    protected $move_group_name_3 = null;

    /**
     * move_group_num_3
     * @var int
     */
    protected $move_group_num_3 = null;

    /**
     * move_group_name_4
     * @var string
     */
    protected $move_group_name_4 = null;

    /**
     * move_group_num_4
     * @var int
     */
    protected $move_group_num_4 = null;

    /**
     * move_desc
     * @var mixed
     */
    protected $move_desc = null;

    /**
     * move_blob
     * @var mixed
     */
    protected $move_blob = null;

    /**
     * move_type
     * @var string
     */
    protected $move_type = null;

    /**
     * move_status
     * @var string
     */
    protected $move_status = null;

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
     * Set move_from_site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromSiteId($p_value)
    {
        $this->move_from_site_id = $p_value;
        return $this;
    }

    /**
     * Get move_from_site_id
     *
     * @return int
     */
    public function getMoveFromSiteId()
    {
        return $this->move_from_site_id;
    }

    /**
     * Set move_to_site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToSiteId($p_value)
    {
        $this->move_to_site_id = $p_value;
        return $this;
    }

    /**
     * Get move_to_site_id
     *
     * @return int
     */
    public function getMoveToSiteId()
    {
        return $this->move_to_site_id;
    }

    /**
     * Set move_tr_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveTrName($p_value)
    {
        $this->move_tr_name = $p_value;
        return $this;
    }

    /**
     * Get move_tr_name
     *
     * @return string
     */
    public function getMoveTrName()
    {
        return $this->move_tr_name;
    }

    /**
     * Set move_tr_num
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveTrNum($p_value)
    {
        $this->move_tr_num = $p_value;
        return $this;
    }

    /**
     * Get move_tr_num
     *
     * @return string
     */
    public function getMoveTrNum()
    {
        return $this->move_tr_num;
    }

    /**
     * Set move_tr_num2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveTrNum2($p_value)
    {
        $this->move_tr_num2 = $p_value;
        return $this;
    }

    /**
     * Get move_tr_num2
     *
     * @return string
     */
    public function getMoveTrNum2()
    {
        return $this->move_tr_num2;
    }

    /**
     * Set move_from
     *
     * @param mixed $p_value
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
     * @return mixed
     */
    public function getMoveFrom()
    {
        return $this->move_from;
    }

    /**
     * Set move_from_empty
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromEmpty($p_value)
    {
        $this->move_from_empty = $p_value;
        return $this;
    }

    /**
     * Get move_from_empty
     *
     * @return bool
     */
    public function getMoveFromEmpty()
    {
        return $this->move_from_empty;
    }

    /**
     * Set move_from_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromType($p_value)
    {
        $this->move_from_type = $p_value;
        return $this;
    }

    /**
     * Get move_from_type
     *
     * @return string
     */
    public function getMoveFromType()
    {
        return $this->move_from_type;
    }

    /**
     * Set move_from_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromCliId($p_value)
    {
        $this->move_from_cli_id = $p_value;
        return $this;
    }

    /**
     * Get move_from_cli_id
     *
     * @return int
     */
    public function getMoveFromCliId()
    {
        return $this->move_from_cli_id;
    }

    /**
     * Set move_from_num
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNum($p_value)
    {
        $this->move_from_num = $p_value;
        return $this;
    }

    /**
     * Get move_from_num
     *
     * @return string
     */
    public function getMoveFromNum()
    {
        return $this->move_from_num;
    }

    /**
     * Set move_from_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromName($p_value)
    {
        $this->move_from_name = $p_value;
        return $this;
    }

    /**
     * Get move_from_name
     *
     * @return string
     */
    public function getMoveFromName()
    {
        return $this->move_from_name;
    }

    /**
     * Set move_from_address
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromAddress($p_value)
    {
        $this->move_from_address = $p_value;
        return $this;
    }

    /**
     * Get move_from_address
     *
     * @return string
     */
    public function getMoveFromAddress()
    {
        return $this->move_from_address;
    }

    /**
     * Set move_from_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromCp($p_value)
    {
        $this->move_from_cp = $p_value;
        return $this;
    }

    /**
     * Get move_from_cp
     *
     * @return string
     */
    public function getMoveFromCp()
    {
        return $this->move_from_cp;
    }

    /**
     * Set move_from_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromTown($p_value)
    {
        $this->move_from_town = $p_value;
        return $this;
    }

    /**
     * Get move_from_town
     *
     * @return string
     */
    public function getMoveFromTown()
    {
        return $this->move_from_town;
    }

    /**
     * Set move_from_number_1
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNumber_1($p_value)
    {
        $this->move_from_number_1 = $p_value;
        return $this;
    }

    /**
     * Get move_from_number_1
     *
     * @return int
     */
    public function getMoveFromNumber_1()
    {
        return $this->move_from_number_1;
    }

    /**
     * Set move_from_number_2
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNumber_2($p_value)
    {
        $this->move_from_number_2 = $p_value;
        return $this;
    }

    /**
     * Get move_from_number_2
     *
     * @return int
     */
    public function getMoveFromNumber_2()
    {
        return $this->move_from_number_2;
    }

    /**
     * Set move_from_number_3
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNumber_3($p_value)
    {
        $this->move_from_number_3 = $p_value;
        return $this;
    }

    /**
     * Get move_from_number_3
     *
     * @return int
     */
    public function getMoveFromNumber_3()
    {
        return $this->move_from_number_3;
    }

    /**
     * Set move_from_number_4
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNumber_4($p_value)
    {
        $this->move_from_number_4 = $p_value;
        return $this;
    }

    /**
     * Get move_from_number_4
     *
     * @return int
     */
    public function getMoveFromNumber_4()
    {
        return $this->move_from_number_4;
    }

    /**
     * Set move_from_number_5
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNumber_5($p_value)
    {
        $this->move_from_number_5 = $p_value;
        return $this;
    }

    /**
     * Get move_from_number_5
     *
     * @return int
     */
    public function getMoveFromNumber_5()
    {
        return $this->move_from_number_5;
    }

    /**
     * Set move_from_number_6
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveFromNumber_6($p_value)
    {
        $this->move_from_number_6 = $p_value;
        return $this;
    }

    /**
     * Get move_from_number_6
     *
     * @return int
     */
    public function getMoveFromNumber_6()
    {
        return $this->move_from_number_6;
    }

    /**
     * Set move_to
     *
     * @param mixed $p_value
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
     * @return mixed
     */
    public function getMoveTo()
    {
        return $this->move_to;
    }

    /**
     * Set move_to_empty
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToEmpty($p_value)
    {
        $this->move_to_empty = $p_value;
        return $this;
    }

    /**
     * Get move_to_empty
     *
     * @return bool
     */
    public function getMoveToEmpty()
    {
        return $this->move_to_empty;
    }

    /**
     * Set move_to_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToType($p_value)
    {
        $this->move_to_type = $p_value;
        return $this;
    }

    /**
     * Get move_to_type
     *
     * @return string
     */
    public function getMoveToType()
    {
        return $this->move_to_type;
    }

    /**
     * Set move_to_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToCliId($p_value)
    {
        $this->move_to_cli_id = $p_value;
        return $this;
    }

    /**
     * Get move_to_cli_id
     *
     * @return int
     */
    public function getMoveToCliId()
    {
        return $this->move_to_cli_id;
    }

    /**
     * Set move_to_num
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNum($p_value)
    {
        $this->move_to_num = $p_value;
        return $this;
    }

    /**
     * Get move_to_num
     *
     * @return string
     */
    public function getMoveToNum()
    {
        return $this->move_to_num;
    }

    /**
     * Set move_to_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToName($p_value)
    {
        $this->move_to_name = $p_value;
        return $this;
    }

    /**
     * Get move_to_name
     *
     * @return string
     */
    public function getMoveToName()
    {
        return $this->move_to_name;
    }

    /**
     * Set move_to_address
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToAddress($p_value)
    {
        $this->move_to_address = $p_value;
        return $this;
    }

    /**
     * Get move_to_address
     *
     * @return string
     */
    public function getMoveToAddress()
    {
        return $this->move_to_address;
    }

    /**
     * Set move_to_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToCp($p_value)
    {
        $this->move_to_cp = $p_value;
        return $this;
    }

    /**
     * Get move_to_cp
     *
     * @return string
     */
    public function getMoveToCp()
    {
        return $this->move_to_cp;
    }

    /**
     * Set move_to_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToTown($p_value)
    {
        $this->move_to_town = $p_value;
        return $this;
    }

    /**
     * Get move_to_town
     *
     * @return string
     */
    public function getMoveToTown()
    {
        return $this->move_to_town;
    }

    /**
     * Set move_to_number_1
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNumber_1($p_value)
    {
        $this->move_to_number_1 = $p_value;
        return $this;
    }

    /**
     * Get move_to_number_1
     *
     * @return int
     */
    public function getMoveToNumber_1()
    {
        return $this->move_to_number_1;
    }

    /**
     * Set move_to_number_2
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNumber_2($p_value)
    {
        $this->move_to_number_2 = $p_value;
        return $this;
    }

    /**
     * Get move_to_number_2
     *
     * @return int
     */
    public function getMoveToNumber_2()
    {
        return $this->move_to_number_2;
    }

    /**
     * Set move_to_number_3
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNumber_3($p_value)
    {
        $this->move_to_number_3 = $p_value;
        return $this;
    }

    /**
     * Get move_to_number_3
     *
     * @return int
     */
    public function getMoveToNumber_3()
    {
        return $this->move_to_number_3;
    }

    /**
     * Set move_to_number_4
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNumber_4($p_value)
    {
        $this->move_to_number_4 = $p_value;
        return $this;
    }

    /**
     * Get move_to_number_4
     *
     * @return int
     */
    public function getMoveToNumber_4()
    {
        return $this->move_to_number_4;
    }

    /**
     * Set move_to_number_5
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNumber_5($p_value)
    {
        $this->move_to_number_5 = $p_value;
        return $this;
    }

    /**
     * Get move_to_number_5
     *
     * @return int
     */
    public function getMoveToNumber_5()
    {
        return $this->move_to_number_5;
    }

    /**
     * Set move_to_number_6
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveToNumber_6($p_value)
    {
        $this->move_to_number_6 = $p_value;
        return $this;
    }

    /**
     * Get move_to_number_6
     *
     * @return int
     */
    public function getMoveToNumber_6()
    {
        return $this->move_to_number_6;
    }

    /**
     * Set move_group_name_1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupName_1($p_value)
    {
        $this->move_group_name_1 = $p_value;
        return $this;
    }

    /**
     * Get move_group_name_1
     *
     * @return string
     */
    public function getMoveGroupName_1()
    {
        return $this->move_group_name_1;
    }

    /**
     * Set move_group_num_1
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupNum_1($p_value)
    {
        $this->move_group_num_1 = $p_value;
        return $this;
    }

    /**
     * Get move_group_num_1
     *
     * @return int
     */
    public function getMoveGroupNum_1()
    {
        return $this->move_group_num_1;
    }

    /**
     * Set move_group_name_2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupName_2($p_value)
    {
        $this->move_group_name_2 = $p_value;
        return $this;
    }

    /**
     * Get move_group_name_2
     *
     * @return string
     */
    public function getMoveGroupName_2()
    {
        return $this->move_group_name_2;
    }

    /**
     * Set move_group_num_2
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupNum_2($p_value)
    {
        $this->move_group_num_2 = $p_value;
        return $this;
    }

    /**
     * Get move_group_num_2
     *
     * @return int
     */
    public function getMoveGroupNum_2()
    {
        return $this->move_group_num_2;
    }

    /**
     * Set move_group_name_3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupName_3($p_value)
    {
        $this->move_group_name_3 = $p_value;
        return $this;
    }

    /**
     * Get move_group_name_3
     *
     * @return string
     */
    public function getMoveGroupName_3()
    {
        return $this->move_group_name_3;
    }

    /**
     * Set move_group_num_3
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupNum_3($p_value)
    {
        $this->move_group_num_3 = $p_value;
        return $this;
    }

    /**
     * Get move_group_num_3
     *
     * @return int
     */
    public function getMoveGroupNum_3()
    {
        return $this->move_group_num_3;
    }

    /**
     * Set move_group_name_4
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupName_4($p_value)
    {
        $this->move_group_name_4 = $p_value;
        return $this;
    }

    /**
     * Get move_group_name_4
     *
     * @return string
     */
    public function getMoveGroupName_4()
    {
        return $this->move_group_name_4;
    }

    /**
     * Set move_group_num_4
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveGroupNum_4($p_value)
    {
        $this->move_group_num_4 = $p_value;
        return $this;
    }

    /**
     * Get move_group_num_4
     *
     * @return int
     */
    public function getMoveGroupNum_4()
    {
        return $this->move_group_num_4;
    }

    /**
     * Set move_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveDesc($p_value)
    {
        $this->move_desc = $p_value;
        return $this;
    }

    /**
     * Get move_desc
     *
     * @return mixed
     */
    public function getMoveDesc()
    {
        return $this->move_desc;
    }

    /**
     * Set move_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveBlob($p_value)
    {
        $this->move_blob = $p_value;
        return $this;
    }

    /**
     * Get move_blob
     *
     * @return mixed
     */
    public function getMoveBlob()
    {
        return $this->move_blob;
    }

    /**
     * Set move_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMoveType($p_value)
    {
        $this->move_type = $p_value;
        return $this;
    }

    /**
     * Get move_type
     *
     * @return string
     */
    public function getMoveType()
    {
        return $this->move_type;
    }

    /**
     * Set move_status
     *
     * @param string $p_status
     *
     * @return \FreeAsso\Model\Base\Movement
     */
    public function setMoveStatus($p_status)
    {
        $this->move_status = $p_status;
        return $this;
    }

    /**
     * Get move_status
     *
     * @return string
     */
    public function getMoveStatus()
    {
        return $this->move_status;
    }
}
