<?php

namespace App\Exception;

use RuntimeException;

class SubscriberAlreadyExistException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Subscriber already exist');
    }
}
