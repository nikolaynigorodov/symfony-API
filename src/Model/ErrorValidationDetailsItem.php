<?php

namespace App\Model;

class ErrorValidationDetailsItem
{

    public function __construct(private string $fields, private string $message)
    {
    }

    public function getFields(): string
    {
        return $this->fields;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}