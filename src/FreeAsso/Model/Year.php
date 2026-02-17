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
    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * Get next number
     * 
     * @param int $p_year
     * @param int $p_grp_id
     * 
     * @return int | false
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

    /**
     * Get next attest
     * 
     * @param int $p_year
     * @param int $p_grp_id
     * 
     * @return int | false
     */
    public static function getNextAttest($p_year, $p_grp_id)
    {
        $model = \FreeAsso\Model\Year::findFirst(['year' => intval($p_year), 'grp_id' => intval($p_grp_id)]);
        if ($model) {
            $last = $model->getYearAttest();
            $last++;
            $model->setYearAttest($last);
            if ($model->save()) {
                return $last;
            }
        }
        return false;
    }
}
