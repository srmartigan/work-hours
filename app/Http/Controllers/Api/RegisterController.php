<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {

         //TODO: Falta añadir que se cree la configuracion del usuario nuevo registrado

        $datos = json_decode($request->json);

        if (!$this->ComprobarDatos($datos)){
            return response(
                $error = 'error faltan parametros',
                $status = 400
            );
        }

        if (!$this->validateLogin($datos)) {
            return response()->json([
                'error' => 'Fallo al validar argumentos',
                'status' => 400
            ], 400);
        }

        $usuario = User::crearUsuario($datos);

        return response(
            $mensaje = 'Usuario registrado correctamente',
            $status = 200
        );
    }

    function ComprobarDatos($datos)
    {
        if (!isset($datos->nombre) || !isset($datos->email) || !isset($datos->password)){
            return false;
        }

        return true;
    }

    protected function validateLogin($datos): bool
    {
        $validator = Validator::make((array)$datos, [
            'nombre' => 'required',
            'email' => 'required | unique:users',
            'password' => 'required | between:4,12',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
