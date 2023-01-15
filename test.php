<?php

function splitAdress($p_streetStr)
{
    $aMatch = array();
    $pattern = '#^([0-9]{1,5})([, ]*)(.*)$#';
    $matchResult = preg_match($pattern, $p_streetStr, $aMatch);
    if ($matchResult) {
        $street = (isset($aMatch[3])) ? $aMatch[3] : '';
        $number = (isset($aMatch[1])) ? $aMatch[1] : '';
        $numberAddition = '';
    } else {
        $pattern = '#^([\w[:punct:] ]+) ([0-9]{1,5})([\w[:punct:]\-/]*)$#';
        $matchResult = preg_match($pattern, $p_streetStr, $aMatch);
        if ($matchResult) {
            $street = (isset($aMatch[1])) ? $aMatch[1] : '';
            $number = (isset($aMatch[2])) ? $aMatch[2] : '';
            $numberAddition = (isset($aMatch[3])) ? $aMatch[3] : '';
        }
    }
    return array('street' => $street, 'number' => $number, 'numberAddition' => $numberAddition);
}

function Unaccent($string)
{
    return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
}

var_export(splitAdress('11rue de la Marne'));
var_export(splitAdress('11, rue de la Marne'));
var_export(splitAdress('11, bis rue de la Marne'));
var_export(splitAdress('11, bis, rue de la Marne'));
var_export(splitAdress('11 bis rue de la Marne'));
var_export(splitAdress('rue de la Marne, 11'));

$str = 'télévision';
echo Unaccent($str);