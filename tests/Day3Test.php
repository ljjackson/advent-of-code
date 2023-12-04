<?php

require __DIR__ . '/../src/day-3/solutions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    public function test_it_will_return_correct_output()
    {
        $this->assertSame(4361, solutionOne(file_get_contents(__DIR__ . '/fixtures/day3.txt')));
    }

    public function test_it_will_return_correct_value_with_counting_edges()
    {
        $this->assertSame(160, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day3/160.txt')));
    }

    public function test_it_will_return()
    {
        $this->assertSame(305404, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day3/first_line.txt')));
        $this->assertSame(5565451, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day3/5565451.txt')));
    }

    public function test_performance()
    {
        $this->assertSame(79026871, solutionTwo(file_get_contents(__DIR__ . '/../src/day-3/input.txt')));
    }
}