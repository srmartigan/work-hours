@extends('layaut.layaut')
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
                        <div class="col-sm-6 offset-3">
                            {!! Field::date('fecha', ['required']) !!}
                        </div>

                        <div class="col-sm-6">
                            {!! Field::time('hora de entrada' , ['required']) !!}
                        </div>
                        <div class="col-sm-6">
                        {!! Field::time('hora de salida' , ['required']) !!}
                        </div>
                    </div>
                    {!! Form::submit('Enviar', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
