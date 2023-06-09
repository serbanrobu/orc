<?php

namespace Orc\Parser;

use Orc\Parser;
use Orc\Result;
use Orc\Result\Ok;

/**
 * @template I
 * @template O
 * @template E
 *
 * @extends Parser<I, O, E>
 */
readonly class Alt extends Parser
{
    /**
     * @param  Parser<I, O, E>  $first
     * @param  Parser<I, O, E>  $second
     */
    public function __construct(readonly public Parser $first, readonly public Parser $second)
    {
    }

    public function parse(mixed $input): Result
    {
        $result = $this->first->parse($input);

        if ($result instanceof Ok) {
            return $result;
        }

        return $this->second->parse($input);
    }
}
