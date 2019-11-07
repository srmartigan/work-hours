@extends('layaut.layaut')
@section('titulo','Calendario')
@section('contenido')
    <div class="container">
        <h1>Estamos en la vista Calendario</h1>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha</th>
                <th scope="col">H/Entrada</th>
                <th scope="col">H/Salida</th>
                <th scope="col">Total Horas</th>
            </tr>
            </thead>
            <tbody>
            <?php $fila = 0 ?>
            @foreach($listadoDePartesDiario as $parteDiario)
                <tr>
                    <th scope="row">{{++$fila}}</th>
                    <td>{{$parteDiario->fecha}}</td>
                    <td>{{$parteDiario->HoraEntrada}}</td>
                    <td>{{$parteDiario->HoraSalida}}</td>
                    <td>{{$parteDiario->TotalHoras}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
