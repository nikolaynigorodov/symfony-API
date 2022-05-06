<?php

namespace App\Model;

class ErrorValidationDetails
{
    private array $violation = [];

    /**
     * @var ErrorValidationDetailsItem[]
     */
    public function addViolation(string $fields, string $message): void
    {
        $this->violation[] = new ErrorValidationDetailsItem($fields, $message);
    }

    /**
     * @return ErrorValidationDetailsItem[]
     */
    public function getViolation(): array
    {
        return $this->violation;
    }
}