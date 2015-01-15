<?php
/**
 * Limcache
 *
 * This file contains array factory.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\storage;

class ArrayFactory
{
    const STRING_TO_MIXED = 1;
    const STRING_TO_INT = 2;
    const INT_TO_MIXED = 3;

    /**
     * If true, PHP array creation will be forced.
     *
     * @var boolean
     */
    protected static $forcePHPArray = false;

    /**
     * Enable or disable forcing PHP arrays.
     *
     * @param boolean $value
     */
    public static function setForcePHPArray($value)
    {
        self::$forcePHPArray = $value;
    }

    /**
     * Create array.
     *
     * @param  integer        $type
     * @return ArrayInterface
     */
    public static function createArray($type)
    {
        if (!self::$forcePHPArray && class_exists('\Judy', false)) {
            return new JudyArray($type);
        } else {
            return new PHPArray($type);
        }
    }
}
