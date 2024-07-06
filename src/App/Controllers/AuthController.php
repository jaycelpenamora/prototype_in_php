<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ ValidatorService, UserService };

class AuthController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
    }

    public function registerView(): void
    {
        echo $this->view->render("register.php");
    }

    public function register(): void
    {
        $this->validatorService->validateRegister($_POST);

        $this->userService->isEmailTaken($_POST['email']);
        
        $this->userService->isUsernameTaken($_POST['username']);

        $this->userService->createUser($_POST);

        redirect("/");
    }
    
    public function login(): void
    {
        echo $this->view->render("login.php");
    }

    public function logout(): void
    {
        session_destroy();
        redirect("/");
    }   
}
