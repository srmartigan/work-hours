@extends('layaut.layaut')
@section('titulo','Inicio')
@section('contenido')
    <div class="container">
        <h1>Estamos en el HOME</h1>
        <a href="{{url('calendario')}}">ir a Calendario</a>
    </div>

@endsection
