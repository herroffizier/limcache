<?php
/**
 * Limcache
 *
 * This file contains cache manager.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache;

use Limcache\strategy\EvictionStrategyInterface;
use Limcache\storage\ArrayFactory;

class Cache implements \ArrayAccess, \Countable
{
    /**
     * Eviction strategy.
     *
     * @var EvictionStrategyInterface
     */
    protected $strategy = null;

    /**
     * Cache.
     *
     * @var \Limcache\storage\ArrayInterface
     */
    protected $cache = [];

    /**
     * Cache hits.
     *
     * @var integer
     */
    protected $hits = 0;

    /**
     * Cache misses.
     *
     * @var integer
     */
    protected $misses = 0;

    /**
     * @param EvictionStrategyInterface
     */
    public function __construct(EvictionStrategyInterface $strategy)
    {
        $this->strategy = $strategy;

        $this->cache = ArrayFactory::createArray(ArrayFactory::STRING_TO_MIXED);
    }

    /**
     * Remove expired items from cache.
     */
    protected function evict()
    {
        while ($key = $this->strategy->getExpiredKey()) {
            unset($this[$key]);
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->cache[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->cache[$offset])) {
            $this->misses++;

            return;
        }

        $this->hits++;

        $value = $this->cache[$offset];
        $this->strategy->afterGetKey($offset);

        return $value;
    }

    public function offsetSet($offset, $value)
    {
        if (!isset($this->cache[$offset])) {
            $this->evict();
        }

        $this->cache[$offset] = $value;
        $this->strategy->afterSetKey($offset);
    }

    public function offsetUnset($offset)
    {
        unset($this->cache[$offset]);
        $this->strategy->afterDeleteKey($offset);
    }

    public function count()
    {
        return count($this->cache);
    }

    /**
     * Return cache hits.
     *
     * @return integer
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Return cache misses.
     *
     * @return integer
     */
    public function getMisses()
    {
        return $this->misses;
    }
}
