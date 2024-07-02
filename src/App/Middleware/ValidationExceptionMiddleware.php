<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function handle(callable $next): void
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;
            $excluded = ['password', 'password_confirm'];
            $formattedOldFormData = array_diff_key(
                $oldFormData,
                array_flip($excluded)
            );
            $_SESSION['errors'] = $e->errors;
            $_SESSION['oldFormData'] = $formattedOldFormData;

            $refer = $_SERVER['HTTP_REFERER'] ?? "/";
            redirectTo($refer);
        }
    }
}
