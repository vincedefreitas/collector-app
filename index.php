<?php
require_once 'src/db.php';

$db = connectToDB();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$query = $db->prepare('SELECT * FROM `videogames`;');
$result = $query->execute();

if ($result) {
    $videogames = $query->fetchAll();
//    echo '<pre>';
//    var_dump($videogames);
}

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
<div>
    <?php
        foreach ($videogames as $game) {
            echo "<p>Game: {$game['name']}</p>";
            echo "<p>Genre: {$game['genre']}</p>";
            echo "<p>Platform: {$game['platform']}</p>";
            echo "<p>Age Rating: {$game['agerating']}</p>";
            echo '<br>';
        }
    ?>
</div>

</body>
</html>