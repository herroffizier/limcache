<?php
/**
 * Limcache
 *
 * This file contains MRU eviction strategy.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\strategy;

class MRU extends BaseRU
{
    protected function getBorderKey()
    {
        return $this->keys->last();
    }
}
