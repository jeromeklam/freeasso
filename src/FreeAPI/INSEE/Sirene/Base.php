<?php

namespace FreeAPI\INSEE\Sirene;

/**
 * class Siren
 */
class Base
{

    /**
     * Constructor
     * 
     * @param array $p_data
     */
    public function __construct($p_data)
    {
        foreach ($p_data as $name => $value) {
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
    }

    /**
     * Convert to array
     * 
     * @return array
     */
    public function __toArray()
    {
        return get_object_vars($this);
    }
}
