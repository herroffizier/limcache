<?php
/**
 * Limcache
 *
 * This file contains tests for array implementations.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\unit;

use Limcache\test\util\TestCase;

class ArrayTest extends TestCase
{
    public function arrayImplementationProvider()
    {
        return [
            ['\Limcache\storage\PHPArray'],
            ['\Limcache\storage\JudyArray'],
        ];
    }

    /**
     * @dataProvider arrayImplementationProvider
     */
    public function testArrayAccessInterface($class)
    {
        $array = new $class(\Limcache\storage\ArrayFactory::STRING_TO_INT);
        $this->assertEquals(0, count($array));
        $array['key1'] = 1;
        $array['key2'] = 2;
        $array['key3'] = 3;
        $this->assertEquals(3, count($array));

        $this->assertTrue(isset($array['key1']));
        $this->assertEquals(1, $array['key1']);
        $this->assertTrue(isset($array['key2']));
        $this->assertEquals(2, $array['key2']);
        $this->assertTrue(isset($array['key3']));
        $this->assertEquals(3, $array['key3']);
        $this->assertFalse(isset($array['wrongkey']));

        unset($array['key2']);
        $this->assertEquals(2, count($array));
    }

    /**
     * @dataProvider arrayImplementationProvider
     */
    public function testArrayInterface($class)
    {
        $array = new $class(\Limcache\storage\ArrayFactory::STRING_TO_INT);
        $array['key1'] = 1;
        $array['key2'] = 2;
        $array['key3'] = 3;

        $this->assertEquals('key3', $array->lastOffset());
        $this->assertTrue(isset($array['key2']));
        $this->assertEquals(2, $array['key2']);
        $this->assertTrue(isset($array['key3']));
        $this->assertEquals(3, $array['key3']);
        $this->assertFalse(isset($array['wrongkey']));

        unset($array['key3']);
        $this->assertEquals('key2', $array->lastOffset());
    }
}
