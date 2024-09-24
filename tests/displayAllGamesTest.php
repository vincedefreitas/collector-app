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
            'agerating' => '16'
        ]];

        $expected = "<div class='card'>
        <h1>Game: Elden Ring</h1>
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
