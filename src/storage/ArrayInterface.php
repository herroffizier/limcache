<?php
/**
 * Limcache
 *
 * This file contains array interface.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\storage;

interface ArrayInterface extends \ArrayAccess, \Countable
{
    /**
     * Get last inserted offset.
     *
     * @return mixed
     */
    public function lastOffset();

    /**
     * Get first item in array.
     *
     * @return mixed
     */
    public function first();

    /**
     * Get last item in array.
     *
     * @return mixed
     */
    public function last();
}
