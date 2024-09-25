<?php
function connectToDB(): object {
    $db = new PDO(
        'mysql:host=DB;dbname=collectorapp', // DSN
        'root', // username
        'password' // password
    );

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $db;

}
