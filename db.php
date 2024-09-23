<?php

$db = new PDO(
    'mysql:host=DB;dbname=collectorapp', // DSN
    'root', // username
    'password' // password
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT * FROM `videogames`;");
$result = $query->execute();

if ($result) {
    $videogames = $query->fetchAll();
    echo '<pre>';
    var_dump($videogames);
}