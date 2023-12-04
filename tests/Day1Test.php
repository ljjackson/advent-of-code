<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../src/day-1.php';

class Day1Test extends TestCase
{
    public function test_it_can_determine_the_elf_carrying_the_most_calories()
    {
        $contents = file_get_contents(__DIR__ . '/fixtures/day-1/example.txt');

        $this->assertSame(24000, solutionOne($contents));
    }

    public function test_it_will_get_the_total_calories_for_the_actual_input()
    {
        $contents = file_get_contents(__DIR__ . '/fixtures/day-1/actual.txt');

        $this->assertSame(71300, solutionOne($contents));
    }

    public function test_it_will_correctly_determine_the_total_of_the_top_3()
    {
        $contents = file_get_contents(__DIR__ . '/fixtures/day-1/example.txt');

        $this->assertSame(45000, solutionTwo($contents));
    }

    public function test_it_will_get_the_top_3_most_calories()
    {
        $contents = file_get_contents(__DIR__ . '/fixtures/day-1/actual.txt');

        $this->assertSame(209691, solutionTwo($contents));
    }
}