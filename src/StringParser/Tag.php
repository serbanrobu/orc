<?php

namespace Orc\StringParser;

use Orc\Result;
use Orc\Result\Err;
use Orc\Result\Ok;
use Orc\Pair;
use Orc\StringParser;

/**
 * @extends StringParser<null, false>
 */
readonly class Tag extends StringParser
{
    public function __construct(public string $tag)
    {
    }

    public function parse(mixed $input): Result
    {
        if (! str_starts_with($input, needle: $this->tag)) {
            return new Err(false);
        }

        $length = strlen($this->tag);

        return new Ok(new Pair(
            substr($input, offset: 0, length: $length),
            substr($input, offset: $length),
        ));
    }
}
