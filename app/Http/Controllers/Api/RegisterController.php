<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request)
    {

         //TODO: Cuando alguien se registre crearemos el usuario y su configuracion
         //Falta crear la configuracion y comprobar que no se repiten los email

        $datos = json_decode($request->json);

        if (!$this->ComprobarDatos($datos)){
            return response(
                $error = 'error faltan parametros',
                $status = 400
            );
        }

        $nombre = $datos->nombre;
        $email = $datos->email;
        $password = $datos->password;

        $usuario = User::crearUsuario($nombre, $email, $password);

        return response(
            $contend = $usuario->name . ' ' . $usuario->email . ' ' . $usuario->password ,
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
}
