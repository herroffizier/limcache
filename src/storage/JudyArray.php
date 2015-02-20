<?php
/**
 * Limcache
 *
 * This file contains Judy array wrapper class.
 *
 * @author  Martin Stolz <herr.offizier@gmail.com>
 */

namespace Limcache\storage;

class JudyArray implements ArrayInterface
{
    protected $data = null;

    protected $lastInserted     = null;
    protected $lastOffset       = null;

    public function __construct($type)
    {
        $judyTypes = [
            ArrayFactory::STRING_TO_MIXED   => \Judy::STRING_TO_MIXED,
            ArrayFactory::STRING_TO_INT     => \Judy::STRING_TO_INT,
            ArrayFactory::INT_TO_MIXED      => \Judy::INT_TO_MIXED,
        ];
        $this->data = new \Judy($judyTypes[$type]);
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
            if (!isset($this->data[$offset])) {
                $this->lastInserted = $offset;
                $this->lastOffset = $offset;
            }
            $this->data[$offset] = $value;
        } else {
            $this->data[] = $value;
            $this->lastInserted = $this->data->last();
            $this->lastOffset = $offset;
        }
    }

    public function offsetUnset($offset)
    {
        if ($offset === $this->lastInserted) {
            $this->lastInserted = $this->data->prev($this->lastInserted);
        }
        unset($this->data[$offset]);
    }

    public function count()
    {
        return $this->data->count();
    }

    public function lastInsertedOffset()
    {
        return $this->lastInserted;
    }

    public function first()
    {
        return $this->data[$this->data->first()];
    }

    public function last()
    {
        return $this->data[$this->data->last()];
    }
}
