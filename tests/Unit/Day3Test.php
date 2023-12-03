<?php

require __DIR__ . '/../../src/day-3/solutions.php';

use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    public function test_it_will_return_correct_output()
    {
        $this->assertSame(4361, solutionOne(file_get_contents(__DIR__ . '/../fixtures/day3.txt')));
    }
}