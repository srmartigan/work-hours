<?php

namespace App\Domain;

class ParteNotFoundException extends \DomainException
{
    public function __construct($message = 'Parte no encontrado')
    {
        parent::__construct($message);
    }
}

