<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class validateTitleTest extends TestCase
{
    public function testValidateTitleSuccess(): void
    {
        $input = "Test Title";

        $expected = "Test Title";
        $actual = validateTitle($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateTitleFailure(): void
    {
        $input = "";

        $expected = false;
        $actual = validateTitle($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateTitleTrim(): void
    {
        $input = " Hello ";

        $expected = "Hello";
        $actual = validateTitle($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateTitleMalformedInputs(): void {

        $input = ['Hello'];
        $this->expectException(TypeError::class);
        validateTitle($input);
    }
}

