<?php

namespace Orc\Result;

use Orc\Result;

/**
 * @template E
 * @extends Result<never, E>
 */
readonly final class Err extends Result
{
    /**
     * @param E $error
     */
    public function __construct(public mixed $error)
    {
    }
}
