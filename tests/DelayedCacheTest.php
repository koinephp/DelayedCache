<?php

namespace Koine\DelayedCache;

use PHPUnit_Framework_TestCase;
use Koine\DelayedCache\DelayedCache;

/**
 * Koine\DelayedCache\DelayedCacheTest
 */
class DelayedCacheTest extends PHPUnit_Framework_TestCase
{
    /** @var DelayedCache */
    protected $cache;

    public function setUp()
    {
        $this->cache = new DelayedCache();
    }

    /**
     * @test
     */
    public function canGetCacheDelayed()
    {
        $this->fail("Not implemented");
    }
}
