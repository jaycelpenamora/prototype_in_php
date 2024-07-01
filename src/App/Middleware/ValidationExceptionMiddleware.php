<?php

declare(strict_types=1);

namespace App\Middleware\ValidationExceptionMiddleware;

use App\Middleware\TemplateDataMiddleware;
use Framework\Exceptions\ValidationException;
use Framework\TemplateEngine;

class ValidationExceptionMiddleware implements TemplateDataMiddleware
{
    public function __construct(private TemplateEngine $view){

    }

    public function handle(callable $next): void
    {
        try{
            $next();
        }
        catch(ValidationException $e){
            dd($e);
        }
    }
}
