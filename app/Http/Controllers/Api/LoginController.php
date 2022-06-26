<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\JsonDecoder;


class LoginController extends Controller
{
    /*
     * Requiere un email y un password para iniciar sesión.
     * Si el usuario existe, se crea un token y se lo devuelve.
     * El password tiene que tener entre 4 y 12 caracteres para ser validado.
     */
    public function index(Request $request): JsonResponse
    {

        $datos = json_decode($request['json']);

        if (!$this->validarLogin((array)$datos)) {
            return response()->json([
                'error' => 'Fallo al validar argumentos 1',
                'status' => 400
            ], 400);
        }

        try {
            $user = $this->ObtenerUsuario($datos);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Los datos introducidos son erroneos',
                'status' => 400
            ], 401);
        }

        return response()->json([
            'token' => Helper::crearToken($user),
            'id' => $user->id,
            'status' => 200,
        ], 200);
    }

    protected function validarLogin(array $datos): bool
    {

        if (!isset($datos['email']) || !isset($datos['password'])) {
            return false;
        }

        $esValido = Validator::make($datos, [
            'email' => 'required|email',
            'password' => 'required|min:4|max:12'
        ]);

        return !$esValido->fails();
    }

    public function ObtenerUsuario(mixed $datos): User
    {
        $email = $datos->email;
        $password = hash('sha256', $datos->password);
//dd($password, $email);
        $user = User::where('email', $email)->where('password', $password)->first();

        if (is_null($user)) {
            throw new \Exception('Los datos introducidos son erroneos');
        }
        return $user;
    }


}
