<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Validator;

/**
 * Trait Validation
 * Author: Chrisdion Andrew
 * Date: 6/10/2023
 */

trait Validation
{
    public function validate(array $inputs, array $rules): array
    {
        return Validator::make($inputs, $rules)->validate();
    }
}
