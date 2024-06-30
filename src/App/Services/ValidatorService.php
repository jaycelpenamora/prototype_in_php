<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\RequiredRule;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->add('required', new RequiredRule());
    }

    public function validateRegister(array $data): void
    {
        $this->validator->validate(
            $data,
            [
                'email' => ['required'],
                'age' => ['required'],
                'country' => ['required'],
                'social_media_url' => ['required'],
                'password' => ['required'],
                'confirm_password' => ['required'],
                'tos' => ['required']
            ]
        );
    }
}
