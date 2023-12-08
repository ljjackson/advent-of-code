<?php

require __DIR__ . '/shared.php';

[$input, $sequenceContent] = explode(PHP_EOL . PHP_EOL, file_get_contents('input.txt'));

$exploded = explode(PHP_EOL, $sequenceContent);

$sequence = [];
for ($i = 0; $i < count($exploded); $i++) {
    [$index, $options] = explode(' = ', $exploded[$i]);
    [$left, $right] = explode(', ', str_replace(['(', ')'], '', $options));
    $sequence[$index] = [
        'L' => $left,
        'R' => $right
    ];
}

$current = 'AAA';

$steps = 0;
$currentInput = 0;
$lengthOfInput = strlen($input);

while ($current !== 'ZZZ') {
    if ($lengthOfInput === $currentInput) $currentInput = 0;
    $leftOrRight = $input[$currentInput];
    $current = $sequence[$current][$leftOrRight];
    $steps++;
    $currentInput++;
}

var_dump($steps);