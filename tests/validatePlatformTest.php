<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class validatePlatformTest extends TestCase
{
    public function testValidatePlatformSuccess(): void
    {
        $input = "5";

        $expected = true;
        $actual = validatePlatform($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidatePlatformFailure(): void
    {
        $input = "13";

        $expected = false;
        $actual = validatePlatform($input);

        $this->assertEquals($expected, $actual);

    }

    public function testValidatePlatformMalformedInputs(): void
    {
        $input = [1];
        $this->expectException(TypeError::class);
        validatePlatform($input);

    }
}
