<?php

function getAllGames(object $db): array {
    $query = $db->prepare('SELECT `name`, `genre`, `platform`, `agerating` FROM `videogames`;');
    $result = $query->execute();
    if ($result) {
        $videogames = $query->fetchAll();
    } else {
        throw new ErrorException("Couldn't retrieve information from database");
    }
    return $videogames;
}

function displayAllGames(array $games): string {
$result = "";
foreach ($games as $game) {
    $result .= "<div class='card'>
        <h1>Game: {$game['name']}</h1>
        <p><strong>Genre:</strong> {$game['genre']}</p>
        <p><strong>Platform:</strong> {$game['platform']}</p>
        <p><strong>Age Rating:</strong> {$game['agerating']}</p>
    </div>";
}
return $result;
}