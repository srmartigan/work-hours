<div class="container">
    @pc <!-- Vesion PC -->
    <div class="col-10 offset-1">
        <div class="col-4 offset-4">
            <label for="filtros">Filtro</label>
            <select class="form-control-sm" name="mes" id="filtroMes" wire:model="mes">
                <option value="0">Mes</option>
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
        </div>

        <div class="table-responsive-lg">
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="th-lg">Fecha</th>
                    <th scope="col" class="th-lg">Hora Entrada</th>
                    <th scope="col" class="th-lg">Hora Salida</th>
                    <th scope="col" class="th-lg">Total Horas</th>
                </tr>
                </thead>
                <tbody>

                @foreach($listadoPartesDiarios as $key => $parteDiario)
                    <tr>
                        <th class=""
                            scope="row">{{ ++$key + (($listadoPartesDiarios->currentPage() - 1 ) * $listadoPartesDiarios->perPage())  }}</th>
                        <td class="th-lg">{{$parteDiario->fecha}}</td>
                        <td class="th-lg">{{$parteDiario->HoraEntrada}}</td>
                        <td class="th-lg">{{$parteDiario->HoraSalida}}</td>
                        <td class="th-lg">{{$parteDiario->TotalHoras}}</td>
                    <!--td class="th-lg">{{$parteDiario->userId}}</td -->
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
        <div class="row">
            <h6 class="col-sm-12">Total Dias Trabajados: {{$listadoPartesDiarios->total()}}</h6>
            <h6 class="col-sm-12">Total Horas Normales: {{$totalHorasNormales}} </h6>
            <h6 class="col-sm-12">Total: {{$total}} € </h6>

        </div>
    </div>
    @else <!-- Version Movil -->
        <div class="col-4 offset-4">
            <label for="filtros">Filtro</label>
            <select class="form-control-sm" name="mes" id="filtroMes" wire:model="mes">
                <option value="0">Mes</option>
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

                    @foreach($listadoPartesDiarios as $key => $parteDiario)
                        <tr>
                            <th class=""
                                scope="row">{{ ++$key + (($listadoPartesDiarios->currentPage() - 1 ) * $listadoPartesDiarios->perPage())  }}</th>
                            <td class="th-lg">{{$parteDiario->fecha}}</td>
                            <td class="th-lg">{{$parteDiario->HoraEntrada}}</td>
                            <td class="th-lg">{{$parteDiario->HoraSalida}}</td>
                            <td class="th-lg">{{$parteDiario->TotalHoras}}</td>
                        <!--td class="th-lg">{{$parteDiario->userId}}</td -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
            <div class="row">
                <h6 class="col-sm-12">Total Dias Trabajados: {{$listadoPartesDiarios->total()}}</h6>
                <h6 class="col-sm-12">Total Horas Normales: {{$totalHorasNormales}} </h6>
                <h6 class="col-sm-12">Total: {{$total}} € </h6>

            </div>
        </div>
        @endpc
</div>
