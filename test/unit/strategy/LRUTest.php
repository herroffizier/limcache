<?php
/**
 * Limcache
 *
 * This file contains tests for LRU eviction strategy.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\unit\strategy;

use \Limcache\test\util\EvictionStrategyTestCase;
use \Limcache\storage\ArrayFactory;
use \Limcache\Cache;
use \Limcache\strategy\LRU;

class LRUTest extends EvictionStrategyTestCase
{
    /**
     * @dataProvider forcePHPArrayProvider
     */
    public function testEvictionOnSet($forcePHPArray)
    {
        ArrayFactory::setForcePHPArray($forcePHPArray);

        $strategy = new LRU(3);
        $cache = new Cache($strategy);

        $cache['key1'] = 1;
        $cache['key2'] = 2;
        $cache['key3'] = 3;
        $cache['key4'] = 4;

        $this->assertFalse(isset($cache['key1']));
        $this->assertTrue(isset($cache['key2']));
        $this->assertTrue(isset($cache['key3']));
        $this->assertTrue(isset($cache['key4']));
    }

    /**
     * @dataProvider forcePHPArrayProvider
     */
    public function testEvictionOnDoubleSet($forcePHPArray)
    {
        ArrayFactory::setForcePHPArray($forcePHPArray);

        $strategy = new LRU(3);
        $cache = new Cache($strategy);

        $cache['key1'] = 1;
        $cache['key2'] = 2;
        $cache['key3'] = 3;
        $cache['key1'] = 1;
        $cache['key4'] = 4;

        $this->assertFalse(isset($cache['key1']));
        $this->assertTrue(isset($cache['key2']));
        $this->assertTrue(isset($cache['key3']));
        $this->assertTrue(isset($cache['key4']));
    }

    /**
     * @dataProvider forcePHPArrayProvider
     */
    public function testEvictionOnRead($forcePHPArray)
    {
        ArrayFactory::setForcePHPArray($forcePHPArray);

        $strategy = new LRU(3);
        $cache = new Cache($strategy);

        $cache['key1'] = 1;
        $cache['key2'] = 2;
        $cache['key3'] = 3;
        $cache['key1']; // read key1
        $cache['key4'] = 4;

        $this->assertFalse(isset($cache['key2']));
        $this->assertTrue(isset($cache['key1']));
        $this->assertTrue(isset($cache['key3']));
        $this->assertTrue(isset($cache['key4']));
    }
}
