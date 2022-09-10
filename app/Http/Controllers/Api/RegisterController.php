<?php

namespace App\Http\Controllers\Api;

use App\Models\ConfiguracionUsuario;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Domain\Dto\RegisterDto;
use App\Services\UserRegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function index(
        Request              $request,
        ConfiguracionUsuario $configuracionUsuario,
        UserRegisterService  $userRegisterService
    ): JsonResponse
    {
        $registeDto = RegisterDto::create(...json_decode($request['json'], true));

        //validamos los datos
        if (!$this->validateRegister($registeDto)) {
            return response()->json([
                'error' => 'Error: Los datos introducídos no son válidos',
                'status' => 400
            ], 400);
        }


        try {
            $userRegisterService->execute($registeDto);
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

    private function validateRegister(RegisterDto $data): bool
    {
        $validator = Validator::make($data->toArray(), [
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
