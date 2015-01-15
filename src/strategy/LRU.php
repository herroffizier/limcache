<?php
/**
 * Limcache
 *
 * This file contains LRU eviction strategy.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\strategy;

class LRU extends BaseRU
{
    protected function getBorderKey()
    {
        return $this->keys->first();
    }
}
