<?php
/**
 * Limcache
 *
 * This file contains tests for array factory.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\unit\storage;

use \Limcache\test\util\TestCase;
use \Limcache\storage\ArrayFactory;

class ArrayFactoryTest extends TestCase
{
    public function setUp()
    {
        if (!class_exists('\Judy', false)) {
            $this->markTestSkipped('Judy extension is missing.');
        }
    }

    public function testForcePHPArrayFlag()
    {
        ArrayFactory::setForcePHPArray(false);
        $this->assertInstanceOf(
            '\Limcache\storage\JudyArray',
            ArrayFactory::createArray(ArrayFactory::STRING_TO_MIXED)
        );

        ArrayFactory::setForcePHPArray(true);
        $this->assertInstanceOf(
            '\Limcache\storage\PHPArray',
            ArrayFactory::createArray(ArrayFactory::STRING_TO_MIXED)
        );
    }
}
