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