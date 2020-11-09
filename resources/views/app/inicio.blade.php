@extends('layouts.layout')
@section('titulo','Inicio')
@section('contenido')
    @guest
        <div class="container">
            <h1>Estamos en el HOME "Sin REgistrar ..."</h1>
            <a href="{{url('calendario')}}">ir a Calendario</a>
        </div>
    @else
        <div class="container">

            <a href="{{url('calendario')}}">ir a  Calendario</a>
        </div>
    @endguest

@endsection
