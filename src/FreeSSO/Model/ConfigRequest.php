<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model
 *
 * @author jeromeklam
 */
class ConfigRequest extends \FreeFW\Core\Model
{

    /**
     * Config
     * @var string
     */
    protected $config = null;

    /**
     * Type
     * @var string
     */
    protected $config_type = null;

    /**
     * Set Config
     *
     * @param string $p_config
     *
     * @return \FreeSSO\Model\ConfigRequest
     */
    public function setConfig(string $p_config)
    {
        $this->config = $p_config;
        return $this;
    }

    /**
     * Get config
     *
     * @return string
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set type
     *
     * @param string $p_type
     *
     * @return \FreeSSO\Model\ConfigRequest
     */
    public function setConfigType(string $p_type)
    {
        $this->config_type = $p_type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getConfigType()
    {
        return $this->config_type;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::getProperties()
     */
    public static function getProperties()
    {
        return [
            'config' => [
                FFCST::PROPERTY_PRIVATE => 'config',
                FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
                FFCST::PROPERTY_OPTIONS => []
            ],
            'config_type' => [
                FFCST::PROPERTY_PRIVATE => 'config_type',
                FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
                FFCST::PROPERTY_OPTIONS => []
            ]
        ];
    }
}
