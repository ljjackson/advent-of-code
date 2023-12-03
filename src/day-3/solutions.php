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

function solutionTwo(string $input): int
{
    $engine = explode(PHP_EOL, $input);

    $currentLine = 0;
    $totalLines = count($engine);
    $currentLetter = 0;
    $lettersPerLine = strlen($engine[0]);
    $gearProducts = [];
    $allNumbers = [];

    while ($currentLine < $totalLines) {
        $isLastLetterInLine = ($currentLetter + 1) === $lettersPerLine;
        $value = $engine[$currentLine][$currentLetter];
        $startingOnFirstLine = $currentLetter - 1 <= 0;
        $isStartingOnLastLine = $currentLetter + 1 > $lettersPerLine - 1;

        if ($value === '*') {
            // Create a box surrounding the asterisk
            // The top left will be true if there is a number there
            // |TFF|
            // |FFF|
            // |FFF|
            $box = array_filter([
                $currentLine - 1 => ($currentLine - 1) < 0 ? null : [
                    ! $startingOnFirstLine && is_numeric($engine[$currentLine - 1][$currentLetter - 1]),
                    is_numeric($engine[$currentLine - 1][$currentLetter]),
                    ! $isStartingOnLastLine && is_numeric($engine[$currentLine - 1][$currentLetter + 1])
                ],
                $currentLine => [
                    ! $startingOnFirstLine && is_numeric($engine[$currentLine][$currentLetter - 1]),
                    false,
                    ! $isStartingOnLastLine && is_numeric($engine[$currentLine][$currentLetter + 1])
                ],
                $currentLine + 1 => $currentLine + 1 === $totalLines ? null : [
                    ! ($startingOnFirstLine) && is_numeric($engine[$currentLine + 1][$currentLetter - 1]),
                    is_numeric($engine[$currentLine + 1][$currentLetter]),
                    ! $isStartingOnLastLine && is_numeric($engine[$currentLine + 1][$currentLetter + 1])
                ]
            ]);

            if (hasMultipleNumbersInSurroundingBox($box)) {
                $numbers = [];

                foreach ($box as $index => $options) {
                    $searchBackwardsNumber = '';
                    $searchForwardNumber = '';

                    if ($options[0]) {
                        $searchIndex = $currentLetter - 1;
                        while (isset($engine[$index][$searchIndex]) && is_numeric($engine[$index][$searchIndex])) {
                            $searchBackwardsNumber = $engine[$index][$searchIndex] . $searchBackwardsNumber;
                            $searchIndex--;
                        }
                    }

                    if ($options[2]) {
                        $searchIndex = $currentLetter + 1;
                        while (isset($engine[$index][$searchIndex]) && is_numeric($engine[$index][$searchIndex])) {
                            $searchForwardNumber .= $engine[$index][$searchIndex];
                            $searchIndex++;
                        }
                    }

                    if ($options[1]) {
                        $numbers[] = intval(
                            $searchBackwardsNumber . $engine[$index][$currentLetter] . $searchForwardNumber
                        );
                        continue;
                    }

                    if (strlen($searchForwardNumber) > 0) {
                        $numbers[] = intval($searchForwardNumber);
                    }

                    if (strlen($searchBackwardsNumber) > 0) {
                        $numbers[] = intval($searchBackwardsNumber);
                    }
                }

                $gearProducts[] = array_product($numbers);
            }
        }


        $currentLetter++;

        if ($isLastLetterInLine) {
            $currentLetter = 0;
            $currentLine++;
        }
    }

    return array_sum($gearProducts);
}

function hasMultipleNumbersInSurroundingBox(array $values): bool
{
    $total = 0;

    foreach ($values as $plot) {
        if ($plot[0] && ! $plot[1] && $plot[2]) {
            return true;
        }
        if (count(array_filter($plot)) > 0) {
            $total++;
        }
    }

    return $total > 1;
}