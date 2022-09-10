<?php

namespace App\Services;

use App\Domain\Dto\TokenDto;
use App\Domain\LoginNotFoundException;
use App\Models\Helper;
use App\Models\User;

class UserLoginService
{
     public function execute(string $email, string $password): TokenDto
     {
         try
         {
             $user = User::query()->where([
                 'email' => $email,
                 'password' => $password
             ])->firstOrFail();
         }catch (\Exception $e)
         {
             throw new LoginNotFoundException();
         }

         $token = Helper::crearToken($user);

         return new TokenDto($user->id, $token);
     }

}
