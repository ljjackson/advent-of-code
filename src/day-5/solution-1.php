<?php

$time_start = microtime(true);


$input = explode(PHP_EOL . PHP_EOL, file_get_contents(__DIR__ . '/input.txt'));

// Retrieve the Seeds
[$_, $seed] = explode(':', $input[0]);
$seeds = explode(' ', trim($seed));
unset($input[0]);

// Retrieve the maps each seed needs to run through.
$maps = array_map(function (string $input) {
    [$_, $rounds] = explode(':', $input);
    return array_map(fn($line) => explode(' ', $line), explode(PHP_EOL, trim($rounds)));
}, $input);

// Get the lowest output
$output = array_reduce($seeds, function ($lowest, $seed) use ($maps) {

    $output = array_reduce($maps, function ($previous, array $maps) {
        foreach ($maps as $map) {
            $indexStart = $map[1];
            $valueStart = $map[0];
            $increment = $map[2];

            $indexEnd = $indexStart + ($increment - 1);
            $change = $indexStart - $valueStart;

            $isInRange = $previous >= $indexStart && $previous <= $indexEnd;

            if (! $isInRange) {
                continue;
            }

            return $previous - $change;

        }

        return $previous;
    }, $seed);

    if ($lowest === null) return $output;
    return min($lowest, $output);
});

var_dump($output);

$time_end = microtime(true);

$execution_time = ($time_end - $time_start);

var_dump($execution_time);