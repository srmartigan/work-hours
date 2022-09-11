<?php

namespace App\Services;

use App\Domain\Dto\LoginDto;
use App\Domain\Dto\TokenDto;
use App\Domain\LoginNotFoundException;
use App\Models\Helper;
use App\Models\User;

class UserLoginService
{
     public function execute(LoginDto $loginDto): TokenDto
     {
         try
         {
             $user = User::query()->where([
                 'email' => $loginDto->email(),
                 'password' => hash('sha256', $loginDto->password())
             ])->firstOrFail();
         }catch (\Exception $e)
         {
             throw new LoginNotFoundException();
         }

         $token = Helper::crearToken($user);

         return new TokenDto($user->id, $token);
     }

}
