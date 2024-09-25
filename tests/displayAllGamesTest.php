<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class displayAllGamesTest extends TestCase {

    public function testDisplayGamesOutput(): void
    {
        $inputArray = [[
            'name' => 'Elden Ring',
            'genre' => 'Action/Adventure',
            'platform' => 'Xbox Series S',
            'age' => '16',
            'image' => 'img/elden.jpg'
        ]];

        $expected = "<div class='card'>
        <img class='card-img' src='img/elden.jpg' alt='Image of Elden Ring cover'>
        <h2>Game: Elden Ring</h2>
        <p><strong>Genre:</strong> Action/Adventure</p>
        <p><strong>Platform:</strong> Xbox Series S</p>
        <p><strong>Age Rating:</strong> 16</p>
    </div>";


        $actual = displayAllGames($inputArray);

        $this->assertEquals($expected, $actual);

    }
    public function testDisplayGamesMalformedInputs(): void
    {
        $games = "This should be an array";
        $this->expectException(TypeError::class);
        displayAllGames($games);
    }

}
