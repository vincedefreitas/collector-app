<?php

require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;
class checkImgExistsTest extends TestCase
{
    public function testCheckImgExistsSuccess(): void
    {

        $input = ['image' => 'img/randomimg.jpg', 'name' => 'random'];
        $expected = "<img class='card-img' src='img/randomimg.jpg' alt='Image of random cover'>";
        $actual = checkImgExists($input);
        $this->assertEquals($expected, $actual);

    }

    public function testCheckImgDoesntExist(): void
    {
        $input = ['name' => 'random'];
        $expected = "";
        $actual = checkImgExists($input);
        $this->assertEquals($expected, $actual);
    }

    public function testCheckImgExistsMalformedInputs(): void
    {
        $input = "This should be an array";
        $this->expectException(TypeError::class);
        checkImgExists($input);
    }

}
