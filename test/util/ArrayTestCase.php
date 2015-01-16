<?php
/**
 * Limcache
 *
 * This file contains base class for array test cases.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\util;

abstract class ArrayTestCase extends \PHPUnit_Framework_TestCase
{
    abstract public function arrayProvider();

    /**
     * @dataProvider arrayProvider
     */
    public function testArrayAccessInterface($array)
    {
        $this->assertFalse(isset($array['key1']));
        $array['key1'] = 'test';
        $this->assertTrue(isset($array['key1']));
        $this->assertEquals('test', $array['key1']);
        unset($array['key1']);
        $this->assertFalse(isset($array['key1']));
    }

    /**
     * @dataProvider arrayProvider
     */
    public function testCountableInterface($array)
    {
        $this->assertEquals(0, count($array));
        $array['key1'] = 'test';
        $this->assertEquals(1, count($array));
        $array['key2'] = 'test';
        $this->assertEquals(2, count($array));
        unset($array['key1']);
        $this->assertEquals(1, count($array));
    }
}
