<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Session
 *
 * @author jeromeklam
 */
class Session extends \FreeAsso\Model\Base\Session
{

    /**
     * Comportement
     */
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Status
     * @var string
     */
    const STATUS_OPEN       = 'OPEN';
    const STATUS_CLOSED     = 'CLOSED';
    const STATUS_VALIDATION = 'VALIDATION';

    /**
     * Type
     * @var string
     */
    const TYPE_STANDARD   = 'STANDARD';
    const TYPE_CORRECTION = 'CORRECTION';

    /**
     * Verification
     * @var string
     */
    const VERIF_NONE     = 'NONE';
    const VERIF_DONE     = 'DONE';
    const VERIF_CLEANING = 'CLEANING';
    const VERIF_PENDING  = 'PENDING';
    const VERIF_ERROR    = 'ERROR';

    /**
     * factory
     * @var array
     */
    protected static $factory = [];

    /**
     * Cache
     * @var array
     */
    protected static $cache = [];

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sess_id     = 0;
        $this->brk_id      = 0;
        $this->sess_status = self::STATUS_OPEN;
        $this->sess_type   = self::TYPE_STANDARD;
        return $this;
    }

    /**
     * Get or create
     *
     * @param int $p_year
     * @param int $p_month
     * @param int $p_grp_id
     * 
     * @return \FreeAsso\Model\Session
     */
    public static function getFactory(int $p_year, int $p_month = null, $p_grp_id = null)
    {
        $grpId = $p_grp_id;
        if (!$grpId) {
            /**
             * @var \FreeFW\Interfaces\SSOInterface $sso
             */
            $sso   = \FreeFW\DI\DI::getShared('sso');
            $group = $sso->getUserGroup();
            if ($group) {
                $grpId = $group->getGrpId();
            } else {
                $grpId = 1;
            }
        }
        //
        $key = $p_year . '_' . $p_month . '_' . $grpId;
        if (!isset(self::$factory[$key])) {
            $session = \FreeAsso\Model\Session::findFirst(
                [
                    'sess_year'  => $p_year,
                    'sess_month' => $p_month,
                    'grp_id'     => $grpId
                ]
            );
            if (!$session) {
                if ($p_month) {
                    $name = $p_year + '/' . str_pad($p_month, 2, '0', \STR_PAD_LEFT);
                } else {
                    $name = $p_year;
                }
                $session = new \FreeAsso\Model\Session();
                $session
                    ->setSessName($name)
                    ->setSessExercice($p_year)
                    ->setSessYear($p_year)
                    ->setSessMonth($p_month)
                    ->setSessStatus(self::STATUS_OPEN)
                    ->setSessType(self::TYPE_STANDARD)
                    ->setGrpId($grpId)
                ;
                $session->create();
            }
            self::$factory[$key] = $session;
        }
        return self::$factory[$key];
    }

    /**
     * Find Session
     *
     * @param \DateTime $p_date
     * @param int       $p_grp_id
     * @param boolean   $p_strict
     * 
     * @return \FreeAsso\Model\Session
     */
    public static function findSession($p_date, $p_grp_id = null, $p_strict = true)
    {
        $grp_id = $p_grp_id;
        if ($p_date && $p_date instanceof \DateTime) {
            if (!$grp_id) {
                /**
                 * @var \FreeSSO\Server $sso
                 */
                $sso   = \FreeFW\DI\DI::getShared('sso');
                $group = $sso->getUserGroup();
                if ($group) {
                    $grp_id = $group->getGrpId();
                }
            }
            $myRealTs = clone($p_date);
            $year     = date('Y');
            $month    = date('m');
            if ($myRealTs) {
                $year  = $myRealTs->format('Y');
                $month = $myRealTs->format('m');
            }
            $key = $grp_id . '##' . $year . '##' . $month;
            if (isset(self::$cache[$key])) {
                return self::$cache[$key];
            }
            $crits = [
                'sess_year'  => intval($year),
                'sess_month' => intval($month),
                'grp_id'     => $grp_id
            ];
            if ($p_strict) {
                $crits['sess_type'] = \FreeAsso\Model\Session::TYPE_STANDARD;
            }
            $session = \FreeAsso\Model\Session::findFirst($crits);
            if ($session) {
                self::$cache[$key] = $session;
                return $session;
            } else {
                $crits = [
                    'sess_year' => intval($year),
                    'grp_id'    => $grp_id
                ];
                if ($p_strict) {
                    $crits['sess_type'] = \FreeAsso\Model\Session::TYPE_STANDARD;
                }
                $session = \FreeAsso\Model\Session::findFirst($crits);
                if ($session) {
                    self::$cache[$key] = $session;
                    return $session;
                }
            }
            self::$cache[$key] = null;
        }
        return null;
    }
}
