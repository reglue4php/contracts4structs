<?php

declare (strict_types = 1);

namespace Reglue4php\Contracts4structs;

interface VaultAnyContract extends VaultContract
{
    /**
     * @param int|string $key
     * @param mixed      $value
     *
     * @return static
     */
    public function set($key, $value);
}
