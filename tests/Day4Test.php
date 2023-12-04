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

    public function test_it_will_correctly_get_the_winning_number_count()
    {
        $this->assertSame(0, findWinningNumbers("Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36"));
        $this->assertSame(2, findWinningNumbers("Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19"));
    }

    public function test_solution_2_against_differed_input()
    {
        $this->assertSame(30, solutionTwo(file_get_contents(__DIR__ . '/../src/day-4/solution2_test.txt')));
        $this->assertSame(10425665, solutionTwo(file_get_contents(__DIR__ . '/../src/day-4/actual.txt')));
    }

}