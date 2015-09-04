<?php

namespace Example;

class DelayedCache extends RegularCache
{
    protected function configure()
    {
        $this->setName('example:delayed-cache')
            ->setDescription('Caches expansive calculation result with delayed cache');
    }

    protected function getResult()
    {
        if ($this->cache->hasItem('result')) {
            return $this->cache->getItem('result');
        }

        $this->cache->setItem('result', $this->calculation);

        return $this->cache->getItem('result');
    }
}
