<?php

require  __DIR__ . '/../src/day-3.php';

class Day3Test extends \PHPUnit\Framework\TestCase
{
    public function test_solution_one()
    {
        $this->assertSame(157, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-3/test.txt')));
        $this->assertSame(7967, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-3/actual.txt')));
    }
    public function test_solution_two()
    {
        $this->assertSame(70, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day-3/test.txt')));
        $this->assertSame(2716, solutionTwo(file_get_contents(__DIR__ . '/fixtures/day-3/actual.txt')));
    }


}