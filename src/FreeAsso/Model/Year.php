<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Year
 *
 * @author jeromeklam
 */
class Year extends \FreeAsso\Model\Base\Year
{

    /**
     * Get next number
     */
    public static function getNextNumber($p_year, $p_grp_id)
    {
        $model = \FreeAsso\Model\Year::findFirst(['year' => intval($p_year), 'grp_id' => intval($p_grp_id)]);
        if ($model) {
            $last = $model->getYearNumber();
            $last++;
            $model->setYearNumber($last);
            if ($model->save()) {
                return $last;
            }
        }
        return false;
    }
}
