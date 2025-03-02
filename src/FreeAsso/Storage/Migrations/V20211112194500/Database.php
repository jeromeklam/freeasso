<?php
namespace FreeAsso\Storage\Migrations\V20211112194500;

/**
 *
 * @author jeromeklam
 *
 */
class Database extends \FreeFW\Storage\Migrations\AbstractMigration {

    /**
     *
     * @return bool
     */
    public function up() : bool
    {
        $this->sqlUp();
        $donations = \FreeAsso\Model\Donation::find(
            [
                'don_id' => [ \FreeFW\Storage\Storage::COND_LOWER_EQUAL => 1498026 ],
            ]
        );
        /**
         * @var \FreeAsso\Model\Donation $oneDonation
         */
        foreach ($donations as $oneDonation) {
            $update = false;
            $date1  = $oneDonation->getDonTs();
            $date2  = $oneDonation->getDonRealTs();
            if ($date1 != $date2) {
                $oneDonation->setDonRealTs($date1);
                $update = true;
            }
            $date    = \FreeFW\Tools\Date::mysqlToDatetime($oneDonation->getDonRealTs());
            $year    = $date->format('Y');
            $session = $oneDonation->getSession();
            if ($session->getSessYear() != $year) {
                $newSession = \FreeAsso\Model\Session::findFirst(['sess_year' => $year]);
                $oneDonation->setSessId($newSession->getSessId());
                $update = true;
            }
            if ($update) {
                $oneDonation->setDonDesc('Erreur de reprise');
                if (!$oneDonation->save()) {
                    var_dump($oneDonation->getErrors());
                }
            }
        }
        return true;
    }

    /**
     *
     * @return bool
     */
    public function down() : bool
    {
        return true;
    }
}
