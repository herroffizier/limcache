<?php
/**
 * Limcache
 *
 * This file contains tests for PHP array.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\test\unit\storage;

use \Limcache\test\util\ArrayTestCase;
use \Limcache\storage\ArrayFactory;
use \Limcache\storage\PHPArray;

class PHPArrayTest extends ArrayTestCase
{
    public function arrayProvider()
    {
        return [
            [new PHPArray(ArrayFactory::STRING_TO_MIXED)],
        ];
    }
}
