<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class LogoutController
{

    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function logout(): void
    {
        echo $this->view->render("/logout.php", [
            'title' => 'Logout Page'
        ]);
    }
}
