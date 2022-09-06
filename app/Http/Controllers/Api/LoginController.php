<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\UserLoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /*
     *  requiere un email y un password para loguearse
     */
    public function index(Request $request, UserLoginService $userLoginService)
    {

        $datos = json_decode($request->json);

        if (!$this->validateLogin($datos)) {
            return response()->json([
                'error' => 'Error: Los datos introducídos no son válidos',
                'status' => 400
            ], 400);
        }

        try {
            $email = $datos->email;
            $password = hash('sha256', $datos->password);
            $tokenDto = $userLoginService->execute($email, $password);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No existe ningun usuario con esos datos',
                'status' => 400
            ], 400 );
        }

        return response()->json([
            'token' => $tokenDto->valueToken(),
            'id' => $tokenDto->valueId(),
            'status' => 200,
        ]);
    }

    protected function validateLogin($datos): bool
    {
        $validator = Validator::make((array)$datos, [
            'email' => 'required | email:rfc,dns',
            'password' => 'required | between:4,12',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

}
