<?php

namespace App\Domain;

class LoginNotFoundException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Login not found');
    }
}
