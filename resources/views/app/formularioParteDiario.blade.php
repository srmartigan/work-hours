@extends('layouts.layout')
@section('titulo','Parte Diario')
@section('contenido')
    <!-- Formulario Parte Diario simple -->
    <div class="row">
        <div class="container col-md-4 col-md-offset-4 border border-dark mt-5 p-5 bg-light rounded">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center">PARTE DIARIO</h3></div>
                <hr>
                <div class="panel-body">
                    {!! Form::open(['url' => 'incluir-parte-diario','method' => 'post']) !!}
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-12">
                            {!! Field::date('fecha', ['required']) !!}
                        </div>

                        <div class="col-sm-6">
                            {!! Field::time('hora de entrada' , ['required']) !!}
                        </div>
                        <div class="col-sm-6">
                        {!! Field::time('hora de salida' , ['required']) !!}
                        </div>
                        <div class="form-check col-sm-4 col-lg-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                       name=" almuerzo" value="1">Almuerzo
                            </label>
                        </div>
                        <div class="form-check col-sm-4 col-lg-12">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                       name = "comida" value="1">Comida
                            </label>
                        </div>
                        <div class="form-check col-sm-4 col-lg-12 mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                       name ="merienda" value="1">Merienda
                            </label>
                        </div>
                        <hr>
                    </div>
                    {!! Form::submit('Enviar', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
