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
                            <div class="col-sm-4 col-lg-12 border mb-2">
                                <p class="text-center"><strong>DESCANSOS EN MINUTOS</strong></p>
                                {!! Field::number('almuerzo',$request[0]->descuento_almuerzo) !!}
                                {!! Field::number('comida',$request[0]->descuento_comida) !!}
                                {!! Field::number('merienda',$request[0]->descuento_merienda) !!}
                            </div>
                            <div class="col-sm-4 col-lg-12 border ">
                                <p class="text-center"><strong>PRECIO DE LAS HORAS</strong></p>
                                {!! Field::number('hora_normal',$request[0]->precio_hora,['step' => '0.1']) !!}
                                {!! Field::number('hora_estructurada',$request[0]->precio_hora_estructurada,['step' => '0.1']) !!}
                                {!! Field::number('hora_extra',$request[0]->precio_hora_extra,['step' => '0.1']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12 text-center mt-2">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-sm mr-1']) !!}
                            <a href="{{ url('/') }}" class="btn btn-success btn-sm ml-1">Cancelar</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
