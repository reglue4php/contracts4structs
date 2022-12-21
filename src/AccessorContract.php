<?php

declare (strict_types = 1);

namespace Reglue4php\Contracts4structs;

interface AccessorContract
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param mixed $ref
     *
     * @return self
     */
    public function set($ref);
}
