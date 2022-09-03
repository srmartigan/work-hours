<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    function index(){
        return 'Hola Mundo';
        $user = Auth::user();
        if ($user != null){
            return view('app.inicio');
        }
        return view('auth.login');
    }
}
