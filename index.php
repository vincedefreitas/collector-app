<?php
require_once 'src/db.php';
require_once 'src/functions.php';

$db = connectToDB();
addGameToDB($db);

try {
    $genre_table = getTable("genre", $db);
    $platform_table = getTable("platform", $db);
    $age_table = getTable("agerating", $db);
} catch (ErrorException $e) {
    echo 'Message: ' .$e->getMessage();
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
            <input type="text" id="game-title" name="game-title" maxlength="100" pattern="^[a-zA-Z0-9\s:!]+$" placeholder="e.g. Elden Ring" required>
        </div>
        <div class="form-group">
            <label for="game-genre">Genre:</label>
            <select name="game-genre" id="game-genre" required>
                <option value="" disabled selected>Select Genre</option>
                <?php echo setDropdownOptions($genre_table, "genre"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="game-platform">Platform:</label>
            <select name="game-platform" id="game-platform" required>
                <option value="" disabled selected>Select Platform</option>
                <?php echo setDropdownOptions($platform_table, "platform"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="game-age">Age Rating:</label>
            <select name="game-age" id="game-age" required>
                <option value="" disabled selected>Select Age Rating</option>
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