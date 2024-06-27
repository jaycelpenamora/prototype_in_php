<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class LogoutController
{


    public function __construct(private TemplateEngine $view)
    {
    }

    public function logout(): void
    {
        echo $this->view->render("/logout.php", [
            'title' => 'Logout'
        ]);
    }
}
