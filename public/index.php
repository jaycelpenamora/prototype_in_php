<?php

// phpinfo();
include __DIR__ . "/../src/App/functions.php";

// dd(PDO::getAvailableDrivers());

$app = include __DIR__ . "/../src/App/bootstrap.php";

$app->run();


