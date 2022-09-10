<?php

namespace App\Services;

use App\Domain\Dto\RegisterDto;
use App\Domain\RegisterNotFoundException;
use App\Models\ConfiguracionUsuario;
use App\Models\User;

class UserRegisterService
{
    private ConfiguracionUsuario $configuracionUsuario;

    public function __construct()
    {
        $this->configuracionUsuario = new ConfiguracionUsuario();
    }

    public function execute(RegisterDto $registerDto): void
    {
            $user = User::crearUsuario($registerDto);
            $this->configuracionUsuario->create($user['id']);
    }
}
