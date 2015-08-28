<?php

namespace KoineTest\DelayedCache;

use Koine\DelayedCache\DelayedCache;
use Koine\DelayedCache\DelayedCacheInterface;
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
    public function implementsZendCacheStorageInterface()
    {
        $this->assertInstanceOf(StorageInterface::class, $this->storage);
    }

    /**
     * @test
     */
    public function implementsDelayedCacheInterface()
    {
        $this->assertInstanceOf(DelayedCacheInterface::class, $this->storage);
    }

    /**
     * @test
     */
    public function delegatesSetOptions()
    {
        $options = ['foo'];
        $return = $this->storage->setOptions($options);
        $this->assertSame($this->storage, $return);

        $this->adapter->setOptions($options)->shouldHaveBeenCalled();
    }

    /**
     * @test
     */
    public function delegatesGetOptions()
    {
        $options = ['foo'];
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

        $item = ['foo'];
        $this->adapter->getItem($arg1, $arg2, $arg3)->willReturn($item);

        $return = $this->storage->getItem($arg1, $arg2, $arg3);

        $this->assertSame($item, $return);
    }

    /**
     * @test
     */
    public function delegatesGetItems()
    {
        $items = ['foo'];
        $cached = ['foo' => 'bar'];
        $this->adapter->getItems($items)->willReturn($cached);
        $return = $this->storage->getItems($items);

        $this->assertSame($cached, $return);
    }

    /**
     * @test
     */
    public function delegatesHasItem()
    {
        $this->adapter->hasItem('cacheKey')->willReturn(true);
        $return = $this->storage->hasItem('cacheKey');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesHasItems()
    {
        $keys = [];
        $values = [];

        $this->adapter->hasItems($keys)->willReturn($values);
        $return = $this->storage->hasItems($keys);

        $this->assertSame($values, $return);
    }

    /**
     * @test
     */
    public function delegatesGetMetadata()
    {
        $this->adapter->getMetadata('cacheKey')->willReturn(true);
        $return = $this->storage->getMetadata('cacheKey');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegateGetMetadatas()
    {
        $keys = [];
        $values = [];

        $this->adapter->getMetadatas($keys)->willReturn($values);
        $return = $this->storage->getMetadatas($keys);

        $this->assertSame($values, $return);
    }

    /**
     * @test
     */
    public function delegatesSetItem()
    {
        $this->adapter->setItem('cacheKey', 'value')->willReturn(true);
        $return = $this->storage->setItem('cacheKey', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesSetItems()
    {
        $keyValuePairs = [];

        $this->adapter->setItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->setItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesAddItem()
    {
        $this->adapter->addItem('cacheKey', 'value')->willReturn(true);
        $return = $this->storage->addItem('cacheKey', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesAddItems()
    {
        $keyValuePairs = [];

        $this->adapter->addItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->addItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesReplaceItem()
    {
        $this->adapter->replaceItem('cacheKey', 'value')->willReturn(true);
        $return = $this->storage->replaceItem('cacheKey', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesReplaceItems()
    {
        $keyValuePairs = [];

        $this->adapter->replaceItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->replaceItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesCheckAndSetItem()
    {
        $this->adapter->checkAndSetItem('token', 'key', 'value')->willReturn(true);
        $return = $this->storage->checkAndSetItem('token', 'key', 'value');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesTouchItem()
    {
        $this->adapter->touchItem('key')->willReturn(true);
        $return = $this->storage->touchItem('key');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesTouchItems()
    {
        $keyValuePairs = [];

        $this->adapter->touchItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->touchItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesRemoveItem()
    {
        $this->adapter->removeItem('key')->willReturn(true);
        $return = $this->storage->removeItem('key');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesRemoveItems()
    {
        $keyValuePairs = [];

        $this->adapter->removeItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->removeItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesIncrementItem()
    {
        $this->adapter->incrementItem('key', 'increment')->willReturn(true);
        $return = $this->storage->incrementItem('key', 'increment');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesIncrementItems()
    {
        $keyValuePairs = [];

        $this->adapter->incrementItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->incrementItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesDecrementItem()
    {
        $this->adapter->decrementItem('key', 'decrement')->willReturn(true);
        $return = $this->storage->decrementItem('key', 'decrement');

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesDecrementItems()
    {
        $keyValuePairs = [];

        $this->adapter->decrementItems($keyValuePairs)->willReturn(true);
        $return = $this->storage->decrementItems($keyValuePairs);

        $this->assertTrue($return);
    }

    /**
     * @test
     */
    public function delegatesGetCapabilities()
    {
        $this->adapter->getCapabilities()->willReturn(true);
        $return = $this->storage->getCapabilities();

        $this->assertTrue($return);
    }
}
