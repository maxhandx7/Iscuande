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
                    <li class="breadcrumb-item"><a href="{{ route('citas.index') }}">citas</a></li>
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
                        {!! Form::model($medico,['route'=>['medicos.update' ,$medico], 'method'=>'PUT']) !!}
                    
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $medico->nombre) }}" class="form-control ">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $medico->apellido) }}" class="form-control ">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="cedula">Cedula</label>
                            <input type="text" name="cedula" id="cedula" value="{{ old('cedula', $medico->cedula) }}" class="form-control ">
                        </div>
                        
                        <div class="form-group">
                            <label for="especialidad_id">Especialidad</label>
                            <select id="especialidad_id" class="form-control js-example-basic-single" name="especialidad_id">
                                @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}" 
                                 {{ old('id', $especialidad->id ) == $especialidad->id ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                            @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                        <a href="{{ route('medicos.index') }}" class="btn btn-light mr-2">
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
