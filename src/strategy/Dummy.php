<?php
/**
 * Limcache
 *
 * This file contains dummy eviction strategy.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\strategy;

class Dummy implements EvictionStrategyInterface
{
    public function afterGetKey($key)
    {
        return;
    }

    public function afterSetKey($key)
    {
        return;
    }

    public function afterDeleteKey($key)
    {
        return;
    }

    public function getExpiredKey()
    {
        return;
    }
}
