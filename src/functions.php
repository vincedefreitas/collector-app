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

function getTable(string $tablename, PDO $db): array {
    $query = $db->prepare("SELECT `id`, `{$tablename}` FROM `{$tablename}`");
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
    if (empty($title) || strlen($title) > 100 || !preg_match("/^[a-zA-Z0-9\s:!]+$/", $title)) {
        return false;
    }
    return htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
}

function validateGenre(string $genre): bool {
    $valid_genres = ['1', '2', '3', '4', '5'];
    return in_array($genre, $valid_genres);
}

function validatePlatform(string $platform): bool {
    $valid_platforms = ['1', '2', '3', '4', '5', '6', '7', '8'];
    return in_array($platform, $valid_platforms);
}

function validateAgeRating(string $age_rating): bool {
    $valid_age_ratings = ['1', '2', '3', '4', '5'];
    return in_array($age_rating, $valid_age_ratings);
}

function addGameToDB($db): void {
    if(isset($_POST['game-title']) && isset($_POST['game-genre']) && isset($_POST['game-platform']) && isset($_POST['game-age'])) {
        $gametitle = validateTitle($_POST['game-title']);
        if ($gametitle === false) {
            die("Invalid game title");
        }

        $gamegenre = $_POST['game-genre'];
        if (!validateGenre($gamegenre)) {
            die ("Invalid genre");
        }

        $gameplatform = $_POST['game-platform'];
        if (!validatePlatform($gameplatform)) {
            die ("Invalid platform");
        }

        $gameage = $_POST['game-age'];
        if (!validateAgeRating($gameage)) {
            die ("Invalid Age Rating");
        }

        $query = $db->prepare('INSERT INTO `videogames` (`name`, `genreid`, `platformid`, `ageid`, `image`)
    VALUES (:gametitle, :gamegenre, :gameplatform, :gameage, :image);'
        );

        $query->execute([
            'gametitle' => $gametitle,
            'gamegenre' => $gamegenre,
            'gameplatform' => $gameplatform,
            'gameage' => $gameage,
            'image' => 'img/placeholder.jpg'
        ]);
    }
}