<?php

namespace App\Exceptions;

use Exception;

class ValidateException extends Exception
{
    private $validatorResult;

    public function __construct($validatorResult)
    {
        $this->validatorResult = $validatorResult;
    }

    public function render()
    {
        return response()->json($this->validatorResult, 422);
    }
}
