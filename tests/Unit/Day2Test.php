<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../src/day-2/solution-1.php';

class Day2Test extends TestCase
{
    public function test_it_will_return_the_sum_of_the_ids_of_games_that_were_possible()
    {
        $this->assertSame(8, solutionOne(file_get_contents(__DIR__ . '/../fixtures/day2.txt')));
    }
}