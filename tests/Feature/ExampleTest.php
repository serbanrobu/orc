<?php

/**
 * @template T
 * @template E
 */
readonly abstract class Result
{
    /**
     * @template T1
     * @param callable(T): T1 $f
     * @return Result<T1, E>
     */
    abstract public function map(callable $f): Result;
}

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

    public function map(callable $f): Result
    {
        return new self($f($this->value));
    }
}

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

    public function map(callable $f): Result
    {
        return new self($this->error);
    }
}

/**
 * @template T
 * @template E
 * @param Result<T, E> $result
 */
function isOk(Result $result): bool
{
    return $result instanceof Ok;
}

test('example', function () {
    $result = (new Err('test'))->map(fn (int $v) => $v + 2);

    $result = (new Ok(3))->map(fn ($v) => $v + 2);
    expect($result)->toEqual(new Ok(3));
});
