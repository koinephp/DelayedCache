<?php

namespace KoineTest\DelayedCache;

use Koine\DelayedCache\DelayedCache;
use PHPUnit_Framework_TestCase;
use Zend\Cache\Storage\StorageInterface;

/**
 * Koine\DelayedCache\DelayedCacheTest
 */
class DelayedCacheTest extends PHPUnit_Framework_TestCase
{
    /** @var StorageInterface */
    protected $adapter;

    /** @var DelayedCache */
    protected $storage;

    public function setUp()
    {
        $this->adapter = $this->prophesize(StorageInterface::class);
        $this->storage = new DelayedCache($this->adapter->reveal());
    }

    /**
     * @test
     */
    public function itImplementsZendCacheStorageInterface()
    {
        $this->assertInstanceOf(StorageInterface::class, $this->storage);
    }

    /**
     * @test
     */
    public function delegatesSetOptions()
    {
        $options = array('foo');
        $return = $this->storage->setOptions($options);
        $this->assertSame($this->storage, $return);

        $this->adapter->setOptions($options)->shouldHaveBeenCalled();
    }

    /**
     * @test
     */
    public function delegatesGetOptions()
    {
        $options = array('foo');
        $this->adapter->getOptions()->willReturn($options);
        $return = $this->storage->getOptions();

        $this->assertSame($options, $return);
    }

    /**
     * @test
     */
    public function delegatesGetItem()
    {
        $arg1 = 'foo';
        $arg2 = 'bar';
        $arg3 = 'baz';

        $options = array('foo');
        $this->adapter->getItem($arg1, $arg2, $arg3)->willReturn($options);

        $return = $this->storage->getItem($arg1, $arg2, $arg3);

        $this->assertSame($options, $return);
    }
}
