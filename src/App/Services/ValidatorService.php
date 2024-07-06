<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\RequiredRule;
use Framework\Rules\EmailRule;
use Framework\Rules\MinRule;
use Framework\Rules\InRule;
use Framework\Rules\UrlRule;
use Framework\Rules\MatchRule;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('url', new UrlRule());
        $this->validator->add('match', new MatchRule());
    }

    public function validateRegister(array $data): void
    {
        $this->validator->validate(
            $data,
            [
                'username' => ['required'],
                'email' => ['required', 'email'],
                'age' => ['required','min:16'],
                'country' => ['required','in:Philippines,Malaysia,Singapore,Indonesia'],
                'password' => ['required'],
                'confirm_password' => ['required', 'match:password'],
                'tos' => ['required']
            ]
        );
    }
}
