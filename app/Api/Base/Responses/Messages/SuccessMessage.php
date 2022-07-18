<?php

namespace App\Api\Base\Responses\Messages;

class SuccessMessage
{
    public $data;
    public string $time;

    public function __construct($data)
    {
        $this->data = $data;
        $this->time = microtime(true) - LARAVEL_START;
    }
}
