<?php
/**
 * Limcache
 *
 * This file contains base class for *RU eviction strategies.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\strategy;

use \Limcache\storage\ArrayFactory;

abstract class BaseRU implements EvictionStrategyInterface
{
    /**
     * Max item count.
     *
     * @var integer
     */
    protected $size = null;

    /**
     * Key array ordered by last key usage time (most recent key is last).
     *
     * @var \Limcache\storage\ArrayInterface
     */
    protected $keys = null;

    /**
     * Key to index array.
     *
     * @var \Limcache\storage\ArrayInterface
     */
    protected $indexes = null;

    /**
     * Get border (top or bottom) key from key list.
     *
     * @return string
     */
    abstract protected function getBorderKey();

    public function __construct($size)
    {
        $this->size = $size;

        $this->keys = ArrayFactory::createArray(ArrayFactory::INT_TO_MIXED);
        $this->indexes = ArrayFactory::createArray(ArrayFactory::STRING_TO_INT);
    }

    protected function pushKey($key)
    {
        $this->keys[] = $key;
        $this->indexes[$key] = $this->keys->lastOffset();
    }

    public function afterGetKey($key)
    {
        unset($this->keys[$this->indexes[$key]]);
        $this->pushKey($key);
    }

    public function afterSetKey($key)
    {
        if (isset($this->indexes[$key])) {
            return;
        }

        $this->pushKey($key);
    }

    public function afterDeleteKey($key)
    {
        unset(
            $this->keys[$this->indexes[$key]],
            $this->indexes[$key]
        );
    }

    public function getExpiredKey()
    {
        if ($this->keys->count() < $this->size) {
            return;
        }

        return $this->getBorderKey();
    }
}
