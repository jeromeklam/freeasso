<?php
namespace FreeFW\Cache;

use \Psr\Cache\CacheItemInterface;
use \Psr\Cache\CacheItemPoolInterface;

/**
 *
 * @author jeromeklam
 *
 */
class FileCache implements CacheItemPoolInterface
{

    /**
     * @var CacheItemInterface[]
     */
    private $deferredStack = [];

    /**
     * Cache folder
     * @var string
     */
    private static $cache_folder = null;

    /**
     * Constructor
     *
     * @param string $p_dir
     */
    public function __construct($p_dir)
    {
        $this->setFolder($p_dir);
    }

    /**
     * Returns a Cache Item representing the specified key.
     *
     * This method must always return a CacheItemInterface object, even in case of
     * a cache miss. It MUST NOT return null.
     *
     * @param string $key
     *   The key for which to return the corresponding Cache Item.
     *
     * @throws InvalidArgumentException
     *   If the $key string is not a legal value a \Psr\Cache\InvalidArgumentException
     *   MUST be thrown.
     *
     * @return CacheItemInterface
     *   The corresponding Cache Item.
     */
    public function getItem(string $key): CacheItemInterface
    {
        $this->assertValidKey($key);
        if (isset($this->deferredStack[$key])) {
            return clone $this->deferredStack[$key];
        }
        $file = @file_get_contents($this->filenameFor($key));
        if (false !== $file) {
            return unserialize($file);
        }
        return new Item($key);
    }

    /**
     * Returns a traversable set of cache items.
     *
     * @param array $keys
     * An indexed array of keys of items to retrieve.
     *
     * @throws InvalidArgumentException
     *   If any of the keys in $keys are not a legal value a \Psr\Cache\InvalidArgumentException
     *   MUST be thrown.
     *
     * @return array|\Traversable
     *   A traversable collection of Cache Items keyed by the cache keys of
     *   each item. A Cache item will be returned for each key, even if that
     *   key is not found. However, if no keys are specified then an empty
     *   traversable MUST be returned instead.
     *
     * @todo performance tune to fetch all keys at once from driver
     */
    public function getItems(array $keys = []): iterable
    {
        $items = [];
        foreach ($keys as $key) {
            $items[$key] = $this->getItem($key);
        }
        return $items;
    }

    /**
     * Confirms if the cache contains specified cache item.
     *
     * Note: This method MAY avoid retrieving the cached value for performance reasons.
     * This could result in a race condition with CacheItemInterface::get(). To avoid
     * such situation use CacheItemInterface::isHit() instead.
     *
     * @param string $key
     *    The key for which to check existence.
     *
     * @throws InvalidArgumentException
     *   If the $key string is not a legal value a \Psr\Cache\InvalidArgumentException
     *   MUST be thrown.
     *
     * @return bool
     *  True if item exists in the cache, false otherwise.
     */
    public function hasItem(string $key): bool
    {
        $this->assertValidKey($key);
        $itemInDeferredNotExpired = isset($this->deferredStack[$key]) && $this->deferredStack[$key]->isHit();
        return $itemInDeferredNotExpired || file_exists($this->filenameFor($key));
    }

    /**
     * Deletes all items in the pool.
     *
     * @return bool
     *   True if the pool was successfully cleared. False if there was an error.
     */
    public function clear() : bool
    {
        $this->deferredStack = [];
        $result = true;
        foreach (glob($this->getFolder() . '/' . $this->getFilenamePrefix() . '*') as $filename) {
            $result = $result && unlink($filename);
        }
        return $result;
    }

    /**
     * Removes the item from the pool.
     *
     * @param string $key
     *   The key for which to delete
     *
     * @throws InvalidArgumentException
     *   If the $key string is not a legal value a \Psr\Cache\InvalidArgumentException
     *   MUST be thrown.
     *
     * @return bool
     *   True if the item was successfully removed. False if there was an error.
     */
    public function deleteItem(string $key) : bool
    {
        $keys = $this->findKeys($key);
        foreach ($keys as $oneKey) {
            $this->assertValidKey($oneKey);
            if (isset($this->deferredStack[$oneKey])) {
                unset($this->deferredStack[$oneKey]);
            }
            @unlink($this->filenameFor($oneKey));
        }
        return true;
    }

    /**
     * Removes multiple items from the pool.
     *
     * @param array $keys
     *   An array of keys that should be removed from the pool.
     * @throws InvalidArgumentException
     *   If any of the keys in $keys are not a legal value a \Psr\Cache\InvalidArgumentException
     *   MUST be thrown.
     *
     * @return bool
     *   True if the items were successfully removed. False if there was an error.
     */
    public function deleteItems(array $keys) : bool
    {
        $result = true;
        foreach ($keys as $key) {
            $result = $result && $this->deleteItem($key);
        }
        return $result;
    }

    /**
     * Persists a cache item immediately.
     *
     * @param CacheItemInterface $item
     *   The cache item to save.
     *
     * @return bool
     *   True if the item was successfully persisted. False if there was an error.
     */
    public function save(CacheItemInterface $item) : bool
    {
        if ( ! $item->isHit()) {
            return false;
        }
        $bytes = file_put_contents($this->filenameFor($item->getKey()), serialize($item));
        return (false !== $bytes);
    }

    /**
     * Sets a cache item to be persisted later.
     *
     * @param CacheItemInterface $item
     *   The cache item to save.
     *
     * @return bool
     *   False if the item could not be queued or if a commit was attempted and failed. True otherwise.
     */
    public function saveDeferred(CacheItemInterface $item) : bool
    {
        $this->deferredStack[$item->getKey()] = $item;
        return true;
    }

    /**
     * Persists any deferred cache items.
     *
     * @return bool
     *   True if all not-yet-saved items were successfully saved or there were none. False otherwise.
     */
    public function commit() : bool
    {
        $result = true;
        foreach ($this->deferredStack as $key => $item) {
            $result = $result && $this->save($item);
            unset($this->deferredStack[$key]);
        }
        return $result;
    }

    /**
     * Get Filename
     *
     * @param string $p_key
     *
     * @return string
     */
    private function filenameFor($p_key)
    {
        return $this->getFolder() . '/' . $this->getFilenamePrefix() . '.' . $p_key;
    }

    /**
     * Checks if a key is valid for APCu cache storage
     *
     * @param $p_key
     * @throws InvalidArgumentException
     */
    private function assertValidKey($p_key)
    {
        if ( ! Item::isValidKey($p_key)) {
            throw new \InvalidArgumentException('invalid key: ' . var_export($p_key, true));
        }
    }

    /**
     * Set folder
     *
     * @param string $p_folder
     */
    public static function setFolder($p_folder)
    {
        if (is_dir($p_folder)) {
            self::$cache_folder = $p_folder;
        }
    }

    /**
     * Get cache folder
     *
     * @return string
     */
    private function getFolder()
    {
        if (self::$cache_folder === null) {
            self::$cache_folder = sys_get_temp_dir();
        }
        return self::$cache_folder;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    private function getFilenamePrefix()
    {
        return APP_NAME . '-cache';
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->commit();
    }

    /**
     * All keys with wildcard, ....
     *
     * @return [string]
     */
    private function findKeys($p_wildcard)
    {
        if (strpos($p_wildcard, '*') !== false) {
            $keys    = [];
            $folder  = rtrim($this->getFolder(), '/');
            $prefix  = $this->getFilenamePrefix();
            $allKeys = glob($folder . '/' . $prefix . $p_wildcard);
            if (is_array($allKeys) && count($allKeys) > 0) {
                foreach ($allKeys as $oneKey) {
                    $keys[] = str_replace($prefix . '.', '', basename($oneKey));
                }
            } else {
                $keys[] = $p_wildcard;
            }
            return $keys;
        }
        return [$p_wildcard];
    }
}
