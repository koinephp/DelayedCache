# Koine Delayed Cache

Delayed Cache. Sometimes you want a cached result when its construction is
still ongoing. Delayed cache will wait until it is ready and then it will return
the result for you.

Code information:

[![Build Status](https://travis-ci.org/koinephp/DelayedCache.png?branch=master)](https://travis-ci.org/koinephp/DelayedCache)
[![Coverage Status](https://coveralls.io/repos/koinephp/DelayedCache/badge.png)](https://coveralls.io/r/koinephp/DelayedCache)
[![Code Climate](https://codeclimate.com/github/koinephp/DelayedCache.png)](https://codeclimate.com/github/koinephp/DelayedCache)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/koinephp/DelayedCache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/koinephp/DelayedCache/?branch=master)

Package information:

[![Latest Stable Version](https://poser.pugx.org/koine/delayed-cache/v/stable.svg)](https://packagist.org/packages/koine/delayed-cache)
[![Total Downloads](https://poser.pugx.org/koine/delayed-cache/downloads.svg)](https://packagist.org/packages/koine/delayed-cache)
[![Latest Unstable Version](https://poser.pugx.org/koine/delayed-cache/v/unstable.svg)](https://packagist.org/packages/koine/delayed-cache)
[![License](https://poser.pugx.org/koine/delayed-cache/license.svg)](https://packagist.org/packages/koine/delayed-cache)
[![Dependency Status](https://gemnasium.com/koinephp/DelayedCache.png)](https://gemnasium.com/koinephp/DelayedCache)


## Installing

### Installing via Composer
Append the lib to your requirements key in your composer.json.

```javascript
{
    // composer.json
    // [..]
    require: {
        // append this line to your requirements
        "koine/delayed-cache": "dev-master"
    }
}
```

### Alternative install
- Learn [composer](https://getcomposer.org). You should not be looking for an alternative install. It is worth the time. Trust me ;-)
- Follow [this set of instructions](#installing-via-composer)

## Usage

```php
$zendCache = $cache  = \Zend\Cache\StorageFactory::adapterFactory(
    'apc',
    array('ttl' => 3600)
);

$delayedCache = new \Koine\DelayedCache\DelayedCache($zendCache);
```

```php
// index.php, second 10:00:00 am

$cacheKey = 'veryExpansiveCalculation';

$veryExpansiveCalculation = function () {
    sleep(60);

    return '42';
};

if (!$delayedCache->hasItem($cacheKey)) {
    $delayedCache->setItem($cacheKey, $veryExpansiveCalculation());
}

echo 'answer is: ' . $delayedCache->getItem($cacheKey);
```

```php
// index.php, 10:00:10 am

$cacheKey = 'veryExpansiveCalculation';

$veryExpansiveCalculation = function () {
    sleep(60);

    return '42';
};

// although the result is not ready yet, hasItem will return true
if (!$delayedCache->hasItem($cacheKey)) {
    $delayedCache->setItem($cacheKey, $veryExpansiveCalculation());
}

// Waits 50 seconds until the building of the cache is done and then returns
// The $veryExpansiveCalculation callback will not be executed twice, unless the
// cache is cleared
echo 'answer is: ' . $delayedCache->getItem($cacheKey);

```

Alternatively you can use the short method:

```php
$cacheKey = 'veryExpansiveCalculation';

$veryExpansiveCalculation = function () {
    sleep(60);

    return '42';
};

// if cache is not set, it will set and then return the cached value
echo 'answer is: ' . $delayedCache->getWithFallback($cacheKey, $veryExpansiveCalculation);
```


## Issues/Features proposals

[Here](https://github.com/koinephp/delayed-cache/issues) is the issue tracker.

## Contributing

Only TDD code will be accepted. Please follow the [PSR-2 code standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

### How to run the tests:

```bash
phpunit
```

### To check the code standard run:

```bash
# Fixes code
./bin/php-cs-fix.sh

# outputs error
./bin/php-cs-fix.sh src true
./bin/php-cs-fix.sh test true

```

## Lincense
[MIT](MIT-LICENSE)

## Authors

- [Marcelo Jacobus](https://github.com/mjacobus)
