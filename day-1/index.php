<?php

$input = array_reduce(explode("\n", file_get_contents(__DIR__ . '/input.txt')), function ($input, $carry) {
    $results = preg_replace("/[^0-9]/", "", $input);
    $length = strlen($results);

    if ($length === 0) {
        throw new Exception('Something went terribly wrong.');
    }

    $firstNumber = substr($results, 0, 1);
    $lastNumber = substr($results, -1, 1);

    return intval($firstNumber . '' . $lastNumber) + $carry;
}, 0);


var_dump($input);