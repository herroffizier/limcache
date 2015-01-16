<?php
/**
 * Limcache
 *
 * This file contains tests for cache object.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\unit;

use \Limcache\test\util\ArrayTestCase;
use \Limcache\Cache;
use \Limcache\strategy\Dummy;

class CacheTest extends ArrayTestCase
{
    public function arrayProvider()
    {
        return [
            [new Cache(new Dummy)],
        ];
    }

    /**
     * @dataProvider arrayProvider
     */
    public function testMissingItems($array)
    {
        $this->assertNull($array['key1']);
    }

    /**
     * @dataProvider arrayProvider
     */
    public function testHitsAndMisses($array)
    {
        $this->assertEquals(0, $array->getHits());
        $this->assertEquals(0, $array->getMisses());

        $array['key1'] = 'test';
        $this->assertEquals('test', $array['key1']);
        $this->assertEquals('test', $array['key1']);
        $this->assertNull($array['key2']);

        $this->assertEquals(2, $array->getHits());
        $this->assertEquals(1, $array->getMisses());
    }
}
