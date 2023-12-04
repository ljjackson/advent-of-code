<?php

function findWinningNumbers(string $input): int
{
    return array_reduce(array_keys(getWinningNumbers($input)), fn(int $carry, $i) => $i === 0 ? 1 : $carry * 2, 0);
}

function getWinningNumbers(string $input): array
{
    [$_, $input] = explode(':', $input);
    [$winningNumbers, $playerNumbers] = array_map(fn($numbers) => explode(' ', trim($numbers)), explode('|', $input));
    return array_values(array_intersect($playerNumbers, $winningNumbers));
}

function solutionOne(string $input): int
{
    $games = explode(PHP_EOL, str_replace('  ', ' ', $input));
    return array_reduce($games, fn(int $carry, string $game) => findWinningNumbers($game) + $carry, 0);
}

function solutionTwo(string $input)
{
    $games = explode(PHP_EOL, str_replace('  ', ' ', $input));
    $duplicateTracker = [];

    foreach ($games as $index => $game) {
        $gameNumber = $index + 1;

        $winExtrapolator = 1 + ($duplicateTracker[$gameNumber] ?? 0);

        $total = count(getWinningNumbers($game));


        for ($i = 0; $i < $total; $i++) {
            $nextIndex = ($gameNumber + 1) + $i;
            if (array_key_exists($nextIndex, $duplicateTracker)) {
                $duplicateTracker[$nextIndex] += $winExtrapolator;
            } else {
                $duplicateTracker[$nextIndex] = $winExtrapolator;
            }
        }
    }

    return array_sum($duplicateTracker) + count($games);
}