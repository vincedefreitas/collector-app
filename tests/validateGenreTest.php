<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class validateGenreTest extends TestCase
{
    public function testValidateGenreSuccess(): void
    {
        $input = "3";

        $expected = true;
        $actual = validateGenre($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateGenreFailure(): void
    {
        $input = "10";

        $expected = false;
        $actual = validateGenre($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateGenreMalformedInputs(): void
    {
        $input = [1];
        $this->expectException(TypeError::class);
        validateGenre($input);

    }
}
