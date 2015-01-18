<?php
/**
 * Limcache
 *
 * This file contains tests for Judy array.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\unit\storage;

use Limcache\test\util\ArrayInterfaceTestCase;
use Limcache\storage\ArrayFactory;
use Limcache\storage\JudyArray;

class JudyArrayTest extends ArrayInterfaceTestCase
{
    public function arrayProvider()
    {
        return [
            [new JudyArray(ArrayFactory::STRING_TO_MIXED)],
        ];
    }

    public function setUp()
    {
        if (!class_exists('\Judy', false)) {
            $this->markTestSkipped('Judy extension is missing.');
        }
    }
}
