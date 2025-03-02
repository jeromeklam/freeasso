<?php

namespace FreeAPI;

/**
 * API
 */
class Tools
{

    /**
     * Remove accent
     * 
     * @param string $p_string
     * 
     * @return string
     */
    public static function withoutAccent($p_string)
    {
        return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($p_string, ENT_QUOTES, 'UTF-8'));
    }
}
