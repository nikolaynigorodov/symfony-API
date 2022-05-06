<?php

namespace App\Model;

class ErrorValidationDetails
{
    private array $violations = [];

    public function addViolation(string $field, string $message): void
    {
        $this->violations[] = new ErrorValidationDetailsItem($field, $message);
    }

    /**
     * @return ErrorValidationDetailsItem[]
     */
    public function getViolation(): array
    {
        return $this->violations;
    }
}