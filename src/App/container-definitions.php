<?php

declare(strict_types=1);

use Framework\TemplateEngine;
use Framework\Database;
use App\Config\Paths;
use App\Services\ValidatorService;

return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn() => new ValidatorService(),
    Database::class => fn() => new Database('mysql', [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'movie_rentals_db',
    ], 'root', '')
];
