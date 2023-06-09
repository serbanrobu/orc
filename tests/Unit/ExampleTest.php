<?php

use Orc\Result\Ok;
use Orc\StringParser\Tag;

enum Bit
{
    case Zero;
    case One;
}

test('example', function () {
    $parser = (new Tag('0'))
        ->value(Bit::Zero)
        ->alt((new Tag('1'))->value(Bit::One));

    expect($parser->parse('1abc'))->toEqual(new Ok([Bit::One, 'abc']));
});
