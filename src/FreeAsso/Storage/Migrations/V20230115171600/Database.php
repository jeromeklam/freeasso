<?php
namespace FreeAsso\Storage\Migrations\V20230115171600;

use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneClassPerFileSniff;

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
        $clients = \FreeAsso\Model\Client::find([]);
        /**
         * @var \FreeAsso\Model\Client $oneClient
         */
        foreach ($clients as $oneClient) {
            $parts = \FreeFW\Tools\Address::splitStreet($oneClient->getCliAddress1());
            $oneClient->setCliStreetNum($parts['number']);
            $oneClient->setCliStreetName($parts['street']);
            $oneClient->save();
        }
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
