<?php
namespace FreeAsso\Model\StorageModel;

/**
 * Cause
 *
 * @author jeromeklam
 */
abstract class Base extends \FreeFW\Core\StorageModel
{

    /**
     * Add to queue ?
     *
     * @return boolean
     */
    public function forwardStorageEvent()
    {
        return true;
    }
}
