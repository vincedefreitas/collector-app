<?php

function getAllGames(object $db): array
{
    $query = $db->prepare(
        'SELECT `name`, `genre`.`genre`, `platform`.`platform`, `image`, `agerating`.`agerating` FROM videogames
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

function checkImgExists(array $game): string {
    if (!$game['image']) {
        return "";
    } else {
        return "<img class='card-img' src='{$game['image']}' alt='Image of {$game['name']} cover'>";
    }
}
function displayAllGames(array $games): string
{
    $result = "";
    foreach ($games as $game) {
        $img = checkImgExists($game);
        $result .= "<div class='card'>
        {$img}
        <h2>Game: {$game['name']}</h2>
        <p><strong>Genre:</strong> {$game['genre']}</p>
        <p><strong>Platform:</strong> {$game['platform']}</p>
        <p><strong>Age Rating:</strong> {$game['agerating']}</p>
    </div>";
    }
    return $result;
}

function getTable(string $tablename, PDO $db) {
    $query = $db->prepare("SELECT `id`, `{$tablename}` FROM `{$tablename}`");
    $result = $query->execute();
    if ($result) {
        return $query->fetchAll();
    }
}

function setDropdownOptions(array $table, $column): string {
    $options= '';
    foreach($table as $row) {
        $options .= "<option value=\"{$row['id']}\">{$row[$column]}</option>";
    }
    return $options;
}

function addGameToDB($db): void {
    if(isset($_POST['game-title']) && isset($_POST['game-genre']) && isset($_POST['game-platform']) && isset($_POST['game-age'])) {
        $gametitle = $_POST['game-title'];
        $gamegenre = $_POST['game-genre'];
        $gameplatform = $_POST['game-platform'];
        $gameage = $_POST['game-age'];

        $query = $db->prepare('INSERT INTO `videogames` (`name`, `genreid`, `platformid`, `ageid`)
    VALUES (:gametitle, :gamegenre, :gameplatform, :gameage);'
        );

        $query->execute([
            'gametitle' => $gametitle,
            'gamegenre' => $gamegenre,
            'gameplatform' => $gameplatform,
            'gameage' => $gameage
        ]);
    }
}