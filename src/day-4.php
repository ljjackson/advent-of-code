<?php

function solutionOne(string $input)
{
    $rounds = explode(PHP_EOL, $input);

    $sum = 0;
    foreach ($rounds as $round) {
        $assignments = array_map(fn($assignment) => explode('-', $assignment), explode(',', $round));

        [$topLeft, $topRight] = $assignments[0];
        [$bottomLeft, $bottomRight] = $assignments[1];

        $topContainsBottom = $topLeft <= $bottomLeft && $topRight >= $bottomRight;
        $bottomContainsTop = $bottomLeft <= $topLeft && $bottomRight >= $topRight;
        if ($topContainsBottom || $bottomContainsTop) {
            $sum++;
        }
    }
    return $sum;
}