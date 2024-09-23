<?php
function connectToDB() {
    return new PDO(
        'mysql:host=DB;dbname=collectorapp', // DSN
        'root', // username
        'password' // password
    );

}
