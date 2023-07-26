@extends('layouts.admin')
@section('title', 'Editar turno')
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
                Editar turno
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cupos.index') }}">Turnos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar turno</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Editar turno</h4>

                        </div>
                        {!! Form::model($cupo,['route'=>['cupos.update' ,$cupo], 'method'=>'PUT']) !!}
                        <div class="form-group">
                            <label for="medico_id">Medico</label>
                            <select id="medico_id" class="form-control js-example-basic-single" name="medico_id">
                                <option selected disabled value="">Seleccione medico</option>
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}" 
                                     {{ old('id', $medico->id ) == $medico->id ? 'selected' : '' }}>{{ $medico->nombre }} {{ $medico->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                 
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="exampleTextarea1" rows="4">{{ old('descripcion', $cupo->descripcion) }}</textarea>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <input type="text" value="{{ old('fecha', $cupo->fecha) }}" name="fecha" class="form-control">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="far fa-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="cupo_id">Hora Inicio</label>
                            <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                                <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                    <input type="text" name="inicio" class="form-control datetimepicker-input" data-target="#timepicker-example" />
                                    <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="cupo_id">Hora Fin</label>
                            <div class="input-group date" id="timepicker-example1" data-target-input="nearest">
                                <div class="input-group" data-target="#timepicker-example1" data-toggle="datetimepicker">
                                    <input type="text" name="fin" class="form-control datetimepicker-input" data-target="#timepicker-example1" />
                                    <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Agregar</button>
                        <a href="{{ route('cupos.index') }}" class="btn btn-light mr-2">
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

@endsection
