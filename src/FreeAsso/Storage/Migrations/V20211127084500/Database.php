<?php
namespace FreeAsso\Storage\Migrations\V20211127084500;

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
