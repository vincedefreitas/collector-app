<?php
require_once 'src/db.php';
require_once 'src/functions.php';

$db = connectToDB();

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
</head>
<body>
<div class="title">
    <h1>Vince's Game Collection</h1>
</div>
<div class="form-container">
    <form action="src/formdata.php" method="post">
        <label for="game-title">Game Title:</label>
        <input type="text" id="game-title" name="game-title" placeholder="e.g. Elden Ring">
        <label for="game-genre">Genre:</label>
        <select name="game-genre" id="game-genre">
            <option value="1">Action/Adventure</option>
            <option value="2">Platformer</option>
            <option value="3">Fighting</option>
            <option value="4">Puzzle</option>
            <option value="5">JRPG</option>
        </select>
        <label for="game-platform">Genre:</label>
        <select name="game-platform" id="game-platform">
            <option value="1">PS5</option>
            <option value="2">PS4</option>
            <option value="3">Xbox Series S</option>
            <option value="4">Nintendo Switch</option>
            <option value="5">Nintendo 3DS</option>
            <option value="6">PS3</option>
            <option value="7">PC</option>
            <option value="8">Xbox 360</option>
        </select>
        <label for="game-age">Age:</label>
        <select name="game-age" id="game-age">
            <option value="1">3</option>
            <option value="2">7</option>
            <option value="3">12</option>
            <option value="4">16</option>
            <option value="5">18</option>
        </select>
        <input type="submit" value="Add to Collection">
    </form>
</div>
<div class="card-container">
    <?php
        try {
            $videogames = getAllGames($db);
            echo displayAllGames($videogames);
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    ?>
</div>
</body>
</html>