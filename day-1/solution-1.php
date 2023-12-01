<?php

function solutionOne(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $input) {
        $results = preg_replace("/[^0-9]/", "", $input);

        $firstNumber = substr($results, 0, 1);
        $lastNumber = substr($results, -1, 1);

        return intval($firstNumber . $lastNumber) + $carry;
    }, 0);
}

var_dump(solutionOne(file_get_contents(__DIR__ .'/input.txt')));
