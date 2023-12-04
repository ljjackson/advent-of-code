<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../src/day-2/solutions.php';

class Day2Test extends TestCase
{
    public function test_it_determines_game_output_for_solution_one()
    {
        $this->assertSame(15, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-2/test.txt')));
        $this->assertSame(15422, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-2/actual.txt')));
    }

    public function test_it_determines_game_output_for_solution_two()
    {
        $this->assertSame(12, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day-2/test.txt')));
        $this->assertSame(15442, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day-2/actual.txt')));
    }
}