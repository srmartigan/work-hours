<?php

namespace App\Domain;

class RegisterNotFoundException extends \DomainException
{
    public function __construct($message = 'Register not found')
    {
        parent::__construct($message);
    }
}
