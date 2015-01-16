<?php
/**
 * Limcache
 *
 * This file contains PHP array wrapper class.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\storage;

class PHPArray implements ArrayInterface
{
    protected $type = null;
    protected $data = [];
    protected $lastInserted = null;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($offset !== null) {
            $this->data[$offset] = $value;
            $this->lastInserted = $offset;
        } else {
            $this->data[] = $value;
            end($this->data);
            $this->lastInserted = key($this->data);
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
        end($this->data);
        $this->lastInserted = key($this->data);
    }

    public function count()
    {
        return count($this->data);
    }

    public function lastInsertedOffset()
    {
        return $this->lastInserted;
    }

    public function first()
    {
        return reset($this->data);
    }

    public function last()
    {
        return end($this->data);
    }
}
