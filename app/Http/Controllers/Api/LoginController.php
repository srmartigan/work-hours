<?php

namespace App\Http\Controllers\Api;

use App\helper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->email) || !isset($request->password)) {
            return response()->json([
                'error' => 'Faltan argumentos',
                'status' => 400
            ],400);
        }

        if (!$this->validateLogin($request)) {
            return response()->json([
                'error' => 'Fallo al validar argumentos',
                'status' => 400
            ],400);
        }

        $email = $request->email;
        $password = hash('sha256', $request->password);

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
            'status' => 200,
        ],200);
    }

    protected function validateLogin(Request $request): bool
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required | email:rfc,dns',
            'password' => 'required | between:4,12',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

}
