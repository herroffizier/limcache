<?php
/**
 * Limcache
 *
 * This file contains eviction strategy interface.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\strategy;

interface EvictionStrategyInterface
{
    /**
     * Called after retrieving existing key.
     *
     * @param  string $key
     * @return null
     */
    public function afterGetKey($key);

    /**
     * Called after storing key.
     *
     * @param  string $key
     * @return null
     */
    public function afterSetKey($key);

    /**
     * Called after deleting key.
     *
     * @param  string $key
     * @return null
     */
    public function afterDeleteKey($key);

    /**
     * Get expired key.
     *
     * @return string
     * @return null
     */
    public function getExpiredKey();
}
