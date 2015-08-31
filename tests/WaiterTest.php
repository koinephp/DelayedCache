<?php

namespace KoineTest\DelayedCache;

use PHPUnit_Framework_TestCase;
use Koine\DelayedCache\Waiter;

/**
 * KoineTest\DelayedCache\WaiterTest
 */
class WaiterTest extends PHPUnit_Framework_TestCase
{
    /** @var Waiter */
    protected $waiter;

    public function setUp()
    {
        $this->waiter = new Waiter();
    }

    /**
     * @test
     */
    public function waitsForCallback()
    {
        $response = $this->waiter->waitFor(function () {
            return 'foo';
        });

        $this->assertSame('foo', $response);
    }
}
