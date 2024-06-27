<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class LoginController
{

    public function __construct(private TemplateEngine $view)
    {
    }

    public function login(): void
    {
        echo $this->view->render("/login.php", [
            'title' => 'Login'
        ]);
    }
}
