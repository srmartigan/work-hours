@extends('layouts.layout')
@section('titulo','Calendario')
@section('contenido')
    <div class="container">

        <div class="table-responsive">
            <h1>Listado Calendario</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="th-lg">Fecha</th>
                    <th scope="col" class="th-lg">H/E</th>
                    <th scope="col" class="th-lg">H/S</th>
                    <th scope="col" class="th-lg">T/H</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listadoDePartesDiario as $key => $parteDiario)
                    <tr>
                        <th scope="row">{{ ++$key + (($listadoDePartesDiario->currentPage() - 1 ) * $listadoDePartesDiario->perPage())  }}</th>
                        <td class="th-lg">{{$parteDiario->fecha}}</td>
                        <td class="th-lg">{{$parteDiario->HoraEntrada}}</td>
                        <td class="th-lg">{{$parteDiario->HoraSalida}}</td>
                        <td class="th-lg">{{$parteDiario->TotalHoras}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $listadoDePartesDiario->links() }}
        </div>

    </div>

@endsection
