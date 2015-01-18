<?php
/**
 * Limcache
 *
 * This file contains base class for array interface test cases.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\util;

abstract class ArrayInterfaceTestCase extends ArrayTestCase
{
    /**
     * @dataProvider arrayProvider
     */
    public function testArrayInterface($array)
    {
        $this->assertInstanceOf('\Limcache\storage\ArrayInterface', $array);

        $this->assertNull($array->lastInsertedOffset());
        $this->assertNull($array->first());
        $this->assertNull($array->last());

        $array['key1'] = 'test';
        $this->assertEquals('key1', $array->lastInsertedOffset());
        $this->assertEquals('test', $array->first());
        $this->assertEquals('test', $array->last());

        $array['key2'] = 'tset';
        $this->assertEquals('key2', $array->lastInsertedOffset());
        $this->assertEquals('test', $array->first());
        $this->assertEquals('tset', $array->last());

        $array['key3'] = 'TEST';
        $this->assertEquals('key3', $array->lastInsertedOffset());
        $this->assertEquals('test', $array->first());
        $this->assertEquals('TEST', $array->last());

        $array['key2'] = 'TSET';
        $this->assertEquals('key3', $array->lastInsertedOffset());
        $this->assertEquals('test', $array->first());
        $this->assertEquals('TEST', $array->last());

        unset($array['key3']);

        $this->assertEquals('key2', $array->lastInsertedOffset());
        $this->assertEquals('test', $array->first());
        $this->assertEquals('TSET', $array->last());

        unset($array['key1']);

        $this->assertEquals('key2', $array->lastInsertedOffset());
        $this->assertEquals('TSET', $array->first());
        $this->assertEquals('TSET', $array->last());

        unset($array['key2']);

        $this->assertNull($array->lastInsertedOffset());
        $this->assertNull($array->first());
        $this->assertNull($array->last());
    }
}
