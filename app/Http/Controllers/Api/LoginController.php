<?php

namespace App\Http\Controllers\Api;


use App\Domain\Dto\LoginDto;
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

        $json = json_decode($request['json'], true);

        if (!$this->validateLogin($json)) {
            return response()->json([
                'error' => 'Error: Los datos introducídos no son válidos',
                'status' => 400
            ], 400);
        }

        try {
              $tokenDto = $userLoginService->execute(LoginDto::create(...$json));

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 400
            ], 400 );
        }

        return response()->json([
            'token' => $tokenDto->valueToken(),
            'id' => $tokenDto->valueId(),
            'status' => 200,
        ]);
    }

    protected function validateLogin($json): bool
    {
        $validator = Validator::make($json, [
            'email' => 'required | email:rfc,dns',
            'password' => 'required | between:4,12',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

}
