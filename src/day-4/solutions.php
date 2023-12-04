<?php

function findWinningNumbers(string $input): int
{
    [$_, $input] = explode(':', $input);
    [$winningNumbers, $playerNumbers] = array_map(fn($numbers) => explode(' ', trim($numbers)), explode('|', $input));
    $winners = array_values(array_intersect($playerNumbers, $winningNumbers));
    return array_reduce(array_keys($winners), fn(int $carry, $i) => $i === 0 ? 1 : $carry * 2, 0);
}

function solutionOne(string $input): int
{
    $games = explode(PHP_EOL, str_replace('  ', ' ', $input));
    return array_reduce($games, fn(int $carry, string $game) => findWinningNumbers($game) + $carry, 0);
}