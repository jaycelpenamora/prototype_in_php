<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;


class UserService
{

    public function __construct(private Database $database) {}

    public function isEmailTaken(string $email): void
    {
        $emailCount = $this->database->query(
            "SELECT COUNT(*) FROM users_T WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => 'Email already taken']);
        }
    }

    public function isUsernameTaken(string $username): void
    {
        $usernameCount = $this->database->query(
            "SELECT COUNT(*) FROM users_T WHERE username = :username",
            [
                'username' => $username
            ]
        )->count();

        if ($usernameCount > 0) {
            throw new ValidationException(['username' => 'Username already taken']);
        }
    }

    public function createUser(array $formData): void
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->database->query(
            "INSERT INTO users_T(username, email, password, age, country) 
            VALUES (:username, :email, :password, :age, :country)",
            [
                'username' => $formData['username'],
                'email' => $formData['email'],
                'password' => $password,
                'age' => $formData['age'],
                'country' => $formData['country'],
            ]
        );

        session_regenerate_id();

        $_SESSION['user_id'] = $this->database->id();
        $_SESSION['user_name'] = $formData['username'];
    }

    public function login(array $formData): void
    {
        $user = $this->database->query(
            "SELECT * FROM users_T WHERE email = :identifier OR username = :identifier",
            [
                'identifier' => $formData['email_username'],
            ]
        )->find();

        $passwordsMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Invalid credentials']]);
        }

        session_regenerate_id();

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['username'];

    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);

        session_destroy();

        session_regenerate_id();
        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
}
