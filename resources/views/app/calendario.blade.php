@extends('layaut.layaut')
@section('titulo','Calendario')
@section('contenido')
    <div class="container">
        <h1>Estamos en la vista Calendario</h1>

            <tr>
                <td>Dia: {{$calendario['dia']}}</td><br>
                <td>Hora de entrada: {{$calendario['hora_de_entrada']}}</td><br>
                <td>Hora de salida: {{$calendario['hora_de_salida']}}</td><br>
                <td>Total horas: {{$total_horas}}</td><br>

            </tr>

    </div>

@endsection
