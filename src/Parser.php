<?php

namespace Orc;

use Closure;
use Orc\Parser\Map;
use Orc\Parser\Alt;
use Orc\Parser\Value;

/**
 * @template I
 * @template O
 * @template E
 */
readonly abstract class Parser
{
    /**
     * @param  I  $input
     * @return Result<Pair<O, I>, E>
     */
    abstract public function parse(mixed $input): Result;

     /**
      * @param  I  $input
      * @return Result<Pair<O, I>, E>
      */
     public function __invoke(mixed $input): Result
     {
         return $this->parse($input);
     }

     /**
      * @param  Parser<I, O, E>  $parser
      * @return Alt<I, O, E>
      */
     public function alt(self $parser): Alt
     {
         return new Alt($this, $parser);
     }

    /**
     * @template O1
     *
     * @param  Closure(O): O1  $function
     * @return Map<I, O, O1, E>
     */
    public function map(Closure $function): Map
    {
        return new Map($this, $function);
    }

     /**
      * @template O1
      *
      * @param  O1  $value
      * @return Value<I, O, O1, E>
      */
     public function value(mixed $value): Value
     {
         return new Value($this, $value);
     }
}
