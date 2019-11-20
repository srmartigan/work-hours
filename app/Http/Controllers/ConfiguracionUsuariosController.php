<?php

namespace App\Http\Controllers;

use App\ConfiguracionUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionUsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $config = null;
        $idUsuarioConfiguracion = ConfiguracionUsuario::query()
            ->where('userId','=',Auth::id())
            ->value('userId');

        if ($idUsuarioConfiguracion == null){
            $config = new ConfiguracionUsuario();
            $config->userId = Auth::id();
            $config->descuento_almuerzo = 0;
            $config->descuento_comida = 0;
            $config->descuento_merienda = 0;
            $config->save();
        }
            $config = ConfiguracionUsuario::query()
                ->where('userId','=',Auth::id())
                ->get();


        return view('app.configuracionUsuario')->with([
            'request' => $config
        ]);
    }

    public function guardar(Request $request)
    {
        $idUsuarioConfiguracion = ConfiguracionUsuario::query()
            ->where('userId','=',Auth::id());

        $idUsuarioConfiguracion->update([
            'descuento_almuerzo' => $request->almuerzo,
            'descuento_comida' => $request->comida,
            'descuento_merienda' => $request->merienda
        ]);

        return view('app.inicio');
    }
}
