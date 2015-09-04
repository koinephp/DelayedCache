<?php

$autoloader = require_once __DIR__ . '/../vendor/autoload.php';

use Example\ClearCache;
use Example\DelayedCache as DelayedCacheCommand;
use Example\RegularCache;
use Koine\DelayedCache\DelayedCache;
use Symfony\Component\Console\Application;
use Zend\Cache\StorageFactory;

$zendCache = StorageFactory::factory(array(
    'adapter' => array(
        'name' => 'filesystem',
    ),
));

$delayedCache = new DelayedCache($zendCache);

$calculation = function () {
    sleep(10);
    return rand(0, 1000);
};

$application = new Application();
$application->add(new RegularCache($zendCache, $calculation));
$application->add(new DelayedCacheCommand($delayedCache, $calculation));
$application->add(new ClearCache($delayedCache, $calculation));
$application->run();
