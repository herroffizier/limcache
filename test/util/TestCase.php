<?php

namespace Limcache\test\util;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    public function forcePHPArrayProvider()
    {
        return [
            [false],
            [true],
        ];
    }
}
