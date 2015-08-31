<?php

namespace KoineTest\DelayedCache;

use Koine\DelayedCache\DelayedCache;
use Koine\DelayedCache\DelayedCacheInterface;
use Koine\DelayedCache\Waiter;
use PHPUnit_Framework_TestCase;
use Zend\Cache\Storage\StorageInterface;

/**
 * Koine\DelayedCache\DelayedCacheTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class DelayedCacheTest extends PHPUnit_Framework_TestCase
{
    /** @var StorageInterface */
    protected $storage;

    /** @var DelayedCache */
    protected $cache;

    /** @var DelayedCache */
    protected $waiter;

    public function setUp()
    {
        $this->waiter = $this->prophesize(Waiter::class);
        $this->storage = $this->prophesize(StorageInterface::class);
        $this->cache = new DelayedCache($this->storage->reveal());
        $this->cache->setWaiter($this->waiter->reveal());
    }

    /**
     * @test
     */
    public function implementsZendCacheStorageInterface()
    {
        $this->assertInstanceOf(StorageInterface::class, $this->cache);
    }

    /**
     * @test
     */
    public function implementsDelayedCacheInterface()
    {
        $this->assertInstanceOf(DelayedCacheInterface::class, $this->cache);
    }

    /**
     * @test
     */
    public function delegatesSetOptions()
    {
        $options = ['foo'];
        $return = $this->cache->setOptions($options);
        $this->assertSame($this->cache, $return);

        $this->storage->setOptions($options)->shouldHaveBeenCalled();
    }

    /**
     * @test
     */
    public function delegatesGetOptions()
    {
        $options = ['foo'];
        $this->storage->getOptions()->willReturn($options);
        $return = $this->cache->getOptions();

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

        $item = ['foo'];
        $this->storage->getItem($arg1, $arg2, $arg3)->willReturn($item);

        $return = $this->cache->getItem($arg1, $arg2, $arg3);

        $this->assertSame($item, $return);
    }

    /**
     * @test
     */
    public function delegatesGetItems()
    {
        $items = ['foo'];
        $cached = ['foo' => 'bar'];
        $this->storage->getItems($items)->willReturn($cached);
        $return = $this->cache->getItems($items);

        $this->assertSame($cached, $return);
    }

    /**
     * @test
     */
    public function delegatesHasItem()
    {
        $this->storage->hasItem('cacheKey')->willReturn(true);
        $return = $this->cache->hasItem('cacheKey');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesHasItems()
    {
        $keys = [];
        $values = [];

        $this->storage->hasItems($keys)->willReturn($values);
        $return = $this->cache->hasItems($keys);

        $this->assertSame($values, $return);
    }

    /**
     * @test
     */
    public function delegatesGetMetadata()
    {
        $this->storage->getMetadata('cacheKey')->willReturn(true);
        $return = $this->cache->getMetadata('cacheKey');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegateGetMetadatas()
    {
        $keys = [];
        $values = [];

        $this->storage->getMetadatas($keys)->willReturn($values);
        $return = $this->cache->getMetadatas($keys);

        $this->assertSame($values, $return);
    }

    /**
     * @test
     */
    public function delegatesSetItem()
    {
        $this->storage->setItem('cacheKey', 'value')->willReturn(true);
        $return = $this->cache->setItem('cacheKey', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesSetItems()
    {
        $keyValuePairs = [];

        $this->storage->setItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->setItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesAddItem()
    {
        $this->storage->addItem('cacheKey', 'value')->willReturn(true);
        $return = $this->cache->addItem('cacheKey', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesAddItems()
    {
        $keyValuePairs = [];

        $this->storage->addItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->addItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesReplaceItem()
    {
        $this->storage->replaceItem('cacheKey', 'value')->willReturn(true);
        $return = $this->cache->replaceItem('cacheKey', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesReplaceItems()
    {
        $keyValuePairs = [];

        $this->storage->replaceItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->replaceItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesCheckAndSetItem()
    {
        $this->storage->checkAndSetItem('token', 'key', 'value')->willReturn(true);
        $return = $this->cache->checkAndSetItem('token', 'key', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesTouchItem()
    {
        $this->storage->touchItem('key')->willReturn(true);
        $return = $this->cache->touchItem('key');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesTouchItems()
    {
        $keyValuePairs = [];

        $this->storage->touchItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->touchItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesRemoveItem()
    {
        $this->storage->removeItem('key')->willReturn(true);
        $return = $this->cache->removeItem('key');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesRemoveItems()
    {
        $keyValuePairs = [];

        $this->storage->removeItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->removeItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesIncrementItem()
    {
        $this->storage->incrementItem('key', 'increment')->willReturn(true);
        $return = $this->cache->incrementItem('key', 'increment');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesIncrementItems()
    {
        $keyValuePairs = [];

        $this->storage->incrementItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->incrementItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesDecrementItem()
    {
        $this->storage->decrementItem('key', 'decrement')->willReturn(true);
        $return = $this->cache->decrementItem('key', 'decrement');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesDecrementItems()
    {
        $keyValuePairs = [];

        $this->storage->decrementItems($keyValuePairs)->willReturn(true);
        $return = $this->cache->decrementItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesGetCapabilities()
    {
        $this->storage->getCapabilities()->willReturn(true);
        $return = $this->cache->getCapabilities();

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function canSetDelayedItemReturnsAdapter()
    {
        $return = $this->cache->setDelayedItem('foo', function () {
            return 'bar';
        });

        $this->assertSame($this->cache, $return);
        $this->storage
            ->setItem(DelayedCache::UNDER_CONSTRUCTION_PREFIX . 'foo', 'under_construction')
            ->shouldHaveBeenCalled();

        $this->storage->setItem('foo', 'bar')->shouldHaveBeenCalled();

        $this->storage
            ->removeItem(DelayedCache::UNDER_CONSTRUCTION_PREFIX . 'foo')
            ->shouldHaveBeenCalled();
    }

    /**
     * @test
     */
    public function getCachedItemGetsCachedItemWhenCacheIsReady()
    {
        $this->storage->hasItem('foo')->willReturn(true);
        $this->storage->getItem('foo')->willReturn('bar');

        $return = $this->cache->getCachedItem('foo', function () {
            return 'baz';
        });

        $this->assertEquals('bar', $return);
    }

    /**
     * @test
     */
    public function getCachedItemWaitsForCacheCreationWhenCacheIsUnderConstruction()
    {
        $delayedKey = DelayedCache::UNDER_CONSTRUCTION_PREFIX . 'foo';

        $storage = $this->getMockBuilder(StorageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $storage->expects($this->at(0))
            ->method('hasItem')
            ->with('foo')
            ->will($this->returnValue(false));

        $storage->expects($this->at(1))
            ->method('hasItem')
            ->with($delayedKey)
            ->will($this->returnValue(true));

        $storage->expects($this->at(2))
            ->method('hasItem')
            ->with($delayedKey)
            ->will($this->returnValue(true));

        $storage->expects($this->at(3))
            ->method('hasItem')
            ->with($delayedKey)
            ->will($this->returnValue(false));

        $storage->expects($this->once())
            ->method('getItem')
            ->with('foo')
            ->will($this->returnValue('bar'));

        $this->cache = new DelayedCache($storage);
        $this->cache->setWaiter($this->waiter->reveal());

        $return = $this->cache->getCachedItem('foo', function () {
            return 'baz';
        });

        $this->waiter->wait(1)->shouldHaveBeenCalled();

        $this->assertEquals('bar', $return);
    }
}
