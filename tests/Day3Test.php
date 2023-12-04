<?php

require  __DIR__ . '/../src/day-3/solutions.php';

class Day3Test extends \PHPUnit\Framework\TestCase
{
    public function test_solution_one()
    {
        $this->assertSame(157, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-3/test.txt')));
        $this->assertSame(7967, solutionOne(file_get_contents(__DIR__ . '/fixtures/day-3/actual.txt')));
    }


}