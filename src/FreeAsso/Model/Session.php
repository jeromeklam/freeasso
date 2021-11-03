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
     * factory
     * @var array
     */
    protected static $factory = [];

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
     * 
     * @return \FreeAsso\Model\Session
     */
    public static function getFactory(int $p_year, int $p_month = null)
    {
        $key = $p_year + '_' . $p_month;
        if (!isset(self::$factory[$key])) {
            $session = \FreeAsso\Model\Session::findFirst(
                [
                    'sess_year'  => $p_year,
                    'sess_month' => $p_month,
                ]
            );
            if ($session) {
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
                ;
                $session->create();
            }
            self::$factory[$key] = $session;
        }
        return self::$factory[$key];
    }
}
