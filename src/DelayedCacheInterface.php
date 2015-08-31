<?php

namespace Koine\DelayedCache;

use Closure;

/**
 * Koine\DelayedCache\DelayedCacheInterface
 */
interface DelayedCacheInterface
{
    /**
     * @param string  $key
     * @param Closure $closure
     *
     * @return self
     */
    public function setDelayedItem($key, Closure $closure);

    /**
     * @param string  $key
     * @param Closure $closure
     *
     * @return mixed
     */
    public function getCachedItem($key, Closure $closure);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function itemIsReady($key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function itemIsUnderConstruction($key);
}
