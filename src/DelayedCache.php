<?php

namespace Koine\DelayedCache;

use Zend\Cache\Storage\StorageInterface;
use Closure;

/**
 * Koine\DelayedCache\DelayedCache
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class DelayedCache implements StorageInterface, DelayedCacheInterface
{
    use WaiterAwareTrait;

    const UNDER_CONSTRUCTION_PREFIX = 'Koine\DelayedCache\DelayedCache-';

    /** @var StorageInterface */
    private $storage;

    /** @var StorageInterface */
    private $loopWaitingTime;

    /**
     * @param StorageInterface $storage
     * @param int              $loopWaitingTime time in seconds to wait and reverify if cache is redy
     */
    public function __construct(StorageInterface $storage, $loopWaitingTime = 1)
    {
        $this->storage = $storage;
        $this->loopWaitingTime = $loopWaitingTime;
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

    /**
     * {@inheritdoc}
     */
    public function getItem($key, &$success = null, &$casToken = null)
    {
        return $this->storage->getItem($key, $success, $casToken);
    }

    public function getItems(array $keys)
    {
        return $this->storage->getItems($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem($key)
    {
        return $this->storage->hasItem($key);
    }

    public function hasItems(array $keys)
    {
        return $this->storage->hasItems($keys);
    }

    public function getMetadata($key)
    {
        return $this->storage->getMetadata($key);
    }

    public function getMetadatas(array $keys)
    {
        return $this->storage->getMetadatas($keys);
    }

    public function setItem($key, $value)
    {
        return $this->storage->setItem($key, $value);
    }

    public function setItems(array $keyValuePairs)
    {
        return $this->storage->setItems($keyValuePairs);
    }

    public function addItem($key, $value)
    {
        return $this->storage->addItem($key, $value);
    }

    public function addItems(array $keyValuePairs)
    {
        return $this->storage->addItems($keyValuePairs);
    }

    public function replaceItem($key, $value)
    {
        return $this->storage->replaceItem($key, $value);
    }

    public function replaceItems(array $keyValuePairs)
    {
        return $this->storage->replaceItems($keyValuePairs);
    }

    public function checkAndSetItem($token, $key, $value)
    {
        return $this->storage->checkAndSetItem($token, $key, $value);
    }

    public function touchItem($key)
    {
        return $this->storage->touchItem($key);
    }

    public function touchItems(array $keys)
    {
        return $this->storage->touchItems($keys);
    }

    public function removeItem($key)
    {
        return $this->storage->removeItem($key);
    }

    public function removeItems(array $keys)
    {
        return $this->storage->removeItems($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function incrementItem($key, $value)
    {
        return $this->storage->incrementItem($key, $value);
    }

    public function incrementItems(array $keyValuePairs)
    {
        return $this->storage->incrementItems($keyValuePairs);
    }

    /**
     * {@inheritdoc}
     */
    public function decrementItem($key, $value)
    {
        return $this->storage->decrementItem($key, $value);
    }

    public function decrementItems(array $keyValuePairs)
    {
        return $this->storage->decrementItems($keyValuePairs);
    }

    public function getCapabilities()
    {
        return $this->storage->getCapabilities();
    }

    public function setDelayedItem($key, Closure $closure)
    {
        $this->storage->setItem($this->getDelayedKey($key), 'under_construction');
        $this->storage->setItem($key, $closure());
        $this->storage->removeItem($this->getDelayedKey($key));

        return $this;
    }

    public function getCachedItem($key, Closure $closure)
    {
        if ($this->storage->hasItem($key)) {
            return $this->storage->getItem($key);
        }

        $delayedKey = $this->getDelayedKey($key);

        if ($this->storage->hasItem($delayedKey)) {
            while ($this->storage->hasItem($delayedKey)) {
                $this->getWaiter()->wait(1);
            }

            return $this->storage->getItem($key);
        }
    }

    public function itemIsReady($key)
    {
        throw new Exception('Not implemented');
    }

    public function itemIsUnderConstruction($key)
    {
        throw new Exception('Not implemented');
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function getDelayedKey($key)
    {
        return self::UNDER_CONSTRUCTION_PREFIX . $key;
    }
}
