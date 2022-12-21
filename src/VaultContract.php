<?php

declare (strict_types = 1);

namespace Reglue4php\Contracts4structs;

interface VaultContract extends \Countable, \ArrayAccess, \IteratorAggregate, \JsonSerializable
{
    /**
     * @param callable $callback
     * @param mixed    $default
     *
     * @return mixed
     */
    public function filter(callable $callback, $default = null);

    /**
     * @param $keys
     *
     * @return iterable
     */
    public function only($keys);

    /**
     * @param $keys
     *
     * @return iterable
     */
    public function except($keys);

    /**
     * Get all the items.
     *
     * @return array
     */
    public function all();
}
