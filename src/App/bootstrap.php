<?php

declare(strict_types=1);

namespace App;

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Controllers\HomeController;

$app = new App();

$app->get('/', [HomeController::class, 'home']);
$app->get('/about.php', [HomeController::class, 'home']);

return $app;
