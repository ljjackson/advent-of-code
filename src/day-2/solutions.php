<?php

const ROCK = 'rock';
const PAPER = 'paper';
const SCISSORS = 'scissors';

const OPPONENT = [
    'A' => ROCK,
    'B' => PAPER,
    'C' => SCISSORS,
];

const PLAYER = [
    'Y' => PAPER,
    'X' => ROCK,
    'Z' => SCISSORS,
];

const WIN = 6;
const LOSS = 0;
const DRAW = 3;

const POINTS = [
    PAPER => 2,
    ROCK => 1,
    SCISSORS => 3,
];

const WINNING_RESULTS = [
    ROCK => SCISSORS,
    SCISSORS => PAPER,
    PAPER => ROCK,
];

function determineGame(string $player, string $opponent): int
{
    $player = PLAYER[$player];
    $opponent = OPPONENT[$opponent];
    $defaultPoints = POINTS[$player];

    // Draw...
    if ($opponent === $player) {
        return DRAW + $defaultPoints;
    }

    // Wins...
    if (WINNING_RESULTS[$player] === $opponent) {
        return WIN + $defaultPoints;
    }

    return LOSS + $defaultPoints;
}

function solutionOne(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $input) {
        $results = explode(' ', $input);

        return determineGame($results[1], $results[0]) + $carry;
    }, 0);
}