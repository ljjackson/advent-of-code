<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../src/day-4/solutions.php';

class Day4Test extends TestCase
{
    public function test_it_will_correctly_determine_input_from_one_line()
    {
        $this->assertSame(8, solutionOne("Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53"));
    }

    public function test_solution_one()
    {
        $this->assertSame(21558, solutionOne(file_get_contents(__DIR__ . '/../src/day-4/actual.txt')));
    }


}