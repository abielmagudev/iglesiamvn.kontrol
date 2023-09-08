<?php

namespace App\Models\Kernel;

trait HasExistentialTrait
{
    public function isReal()
    {
        return ! is_null($this->id);
    }

    public function isFake()
    {
        return is_null($this->id);
    }
}
