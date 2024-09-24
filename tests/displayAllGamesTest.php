<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class displayAllGamesTest extends TestCase {
    public function testDisplayGamesMalformedInputs(): void
    {
        $games = "This should be an array";
        $this->expectException(TypeError::class);
        displayAllGames($games);
    }

}
