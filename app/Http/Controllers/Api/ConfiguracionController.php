<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionUsuario;
use App\Models\Helper;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    function verConfiguracion(Request $request)
    {
        //Validar Toquen --------------------------
        $token = $request->header('token');

        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'error autorizacion'
            ], 401);
        }
        //fin validar Toquen-------------------------

        $config = ConfiguracionUsuario::query()
            ->where('userId', '=', $objectToken->id)
            ->get();

        if ($config == null) {
            $config = new ConfiguracionUsuario();
            $config->userId = $objectToken->id;
            $config->descuento_almuerzo = 0;
            $config->descuento_comida = 0;
            $config->descuento_merienda = 0;
            $config->precio_hora = 0;
            $config->precio_hora_estructurada = 0;
            $config->precio_hora_extra = 0;
            $config->save();
        }

        return response()->json([
           'json' => $config,

        ], 200);
    }

    function guardarConfiguracion(Request $request)
    {
        $datos = json_decode($request->json);

        $objectToken = Helper::validarToken($request);

        $config = ConfiguracionUsuario::query()
            ->where('userId', '=', $objectToken->id);

        $config->update([
            'descuento_almuerzo' => $datos->descuentoAlmuerzo,
            'descuento_comida' => $datos->descuentoComida,
            'descuento_merienda' => $datos->descuentoMerienda,
            'precio_hora' => $datos->precioHora,
            'precio_hora_estructurada' => $datos->precioHoraEstructurada,
            'precio_hora_extra' => $datos->precioHoraExtra
        ]);

        return response()->json([

            'status' => 'success'
        ]);
    }

}
