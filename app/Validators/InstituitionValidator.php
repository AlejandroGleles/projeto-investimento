<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstituitionValidator.
 *
 * @package namespace App\Validators;
 */
class InstituitionValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|string|max:255',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
