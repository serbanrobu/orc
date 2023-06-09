<?php

declare(strict_types=1);

namespace Orc\Parser;

use Closure;
use Orc\Pair;
use Orc\Parser;
use Orc\Result;

/**
 * @template I
 * @template O1
 * @template O2
 * @template E
 * @extends Parser<I, O2, E>
 */
readonly class Map extends Parser
{
    /**
     * @param  Parser<I, O1, E>  $parser
     * @param  Closure(O1): O2  $function
     */
    public function __construct(public Parser $parser, public Closure $function)
    {
    }

    public function parse(mixed $input): Result
    {
        return $this
            ->parser
            ->parse($input)
            ->map(
                fn (Pair $pair) => new Pair(($this->function)($pair->first), $pair->second)
            );
    }
}
