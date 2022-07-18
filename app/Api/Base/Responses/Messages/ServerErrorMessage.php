<?php

namespace App\Api\Base\Responses\Messages;

class ServerErrorMessage
{
    public string $error;
    public array $errors;

    public function __construct(?string $message = null, ?array $errors = null)
    {
        $this->success = false;
        if ($message) {
            $this->error = $message;
        }
        if ($errors) {
            $this->errors = $errors;
        }
    }
}
