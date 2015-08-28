<?php

namespace Koine\DelayedCache;

/**
 * Koine\DelayedCache\DelayedCacheAwareInterface
 */
interface DelayedCacheAwareInterface
{
    /**
     * @param DelayedCache $cache
     *
     * @return self
     */
    public function setDelayedCache(DelayedCache $cache);

    /**
     * @return DelayedCache
     */
    public function getDelayedCache();
}
