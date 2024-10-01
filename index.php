<?php
require_once 'src/db.php';
require_once 'src/functions.php';

$db = connectToDB();


try {
    $genre_table = getGenreTable($db);
    $platform_table = getPlatformTable( $db);
    $age_table = getAgeRatingTable($db);
} catch (ErrorException $e) {
    echo 'Message: ' .$e->getMessage();
}

if(isset($_POST['game-title']) && isset($_POST['game-genre']) && isset($_POST['game-platform']) && isset($_POST['game-age'])) {
    $gametitle = validateTitle($_POST['game-title']);
    if ($gametitle === false) {
        $titlemessage = "Invalid Game Title";
    }

    $gamegenre = $_POST['game-genre'];
    if (!validateGenre($gamegenre, $db)) {
        $genremessage = "Invalid Genre";
    }

    $gameplatform = $_POST['game-platform'];
    if (!validatePlatform($gameplatform, $db)) {
        $platform_message = "Invalid Platform";
    }

    $gameage = $_POST['game-age'];
    if (!validateAgeRating($gameage, $db)) {
        $agemessage = "Invalid Age Rating";
    }
    if ($gametitle && validateGenre($gamegenre, $db) && validatePlatform($gameplatform, $db) && validateAgeRating($gameage, $db) ) {
        $data = [
                "gametitle" => $gametitle,
                "gamegenre" => $gamegenre,
                "gameplatform" => $gameplatform,
                "gameage" => $gameage
        ];
        addGameToDB($db, $data);
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vince's Video Game Collection</title>
    <link rel="stylesheet" href="modern-normalize.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<div class="title">
    <h1>Vince's Game Collection</h1>
</div>
<div class="form-container">
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="game-title">Game Title:</label>
            <?php
            if (isset($titlemessage)) {
                echo "<input type='text' class='red' id='game-title' name='game-title' maxlength='100' value={$titlemessage} required>";
            } else echo '<input type="text" id="game-title" name="game-title" maxlength="100" placeholder="e.g. Elden Ring" required>';
            ?>
        </div>
        <div class="form-group">
            <label for="game-genre">Genre:</label>
                <?php
                if (isset($genremessage)) {
                    echo "<select name='game-genre' class='red' id='game-genre' required><option value='' disabled selected>$genremessage</option>";
                } else echo '<select name="game-genre" id="game-genre" required> <option value="" disabled selected>Select Genre</option>';
                ?>
                <?php echo setDropdownOptions($genre_table, "genre"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="game-platform">Platform:</label>
            <?php
                if (isset($platform_message)) {
                    echo "<select name='game-platform' class='red' id='game-platform' required><option value='' disabled selected>$platform_message</option>";
                } else echo '<select name="game-platform" id="game-platform" required> <option value="" disabled selected>Select Platform</option>';
                ?>
            <?php echo setDropdownOptions($platform_table, "platform"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="game-age">Age Rating:</label>
            <?php
                if (isset($agemessage)) {
                    echo "<select name='game-age' class='red' id='game-age' required><option value='' disabled selected>$agemessage</option>";
                } else echo '<select name="game-age" id="game-age" required> <option value="" disabled selected>Select Age Rating</option>';
                ?>
            <?php echo setDropdownOptions($age_table, "agerating"); ?>
            </select>
        </div>
        <input class="btn" type="submit" value="Add to Collection">
    </form>
</div>
<div class="card-container">
    <?php
        try {
            $videogames = getAllGames($db);
            echo displayAllGames($videogames);
        } catch (ErrorException $e) {
            echo 'Message: ' .$e->getMessage();
        }
    ?>
</div>
</body>
</html>