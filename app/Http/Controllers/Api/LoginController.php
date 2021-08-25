<?php

namespace App\Http\Controllers\Api;

use App\Helper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
     *  requiere un email y un password para loguearse
     */
    public function index(Request $request)
    {
        $datos = json_decode($request->json);

        if (!isset($datos->email) || !isset($datos->password)) {
            return response()->json([
                'error' => 'Faltan argumentos',
                'status' => 400
            ],400);
        }

        if (!$this->validateLogin($datos)) {
            return response()->json([
                'error' => 'Fallo al validar argumentos',
                'status' => 400
            ],400);
        }

        $email = $datos->email;
        $password = hash('sha256', $datos->password);

        $user = User::query()->where([
            'email' => $email,
            'password' => $password
        ])->first();

        if ($user == null) {
            return response()->json([
                'error' => 'No existe ningun usuario con esos datos',
                'status' => 400
            ], 400) ;
        };


        return response()->json([
            'token' => Helper::crearToken($user),
            'id' => $user->id,
            'status' => 200,
        ]);
    }

    protected function validateLogin($datos): bool
    {
        $validator = Validator::make((array) $datos, [
            'email' => 'required | email:rfc,dns',
            'password' => 'required | between:4,12',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

}
