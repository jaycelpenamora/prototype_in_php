<?php

$driver = "mysql";

$config = http_build_query(data: [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'test'
], arg_separator: ';');

$dsn = "{$driver}:{$config}";
$username = 'root';
$password = '';

$db = new PDO($dsn, $username, $password);
// $db = new PDO("mysql:host=localhost;port=3306;dbname=user_db", 'root', '');

echo "Database connection established successfully\n";
