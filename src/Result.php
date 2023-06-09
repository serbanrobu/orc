<?php

namespace Orc;

use Closure;
use Orc\Result\Err;
use Orc\Result\Ok;

/**
 * @template T
 * @template E
 */
readonly abstract class Result
{
    /**
     * @template T1
     * @param Closure(T): T1 $function
     * @return Result<T1, E>
     */
    public function map(Closure $function): self
    {
        if ($this instanceof Err) {
            return new Err($this->error);
        }

        assert($this instanceof Ok);

        return new Ok($function($this->value));
    }

    /**
     * @template T1
     * @param T1 $value
     * @return Result<T1, E>
     */
    public function value(mixed $value): self
    {
        if ($this instanceof Err) {
            return $this;
        }

        assert($this instanceof Ok);

        return new Ok($value);
    }
}
