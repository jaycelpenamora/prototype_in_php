<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'movie_rentals_db',
], 'root', '');

$sqlFile = file_get_contents("./construct_tables.sql");

$db->connection->query($sqlFile);
