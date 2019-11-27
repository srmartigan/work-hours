@extends('layouts.layout')
@section('titulo','Documentos')
@section('contenido')
    <div class="container">

        <h2 class="text-center mt-3">Documentos</h2>
        <hr>
        <form action="{{url('documentos')}}" method="post" class=" text-center mb-2">
            @csrf
            <label for="filtros">Filtro</label>
            <select class="form-control-sm" name="mes" id="filtroMes">
                <option value="0" >Mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <input type="submit" class="btn btn-success btn-sm" value="Filtrar"></input>
        </form>

        <div class="table-responsive-sm small">
            <table class="table table-bordered table-sm">
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
                        <th class=""
                            scope="row">{{ ++$key + (($listadoDePartesDiario->currentPage() - 1 ) * $listadoDePartesDiario->perPage())  }}</th>
                        <td class="th-lg">{{$parteDiario->fecha}}</td>
                        <td class="th-lg">{{$parteDiario->HoraEntrada}}</td>
                        <td class="th-lg">{{$parteDiario->HoraSalida}}</td>
                        <td class="th-lg">{{$parteDiario->TotalHoras}}</td>
                        <!--td class="th-lg">{{$parteDiario->userId}}</td -->
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $listadoDePartesDiario ->links() }}
        </div>
        <div class="row">
            <h6 class="col-sm-12">Total Dias Trabajados: {{$listadoDePartesDiario->total()}}</h6>
            <h6 class="col-sm-12">Total Horas Normales: {{$totalHoras}} </h6>
            <h6 class="col-sm-12">Total: {{$total}} € </h6>

        </div>

    </div>
@endsection
