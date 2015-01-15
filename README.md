# Limcache

[![Build Status](https://travis-ci.org/herroffizier/limcache.svg?branch=master)](https://travis-ci.org/herroffizier/limcache) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/herroffizier/limcache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/herroffizier/limcache/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/herroffizier/limcache/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/herroffizier/limcache/?branch=master) [![Code Climate](https://codeclimate.com/github/herroffizier/limcache/badges/gpa.svg)](https://codeclimate.com/github/herroffizier/limcache)

**Limcache** is a small non-persistent cache manager that supports LRU and MRU replacement algorithms. Also it has optinonal [Judy](http://pecl.php.net/package/judy) support.

## Requirements

* PHP >= 5.4
* [Judy](http://pecl.php.net/package/judy) (optional)

## Installation

You can install **Limcache** via Composer:

```
composer require herroffizier/limcache:dev-master
```

## Usage

At first, choose replacement algorithm:

```php
// Use LRU:
$strategy = new \Limcache\strategy\LRU(100); // 100 is max item count in cache

// Or MRU:
$strategy = new \Limcache\strategy\MRU(100);
```

After that you can create cache:

```php
$cache = new \Limcache\Cache($strategy);
```

Since ```\Limcache\Cache``` implements ```\ArrayAccess``` and ```\Countable``` interfaces you can use it mostly as array in most cases: 

```php
// Save item in cache:
$cache['key1'] = 'somedata';

// Get item value:
$cache['key1'];

// Try to get non-existent item:
$cache['key2']; // will return null

// Do some ordinary things:
count($cache);
isset($cache['key1']);
unset($cache['key1']);

```

In addition cache object has few useful methods which may help to determine cache efficiency:

```php
// Get cache hits:
$cache->getHits();

// Get cache misses:
$cache->getMisses();
```