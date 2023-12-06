<?php

$rows = array_map(function (string $input) {
    [$_, $results] = explode(':', $input);

    preg_match_all('/(\d+)/', $results, $results);
    return $results[0];
}, explode(PHP_EOL, file_get_contents(__DIR__ . '/input.txt')));

function determineAmountOfWaysToWin(int $time, int $distance): int {
    $winCount = 0;

    for ($secondsHeld = 0; $secondsHeld <= $time; $secondsHeld++) {
        // If the person holds it down for 1 second

        $remainingTime = $time - $secondsHeld;

        $result = $remainingTime * $secondsHeld;

        if ($result > $distance) $winCount++;



    }

    return $winCount;
}

$ways = [];

for ($i = 0; $i < count($rows[0]); $i++) {
    $time = $rows[0][$i];
    $distance = $rows[1][$i];
    $ways[] = determineAmountOfWaysToWin($time, $distance);
}

var_dump(array_product($ways));