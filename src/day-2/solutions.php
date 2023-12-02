<?php

const MAX_BLUE = 14;
const MAX_GREEN = 13;
const MAX_RED = 12;

function solutionOne(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $gameInput) {
        $numbers = preg_split('/([:;,])/', $gameInput);

        // Determine the game number
        $gameNumber = intval(explode(' ', $numbers[0])[1]);
        unset($numbers[0]);

        foreach ($numbers as $roundInput) {
            $input = explode(' ', ltrim($roundInput));
            $amount = intval($input[0]);
            $colour = $input[1];

            $impossibleGame = ($amount > MAX_RED && $colour === 'red')
                || ($amount > MAX_GREEN && $colour === 'green')
                || ($amount > MAX_BLUE && $colour === 'blue');

            if ($impossibleGame) {
                return $carry;
            }
        }

        return $carry + $gameNumber;
    }, 0);
}


var_dump(solutionOne(file_get_contents(__DIR__ . '/input.txt')));


function solutionTwo(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $gameInput) {
        $numbers = preg_split('/([:;,])/', $gameInput);
        unset($numbers[0]);

        $results = [];

        foreach ($numbers as $roundInput) {
            $input = explode(' ', ltrim($roundInput));
            $colour = $input[1];
            $results[$colour] = max($results[$colour] ?? 0, intval($input[0]));
        }

        return $carry + array_product($results);
    }, 0);
}

var_dump(solutionTwo(file_get_contents(__DIR__ . '/input.txt')));
