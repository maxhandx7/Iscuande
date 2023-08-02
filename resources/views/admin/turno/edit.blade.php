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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('turnos.index') }}">Turnos</a></li>
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
                        {!! Form::model($turno, ['route' => ['turnos.update', $turno], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            <label for="user_id">Medico</label>
                            <select id="user_id"
                                class="form-control js-example-basic-single @error('user_id') is-invalid @enderror"
                                name="user_id">
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}"
                                        {{ old('user_id', $turno->user_id) == $medico->id ? 'selected' : '' }}>
                                        {{ $medico->name }} {{ $medico->apellido }}
                                        - {{ $medico->especialidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="exampleTextarea1"
                                rows="4">{{ old('descripcion', $turno->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                        <a href="{{ route('turnos.index') }}" class="btn btn-light mr-2">
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
    {!! Html::script('melody/js/bootstrap-datepicker.es.js') !!}
    {!! Html::script('melody/js/formpickers.js') !!}

@endsection
