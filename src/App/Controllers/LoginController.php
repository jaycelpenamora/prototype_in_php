<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class LoginController
{

    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function login(): void
    {
        echo $this->view->render("/login.php", [
            'title' => 'Login Page'
        ]);
    }
}
