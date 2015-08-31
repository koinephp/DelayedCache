<?php

namespace Koine\DelayedCache;

use Closure;

/**
 * Koine\DalayedCache\Waiter
 */
class Waiter
{
    /**
     * @param int time
     *
     * @return self
     */
    public function wait($time)
    {
        // @codeCoverageIgnore
        sleep($time);
        return $this;
    }

    /**
     * @param Closure $closure
     *
     * @return mixed
     */
    public function waitFor(Closure $closure)
    {
        return $closure();
    }
}
