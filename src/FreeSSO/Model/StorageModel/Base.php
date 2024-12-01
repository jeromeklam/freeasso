<?php
namespace FreeSSO\Model\StorageModel;

use FreeFW\Core\Model;
use FreeFW\Core\StorageModel;

/**
 * Cause
 *
 * @author jeromeklam
 */
abstract class Base extends \FreeFW\Core\StorageModel
{

    /**
     * Add to queue, websocket, ?
     *
     * @return boolean
     */
    public function forwardStorageEvent()
    {
        return true;
    }
}
