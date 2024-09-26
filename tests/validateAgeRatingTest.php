<?php

require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class validateAgeRatingTest extends TestCase
{
    public function testValidateAgeRatingSuccess(): void
    {
        $input = "2";

        $expected = true;
        $actual = validateAgeRating($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateAgeRatingFailure(): void
    {
        $input = "21";

        $expected = false;
        $actual = validateAgeRating($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidateAgeRatingMalformedInputs(): void
    {
        $input = [1];
        $this->expectException(TypeError::class);
        validateAgeRating($input);

    }
}
