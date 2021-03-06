<?php

namespace App\Http\Controllers;

use App\ConfiguracionUsuario;
use App\Helper;
use App\ParteDiario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class ParteDiarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('app.formularioParteDiario');
    }

    public function incluir(Request $request)
    {

       $parteDiario = new ParteDiario();
       $parteDiario->userId = Auth::id();
       $parteDiario->fecha = $request->fecha;
       $parteDiario->HoraEntrada = $request->hora_de_entrada;
       $parteDiario->HoraSalida = $request->hora_de_salida;
       $parteDiario->almuerzo = $request->almuerzo;
       $parteDiario->comida = $request->comida;
       $parteDiario->merienda = $request->merienda;
       $parteDiario->TotalHoras = Helper::calcularTotalHorasParteDiario($request, User::find(Auth::id())->configuracion);
       $parteDiario->save();

        return view('app.inicio');
    }

    public function editar(Request $request)
    {
        // TODO: Añadir logica para editar los partes diarios.
    }

}
