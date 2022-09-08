<?php

namespace App\Http\Controllers\Api;

use App\ConfiguracionUsuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class ConfiguracionController extends Controller
{
    public function verConfiguracion(RequestAuth $request): JsonResponse
    {
        $id = $request->id;

        $config = ConfiguracionUsuario::query()
            ->where('userId', $id)
            ->get();

        return response()->json([
            'json' => $config,
            'status' => 'success',
            'message' => 'configuración enviada correctamente'
        ], 200);
    }

    function guardarConfiguracion(RequestAuth $request): JsonResponse
    {
        $id = $request->id;
        $datos = json_decode($request->json);

        if(!$this->validateConfiguracion($datos))
        {
            return response()->json([
                'error' => 'Error: Los datos introducídos no son válidos',
                'status' => 400
            ], 400);
        }

        $config = ConfiguracionUsuario::query()
            ->where('userId', '=', $id);

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

    private function validateConfiguracion(mixed $datos): bool
    {
        $validator = Validator::make((array)$datos, [
            'descuentoAlmuerzo' => 'required | numeric',
            'descuentoComida' => 'required | numeric',
            'descuentoMerienda' => 'required | numeric',
            'precioHora' => 'required | numeric',
            'precioHoraEstructurada' => 'required | numeric',
            'precioHoraExtra' => 'required | numeric',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

}
