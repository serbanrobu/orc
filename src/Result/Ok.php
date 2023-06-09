<?php

namespace Orc\Result;

use Orc\Result;

/**
 * @template T
 * @extends Result<T, never>
 */
readonly final class Ok extends Result
{
    /**
     * @param T $value
     */
    public function __construct(public mixed $value)
    {
    }
}
