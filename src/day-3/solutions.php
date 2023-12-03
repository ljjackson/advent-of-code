<?php

function solutionOne(string $input): float|int
{
    $engine = explode(PHP_EOL, $input);

    $partNumbers = [];

    // We need to loop through an array until there is an integer.
    // When we get to an integer we need to find out how what number this integer belongs to.
    // Check directly before, after, and the previous and next line of the number to see if it's a "part_number"
    // If it's a part number send it into the array.
    // Other-wise skip and find the next number

    $currentLine = 0;
    $totalLines = count($engine);
    $currentLetter = 0;
    $lettersPerLine = strlen($engine[0]);
    $currentNumber = '';

    while ($currentLine < $totalLines) {
        $value = $engine[$currentLine][$currentLetter];

        if (is_numeric($value)) {
            $currentNumber .= $value;
        }

        $isLastLetterInLine = ($currentLetter + 1) === $lettersPerLine;

        if (($isLastLetterInLine || ! is_numeric($value)) && strlen($currentNumber) > 0) {
            $firstIndex = max($currentLetter - strlen($currentNumber) - 1, 0);
            if ($isLastLetterInLine && is_numeric($value)) {
                $firstIndex = $currentLetter - strlen($currentNumber);
            }


            $lastIndex = $currentLetter + 1;
            $length = $lastIndex - $firstIndex;

            $above = substr($engine[$currentLine - 1] ?? '', $firstIndex, $length);
            $current = substr($engine[$currentLine], $firstIndex, $length);
            $below = substr($engine[$currentLine + 1] ?? '', $firstIndex, $length);

            if ($currentNumber === '58') {
                var_dump($above);
                var_dump($current);
                var_dump($below);
            }

            $isPartNumber = containsSymbol(
                $above . $below . $current
            );

            if ($isPartNumber) {
                $partNumbers[] = (int) $currentNumber;
            }

            $currentNumber = '';
        }

        $currentLetter++;

        if ($isLastLetterInLine) {
            $currentLetter = 0;
            $currentLine++;
        }
    }

    return array_sum($partNumbers);
}

function containsSymbol(string $input): bool
{
    return strlen(preg_replace('/[0-9|.]/', '', $input)) > 0;
}

var_dump(solutionOne(file_get_contents(__DIR__ . '/input.txt')));