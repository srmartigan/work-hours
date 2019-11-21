@extends('layouts.layout')
@section('titulo','Inicio')
@section('contenido')
    <div class="container">
        <!-- Formulario Parte Diario simple -->
        <div class="row">
            <div class="container col-md-4 col-md-offset-4 border border-dark mt-5 p-5 bg-light rounded">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="text-center">CONFIGURACION</h3></div>
                    <hr>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'guardar-configuracion-usuario','method' => 'post']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 col-lg-12">
                                <p>Minutos que duran los descansos</p>
                                {!! Field::number('almuerzo',$request[0]->descuento_almuerzo) !!}
                                {!! Field::number('comida',$request[0]->descuento_comida) !!}
                                {!! Field::number('merienda',$request[0]->descuento_merienda) !!}
                            </div>
                            <hr>
                        </div>
                        <div class="col-sm-12 text-center">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                            <a href="{{ url('/') }}" class="btn btn-success">Cancelar</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
