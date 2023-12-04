<?php

function solutionOne(string $input): int
{
    return max(getTotalElfCalories($input));
}

/**
 * @param string $input
 * @return array|float[]|int[]
 */
function getTotalElfCalories(string $input): array
{
    return array_map(function (string $input) {
        return array_sum(explode(PHP_EOL, $input));
    }, explode(PHP_EOL . PHP_EOL, $input));
}

function solutionTwo(string $input): int
{
    $total = getTotalElfCalories($input);

    sort($total);

    return array_sum([
        $total[count($total) - 1],
        $total[count($total) - 2],
        $total[count($total) - 3]
    ]);
}