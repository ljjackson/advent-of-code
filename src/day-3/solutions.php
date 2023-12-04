<?php


function solutionOne(string $input)
{
    $dict = array_flip(array_merge(range('a', 'z'), range('A', 'Z')));
    $inputs = explode(PHP_EOL, $input);

    $sum = 0;
    foreach ($inputs as $input) {
        $len = strlen($input);
        $first = str_split(substr($input, 0, ($len / 2)));
        $second = str_split(substr($input, ($len / 2)));

        $letters = array_values(array_unique(array_intersect($first, $second)));


        if ($letters[0]) {
            $sum += ($dict[$letters[0]] + 1);
        }

    }

    return $sum;
}
