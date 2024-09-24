<?php

function getAllGames(object $db): array {
    $query = $db->prepare('SELECT `name`, `genre`, `platform`, `agerating`.`age` FROM videogames
JOIN agerating ON videogames.ageid = `agerating`.`id`;');
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
        <p><strong>Age Rating:</strong> {$game['age']}</p>
    </div>";
}
return $result;
}