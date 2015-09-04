<?php

chdir(__DIR__);

require_once '../vendor/autoload.php';

use Zend\Cache\StorageFactory;
use Koine\DelayedCache\DelayedCache;

$startTime = microtime(true);

$zendCache = StorageFactory::factory(array(
    'adapter' => array(
        'name' => 'filesystem',
    ),
));

$delayedCache = new DelayedCache($zendCache);

$calculation = function () {
    sleep(10);
    return rand(1, 600);
};

$clearCache = function () use ($delayedCache) {
    $delayedCache->removeItem('result');
};

// Result from zend cache
$zendCacheResult = function () use ($zendCache, $calculation) {
    if ($zendCache->hasItem('result')) {
        return $zendCache->getItem('result');
    }

    $result = $calculation();
    $zendCache->setItem('result', $result);
    return $result;
};

// Result from delayedCache
$delayedCacheResult = function () use ($delayedCache, $calculation) {
    if ($delayedCache->hasItem('result')) {
        return $delayedCache->getItem('result');
    }

    $delayedCache->setItem('result', $calculation);

    return $delayedCache->getItem('result');
};

$getExecutionTime = function () use ($startTime) {
    return round(microtime(true) - $startTime, 4);
};
