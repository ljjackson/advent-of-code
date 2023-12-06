<?php

$time_start = microtime(true);

$input = explode(PHP_EOL . PHP_EOL, file_get_contents(__DIR__ . '/input.txt'));

// Retrieve the Seeds
[$_, $seedList] = explode(':', $input[0]);
$seeds = explode(' ', trim($seedList));
unset($input[0]);

$seedRange = [];
for ($i = 0; $i < count($seeds); $i += 2) {
    $seedRange[] = ['start' => $seeds[$i], 'length' => $seeds[$i + 1]];
}

// Retrieve the maps each seed needs to run through.
$maps = array_map(function (string $input) {
    [$_, $rounds] = explode(':', $input);
    return array_map(function ($line) {
        $maps = explode(' ', $line);

        return [
            'dest' => $maps[0],
            'src' => $maps[1],
            'range' => $maps[2],
        ];
    }, explode(PHP_EOL, trim($rounds)));
}, $input);


$lowestOutput = null;

foreach ($seedRange as $seed) {

    // Given we have a range of seeds that need splitting.
    // 79 - 93
    // 55 - 68

    // Say we pass the seeds into the soil mapper.
    // ------ 79 - 93 (Seed to Soil)
    // 98 = 50 - 99 = 51
    // 50 = 52 - 97 = 99
    // ------ 81 - 95 (Soil to Seed)
    // 15 = 0 - 51 = 36
    // 52 = 37 - 53 = 38
    // 0 = 39 - 14 = 53

    $finish = $seed['start'] + $seed['length'];

    // TODO on Weekend
    $seedToSoils = array_filter($maps, function (array $maps) use ($seed) {

        var_dump($maps, $seed);
    });

}


$time_end = microtime(true);

$execution_time = ($time_end - $time_start);

var_dump($execution_time);