<?php

function getAllGames(object $db): array
{
    $query = $db->prepare(
        'SELECT `name`, `genre`.`genre`, `platform`.`platform`, `image`, `agerating`.`age` FROM videogames
        JOIN `genre` ON `videogames`.`genreid` = `genre`.`id`
        JOIN `platform` ON `videogames`.`platformid` = `platform`.`id`
        JOIN `agerating` ON `videogames`.`ageid` = `agerating`.`id`;'
    );
    $result = $query->execute();
    if ($result) {
        $videogames = $query->fetchAll();
    } else {
        throw new ErrorException("Couldn't retrieve information from database");
    }
    return $videogames;
}

function displayAllGames(array $games): string
{
    $result = "";
    foreach ($games as $game) {
        $result .= "<div class='card'>
        <img class='card-img' src='{$game['image']}' alt='Image of {$game['name']} cover'>
        <h2>Game: {$game['name']}</h2>
        <p><strong>Genre:</strong> {$game['genre']}</p>
        <p><strong>Platform:</strong> {$game['platform']}</p>
        <p><strong>Age Rating:</strong> {$game['age']}</p>
    </div>";
    }
    return $result;
}