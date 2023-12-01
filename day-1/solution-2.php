<?php

function matchWordToNumber($input): string
{
    if (is_numeric($input)) {
        return $input;
    }

    $map = [
        'one' => '1',
        'two' => '2',
        'three' => '3',
        'four' => '4',
        'five' => '5',
        'six' => '6',
        'seven' => '7',
        'eight' => '8',
        'nine' => '9',
    ];

    return $map[$input];
}

function solutionTwo(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $input) {
        preg_match_all('/(one|two|three|four|five|six|seven|eight|nine|\d)/', $input, $matches);

        $matched = $matches[0];
        $firstDigit = matchWordToNumber($matched[0]);
        $lastDigit = matchWordToNumber($matched[count($matched) - 1]);

        return $carry + intval($firstDigit . $lastDigit);
    }, 0);
}


var_dump(solutionTwo(file_get_contents(__DIR__ .'/input.txt')));