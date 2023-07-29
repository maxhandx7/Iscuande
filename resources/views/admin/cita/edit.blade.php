@extends('layouts.admin')
@section('title', 'Editar cita')
@section('styles')
@endsection

@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Editar cita
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar cita</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Editar cita</h4>

                        </div>
                        {!! Form::model($cita,['route'=>['users.update' ,$cita], 'method'=>'PUT']) !!}
                    
                        <div class="form-group">
                            <label for="cupo_id">Medico</label>
                            <select id="cupo_id" class="form-control js-example-basic-single" name="cupo_id">
                                @foreach ($turnos as $turno)
                                    <option value="{{ $turno->id }}"
                                        {{ old('cupo_id', $turno->id) == $turno->id ? 'selected' : '' }}>
                                        {{$turno->medico->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div  class="form-group">
                            <label for="FechaCita">Seleccione fecha de cita</label>
                            <select id="FechaCita" class="form-control js-example-basic-single" name="FechaCita">
                                @foreach ($turnos as $turno)
                                    <option value="{{$turno->fecha}}"
                                        {{ old('id', $turno->id) == $turno->id ? 'selected' : '' }}>
                                        {{$turno->fecha}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="HoraCita">Seleccione hora de cita</label>
                            <select id="HoraCita" class="form-control js-example-basic-single" name="HoraCita">
                                <option value="{{ $cita->HoraCita }}" disable selected>
                                    {{$cita->HoraCita}}</option>
                                @foreach ($horasFaltantes as $hora)         
                                <option value="{{ $hora }}">
                                    {{$hora}}</option>
                                @endforeach 
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                        <a href="{{ route('users.index') }}" class="btn btn-light mr-2">
                            cancelar
                        </a>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    {!! Html::script('melody/js/select2.js') !!}
    {!! Html::script('melody/js/wizard.js') !!}

    <script>
        var cupo_id = $('#cupo_id');
        var FechaCita = $('#FechaCita');
        var HoraCita = $('#HoraCita');

        cupo_id.change(mostrarValores);
        FechaCita.change(mostrarValores2);

        
        function mostrarValores() {
            FechaCita.val("");
            FechaCita.children('option:not(:first)').remove();
            @foreach ($turnos as $turno)
                var option = $('<option></option>').val('{{ $turno->fecha }}').text('{{ $turno->fecha }}');
                FechaCita.append(option);
            @endforeach
        }

        function mostrarValores2() {
            HoraCita.val("");
            HoraCita.children('option:not(:first)').remove();
            @foreach ($horasFaltantes as $hora)
                var option = $('<option></option>').val('{{ $hora }}').text('{{ $hora }}');
                HoraCita.append(option);
            @endforeach
        }
    </script>


@endsection
