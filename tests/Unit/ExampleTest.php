<?php

use PHPUnit\Framework\TestCase;
use GabrielSoaresMaciel\PhpLibExample\Example;

class ExampleTest extends TestCase
{
    public function test_example(): void
    {
        $example  = new Example();

        $output = $example->hello('Gabriel');

        $this->assertEquals('Hello Gabriel', $output);
    }
}
