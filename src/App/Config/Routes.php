<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;

function registerRoutes(App $app): void
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/login', [LoginController::class, 'login']);
    $app->get('/logout', [LogoutController::class, 'logout']);
    $app->get('/register', [RegisterController::class, 'register']);
}
