<?php

declare(strict_types=1);

namespace App;

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;

$app = new App();

$app->get('/', [HomeController::class, 'home']);
$app->get('/about', [AboutController::class, 'about']);
$app->get('/login', [LoginController::class, 'login']);
$app->get('/register', [RegisterController::class, 'register']);
$app->get('/logout', [LogoutController::class, 'logout']);

return $app;
