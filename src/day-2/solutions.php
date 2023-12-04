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

function determineWinner(string $player, string $opponent): int
{
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

function determineWinnerSolutionOne(string $player, string $opponent): int
{
    $player = PLAYER[$player];
    $opponent = OPPONENT[$opponent];
    return determineWinner($player, $opponent);
}

function solutionOne(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $input) {
        $results = explode(' ', $input);

        return determineWinnerSolutionOne($results[1], $results[0]) + $carry;
    }, 0);
}

const WIN_INPUT = 'Z';
const LOSE_INPUT = 'X';
const DRAW_INPUT = 'Y';

// If the opponent chooses rock, the win input would be paper.
const OUTCOMES = [
    ROCK => [
        WIN_INPUT => PAPER,
        LOSE_INPUT => SCISSORS
    ],
    PAPER => [
        WIN_INPUT => SCISSORS,
        LOSE_INPUT => ROCK
    ],
    SCISSORS => [
        WIN_INPUT => ROCK,
        LOSE_INPUT => PAPER
    ],
];


function determineWinnerFromOutcome(string $outcome, string $opponent): int
{
    $opponent = OPPONENT[$opponent];
    $player = $outcome === DRAW_INPUT ? $opponent : OUTCOMES[$opponent][$outcome];

    return determineWinner($player, $opponent);
}

function solutionTwo(string $input): int
{
    return array_reduce(explode(PHP_EOL, $input), function (int $carry, string $input) {
        $results = explode(' ', $input);

        return determineWinnerFromOutcome($results[1], $results[0]) + $carry;
    }, 0);
}