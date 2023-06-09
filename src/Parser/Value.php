<?php

namespace Orc\Parser;

use Orc\Parser;
use Orc\Result;

/**
 * @template I
 * @template O1
 * @template O2
 * @template E
 * @extends Parser<I, O2, E>
 */
class Value extends Parser
{
    /**
     * @param Parser<I, O1, E> $parser
     * @param O2 $value
     */
    public function __construct(public Parser $parser, public mixed $value)
    {
    }

    public function parse(mixed $input): Result
    {
        return $this->parser->parse($input)->map(fn ($pair) => [$this->value, $pair[1]]);
    }
}
