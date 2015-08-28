<?php

namespace Koine\DelayedCache;

/**
 * Koine\DelayedCache\DelayedCacheAwareTrait
 */
trait DelayedCacheAwareTrait
{
    private $delayedCache;

    /**
     * @param DelayedCache $cache
     *
     * @return self
     */
    public function setDelayedCache(DelayedCache $cache)
    {
        $this->delayedCache = $cache;
        return $this;
    }

    /**
     * @return DelayedCache
     */
    public function getDelayedCache()
    {
        return $this->delayedCache;
    }
}
