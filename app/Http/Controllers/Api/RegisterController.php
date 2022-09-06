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

        $data = json_decode($request->json);

        //validamos los datos
        if (!$this->validateRegister($data)) {
            return response()->json([
                'error' => 'Error: Los datos introducídos no son válidos',
                'status' => 400
            ], 400);
        }

        try
        {
            $user = User::crearUsuario($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 400
            ], 400);
        }


        return response()->json([
            'mensaje' => 'Usuario registrado correctamente',
            'status' => 200
        ]);
    }

    private function validateRegister(mixed $data): bool
    {
        $validator = Validator::make((array)$data, [
            'nombre' => 'required',
            'email' => 'required | email:rfc,dns',
            'password' => 'required | between:4,12',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
