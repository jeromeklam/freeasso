<?php
namespace FreeAsso\Model\Base;

/**
 * Contract
 *
 * @author jeromeklam
 */
abstract class Contract extends \FreeAsso\Model\StorageModel\Contract
{

    /**
     * ct_id
     * @var int
     */
    protected $ct_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * ct_code
     * @var string
     */
    protected $ct_code = null;

    /**
     * site_id
     * @var int
     */
    protected $site_id = null;

    /**
     * ct_from
     * @var mixed
     */
    protected $ct_from = null;

    /**
     * ct_to
     * @var mixed
     */
    protected $ct_to = null;

    /**
     * ct_duration
     * @var string
     */
    protected $ct_duration = null;

    /**
     * ct_install_amount
     * @var mixed
     */
    protected $ct_install_amount = null;

    /**
     * ct_recur_amount
     * @var mixed
     */
    protected $ct_recur_amount = null;

    /**
     * ct_address_1
     * @var string
     */
    protected $ct_address_1 = null;

    /**
     * ct_address_2
     * @var string
     */
    protected $ct_address_2 = null;

    /**
     * ct_address_3
     * @var string
     */
    protected $ct_address_3 = null;

    /**
     * ct_cp
     * @var string
     */
    protected $ct_cp = null;

    /**
     * ct_town
     * @var string
     */
    protected $ct_town = null;

    /**
     * cnty_id
     * @var int
     */
    protected $cnty_id = null;

    /**
     * ctx1_cli_id
     * @var int
     */
    protected $ctx1_cli_id = null;

    /**
     * ctx2_cli_id
     * @var int
     */
    protected $ctx2_cli_id = null;

    /**
     * Set ct_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtId($p_value)
    {
        $this->ct_id = $p_value;
        return $this;
    }

    /**
     * Get ct_id
     *
     * @return int
     */
    public function getCtId()
    {
        return $this->ct_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Contract
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
     * Set ct_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtCode($p_value)
    {
        $this->ct_code = $p_value;
        return $this;
    }

    /**
     * Get ct_code
     *
     * @return string
     */
    public function getCtCode()
    {
        return $this->ct_code;
    }

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setSiteId($p_value)
    {
        $this->site_id = $p_value;
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
     * Set ct_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtFrom($p_value)
    {
        $this->ct_from = $p_value;
        return $this;
    }

    /**
     * Get ct_from
     *
     * @return mixed
     */
    public function getCtFrom()
    {
        return $this->ct_from;
    }

    /**
     * Set ct_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtTo($p_value)
    {
        $this->ct_to = $p_value;
        return $this;
    }

    /**
     * Get ct_to
     *
     * @return mixed
     */
    public function getCtTo()
    {
        return $this->ct_to;
    }

    /**
     * Set ct_duration
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtDuration($p_value)
    {
        $this->ct_duration = $p_value;
        return $this;
    }

    /**
     * Get ct_duration
     *
     * @return string
     */
    public function getCtDuration()
    {
        return $this->ct_duration;
    }

    /**
     * Set ct_install_amount
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtInstallAmount($p_value)
    {
        $this->ct_install_amount = $p_value;
        return $this;
    }

    /**
     * Get ct_install_amount
     *
     * @return mixed
     */
    public function getCtInstallAmount()
    {
        return $this->ct_install_amount;
    }

    /**
     * Set ct_recur_amount
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtRecurAmount($p_value)
    {
        $this->ct_recur_amount = $p_value;
        return $this;
    }

    /**
     * Get ct_recur_amount
     *
     * @return mixed
     */
    public function getCtRecurAmount()
    {
        return $this->ct_recur_amount;
    }

    /**
     * Set ct_address_1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtAddress_1($p_value)
    {
        $this->ct_address_1 = $p_value;
        return $this;
    }

    /**
     * Get ct_address_1
     *
     * @return string
     */
    public function getCtAddress_1()
    {
        return $this->ct_address_1;
    }

    /**
     * Set ct_address_2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtAddress_2($p_value)
    {
        $this->ct_address_2 = $p_value;
        return $this;
    }

    /**
     * Get ct_address_2
     *
     * @return string
     */
    public function getCtAddress_2()
    {
        return $this->ct_address_2;
    }

    /**
     * Set ct_address_3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtAddress_3($p_value)
    {
        $this->ct_address_3 = $p_value;
        return $this;
    }

    /**
     * Get ct_address_3
     *
     * @return string
     */
    public function getCtAddress_3()
    {
        return $this->ct_address_3;
    }

    /**
     * Set ct_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtCp($p_value)
    {
        $this->ct_cp = $p_value;
        return $this;
    }

    /**
     * Get ct_cp
     *
     * @return string
     */
    public function getCtCp()
    {
        return $this->ct_cp;
    }

    /**
     * Set ct_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtTown($p_value)
    {
        $this->ct_town = $p_value;
        return $this;
    }

    /**
     * Get ct_town
     *
     * @return string
     */
    public function getCtTown()
    {
        return $this->ct_town;
    }

    /**
     * Set cnty_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCntyId($p_value)
    {
        $this->cnty_id = $p_value;
        return $this;
    }

    /**
     * Get cnty_id
     *
     * @return int
     */
    public function getCntyId()
    {
        return $this->cnty_id;
    }

    /**
     * Set ctx1_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtx1CliId($p_value)
    {
        $this->ctx1_cli_id = $p_value;
        return $this;
    }

    /**
     * Get ctx1_cli_id
     *
     * @return int
     */
    public function getCtx1CliId()
    {
        return $this->ctx1_cli_id;
    }

    /**
     * Set ctx2_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Contract
     */
    public function setCtx2CliId($p_value)
    {
        $this->ctx2_cli_id = $p_value;
        return $this;
    }

    /**
     * Get ctx2_cli_id
     *
     * @return int
     */
    public function getCtx2CliId()
    {
        return $this->ctx2_cli_id;
    }
}
