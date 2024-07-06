<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\AuthController;

function registerRoutes(App $app): void
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/login', [AuthController::class, 'login']);
    $app->get('/logout', [AuthController::class, 'logout']);
    $app->get('/register', [AuthController::class, 'registerView']);
    $app->post('/register', [AuthController::class, 'register']);
}
