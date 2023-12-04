<?php

require  __DIR__ . '/../src/day-4.php';

class Day4Test extends \PHPUnit\Framework\TestCase
{
    public function test_solution_one()
    {
        $this->assertSame(2, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-4/test.txt')));
        $this->assertSame(503, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-4/actual.txt')));
    }
    public function test_solution_two()
    {
        $this->assertSame(4, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day-4/test.txt')));
        $this->assertSame(827, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day-4/actual.txt')));
    }
}