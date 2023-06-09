<?php

namespace Orc;

/**
 * @template T1
 * @template T2
 */
readonly class Pair
{
    /**
     * @param T1 $first
     * @param T2 $second
     */
    public function __construct(public mixed $first, public mixed $second)
    {
    }
}