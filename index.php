<?php
require_once 'src/db.php';
require_once 'src/functions.php';


$db = connectToDB();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video Game Collection</title>
    <link rel="stylesheet" href="modern-normalize.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="card-container">
    <?php
        try {
            $videogames = getAllVideoGames($db);
            echo displayAllVideoGames($videogames);
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    ?>
</div>
</body>
</html>