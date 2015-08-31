<?php

namespace Koine\DelayedCache;

/**
 * Koine\DelayedCache\WaiterAwareTrait
 */
trait WaiterAwareTrait
{
    private $waiter;

    /**
     * @return Waiter
     */
    public function getWaiter()
    {
        if ($this->waiter === null) {
            $this->waiter = new Waiter();
        }

        return $this->waiter;
    }

    /**
     * @param Waiter $waiter
     *
     * @return self
     */
    public function setWaiter(Waiter $waiter)
    {
        $this->waiter = $waiter;

        return $this;
    }
}
