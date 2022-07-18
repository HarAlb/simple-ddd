<?php

namespace App\Api\Base\Responses\Messages;

class ErrorsMessage
{
    public bool $success;
    public array $errors;

    public function __construct(array $errors)
    {
        $this->success = false;
        if ($errors) {
            $this->errors = $errors;
        }
    }
}
