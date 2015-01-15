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
    protected $offset = null;

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
            $this->data[$offset] = $value;
            $this->offset = $offset;
        } else {
            $this->data[] = $value;
            $this->offset = $this->data->last();
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
        $this->offset = $this->data->last();
    }

    public function count()
    {
        return $this->data->count();
    }

    public function lastOffset()
    {
        return $this->offset;
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
