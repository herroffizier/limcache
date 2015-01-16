<?php
/**
 * Limcache
 *
 * This file contains base class for eviction strategy test cases.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\util;

abstract class EvictionStrategyTestCase extends \PHPUnit_Framework_TestCase
{
    public function forcePHPArrayProvider()
    {
        return [
            [false],
            [true],
        ];
    }
}
