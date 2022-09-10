<?php

namespace App\Http\Requests;

use App\Models\Helper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RequestAuth extends FormRequest
{

    protected $redirectAction = 'Api\HomeController@error';
 protected $redirectRoute = 'api.home.error';
 protected $redirect = '';
    public function authorize(Request $request): bool
    {
        $token = $request->header('token');

        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return false;
        }

        $this->merge(['id' => $objectToken->id]);


        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(
            'No estas autorizado'
        );
    }




}
