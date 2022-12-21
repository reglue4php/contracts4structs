<?php

declare (strict_types = 1);

namespace Reglue4php\Contracts4structs\Traits;

trait VaultTrait
{
    /**
     * @var array
     */
    protected $items = [];

    // Extras

    /**
     * {@inheritdoc }
     */
    public function filter(callable $callback, $default = null)
    {
        $items = $callback ? array_filter($this->all(), $callback, ARRAY_FILTER_USE_BOTH) : array_filter($this->all());

        return $items ?? (is_callable($default) ? $default($this) : $default);
    }

    // API

    /**
     * Get all the items.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->all());
    }

    /**
     * Get an item.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if ($this->has($key)) {return $this->items[$key];}
    }

    /**
     * @param int|string $key
     *
     * @return static
     */
    public function remove($key)
    {
        if ($this->has($key)) {unset($this->items[$key]);}
        return $this;
    }

    /**
     * @return static
     */
    public function clear()
    {
        $this->items = [];

        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function count()
    {
        return count($this->all());
    }

    /**
     * Convert the instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($item) {
            return is_object($item) && method_exists($item, __FUNCTION__) ? $item->toArray() : $item;
        }, $this->all());
    }

    /**
     * Convert the instance to JSON.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param  int|string  $key
     * @param  mixed       $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @param  int|string $key
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->remove($key);
    }

    /**
     * Dynamically retrieve the value of an attribute.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Dynamically set the value of an attribute.
     *
     * @param  string $key
     * @param  mixed  $value
     *
     * @return void
     */
    public function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    /**
     * Dynamically check if an attribute is set.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Dynamically unset an attribute.
     *
     * @param  string $key
     *
     * @return void
     */
    public function __unset($key)
    {
        $this->offsetUnset($key);
    }
}
