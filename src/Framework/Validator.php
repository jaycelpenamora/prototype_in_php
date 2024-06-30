<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;

class Validator
{
    private array $rules = [];

    public function add(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $data, array $fields): void
    {
        $errors = [];
        foreach ($fields as $field => $rules) {
            foreach ($rules as $rule) {
                $ruleValidator = $this->rules[$rule];

                if ($ruleValidator->validate($data, $field, [])) {
                    continue;
                }

                $errors[$field][] = $ruleValidator->getMessage($data, $field, []);
            }
        }

        if (count($errors)) {
            dd($errors);
        }
    }
}
