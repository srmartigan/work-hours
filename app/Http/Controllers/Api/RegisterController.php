<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->nombre) || !isset($request->email) || !isset($request->password)){
            return response(
                $error = 'error faltan parametros',
                $status = 400
            );
        }

        $nombre = $request->nombre;
        $email = $request->email;
        $password = $request->password;

        return response(
            $contend = $nombre . ' ' . $email . ' ' . $password ,
            $status = 200,
        );
    }
}
