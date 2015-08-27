<?php

namespace Koine\DelayedCache;

use Zend\Cache\Storage\StorageInterface;

/**
 * Koine\DelayedCache\DelayedCache
 */
class DelayedCache implements StorageInterface
{
    /** @var StorageInterface */
    private $storage;

    /**
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function setOptions($options)
    {
        $this->storage->setOptions($options);

        return $this;
    }

    public function getOptions()
    {
        return $this->storage->getOptions();
    }

    public function getItem($key, &$success = null, &$casToken = null)
    {
        return $this->storage->getItem($key, $success, $casToken);
    }

    public function getItems(array $keys)
    {
        throw new \Exception('Not implemented');
    }

    public function hasItem($key)
    {
        throw new \Exception('Not implemented');
    }

    public function hasItems(array $keys)
    {
        throw new \Exception('Not implemented');
    }

    public function getMetadata($key)
    {
        throw new \Exception('Not implemented');
    }

    public function getMetadatas(array $keys)
    {
        throw new \Exception('Not implemented');
    }

    public function setItem($key, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function setItems(array $keyValuePairs)
    {
        throw new \Exception('Not implemented');
    }

    public function addItem($key, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function addItems(array $keyValuePairs)
    {
        throw new \Exception('Not implemented');
    }

    public function replaceItem($key, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function replaceItems(array $keyValuePairs)
    {
        throw new \Exception('Not implemented');
    }

    public function checkAndSetItem($token, $key, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function touchItem($key)
    {
        throw new \Exception('Not implemented');
    }

    public function touchItems(array $keys)
    {
        throw new \Exception('Not implemented');
    }

    public function removeItem($key)
    {
        throw new \Exception('Not implemented');
    }

    public function removeItems(array $keys)
    {
        throw new \Exception('Not implemented');
    }

    public function incrementItem($key, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function incrementItems(array $keyValuePairs)
    {
        throw new \Exception('Not implemented');
    }

    public function decrementItem($key, $value)
    {
        throw new \Exception('Not implemented');
    }

    public function decrementItems(array $keyValuePairs)
    {
        throw new \Exception('Not implemented');
    }

    public function getCapabilities()
    {
        throw new \Exception('Not implemented');
    }
}
