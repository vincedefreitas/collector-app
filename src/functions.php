<?php

function getAllGames(PDO $db): array
{
    $query = $db->prepare(
        'SELECT `name`, `genre`.`genre`, `platform`.`platform`, `image`, `agerating`.`agerating` FROM videogames
        JOIN `genre` ON `videogames`.`genreid` = `genre`.`id`
        JOIN `platform` ON `videogames`.`platformid` = `platform`.`id`
        JOIN `agerating` ON `videogames`.`ageid` = `agerating`.`id`;'
    );
    $result = $query->execute();
    if (!$result) {
        throw new ErrorException("Couldn't retrieve information from database");
    } else {
        $videogames = $query->fetchAll();
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

function getGenreTable(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `genre` FROM `genre`");
    $result = $query->execute();
    if (!$result) {
        throw new ErrorException("Couldn't retrieve information from database");
    } else {
        return $query->fetchAll();
    }
}

function getPlatformTable(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `platform` FROM `platform`");
    $result = $query->execute();
    if (!$result) {
        throw new ErrorException("Couldn't retrieve information from database");
    } else {
        return $query->fetchAll();
    }
}

function getAgeRatingTable(PDO $db): array {
    $query = $db->prepare("SELECT `id`, `agerating` FROM `agerating`");
    $result = $query->execute();
    if (!$result) {
        throw new ErrorException("Couldn't retrieve information from database");
    } else {
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

function validateTitle(string $title) {
    $title = trim($title);
    if (empty($title) || strlen($title) > 100) {
        return false;
    }
    return htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
}

function validateGenre(string $genre, PDO $db): bool {
    $genretable = getGenreTable($db);
    $valid_genres = [];
    foreach ($genretable as $row) {
        $valid_genres[] = $row['id'];
    }
    return in_array($genre, $valid_genres);
}

function validatePlatform(string $platform, $db): bool {
    $platformtable = getPlatformTable($db);
    $valid_platforms = [];
    foreach ($platformtable as $row) {
        $valid_platforms[] = $row['id'];
    }
    return in_array($platform, $valid_platforms);
}

function validateAgeRating(string $age_rating, $db): bool {
    $agetable = getAgeRatingTable($db);
    $valid_age_ratings = [];
    foreach ($agetable as $row) {
        $valid_age_ratings[] = $row['id'];
    }
    return in_array($age_rating, $valid_age_ratings);
}

function addGameToDB(PDO $db, $data): void {
        $query = $db->prepare('INSERT INTO `videogames` (`name`, `genreid`, `platformid`, `ageid`, `image`)
    VALUES (:gametitle, :gamegenre, :gameplatform, :gameage, :image);'
        );

        $query->execute([
            'gametitle' => $data['gametitle'],
            'gamegenre' => $data['gamegenre'],
            'gameplatform' => $data['gameplatform'],
            'gameage' => $data['gameage'],
            'image' => 'img/placeholder.jpg'
        ]);
}