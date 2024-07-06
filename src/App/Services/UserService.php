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

        if($emailCount > 0){
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

        if($usernameCount > 0){
            throw new ValidationException(['username' => 'Username already taken']);
        }
    }

    public function createUser(array $formData): void
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->database->query(
            "INSERT INTO users_T (email, password, age, country, social_media_url) VALUES (:email, :password, )",
            [
                'email' => $formData['email'],
                'password' => $password,
                'age' => $formData['age'],
                'country' => $formData['country'],
                'social_media_url' => $formData['social_media_url']
            ]
        );
    }

}
