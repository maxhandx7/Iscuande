@extends('layouts.admin')
@section('title', 'Editar user')
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
                Editar user
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar user</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Editar user</h4>

                        </div>
                        {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input id="apellido" type="text"
                                class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                                value="{{ old('apellido', $user->apellido) }}" required autocomplete="apellido" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="tipo_documento">Tipo de codumento</label>
                            <select id="tipo_documento"
                                class="form-control js-example-basic-single @error('tipo_documento') is-invalid @enderror"
                                name="tipo_documento" name="tipo_documento" required autocomplete="tipo_documento"
                                autofocus>
                                <option value="{{$user->tipo_documento}}"
                                    selected >
                                     {{$user->tipo_documento}}</option>
                                <option value="cc">Cedula</option>
                                <option value="ce">Cedula de extranjeria</option>
                                <option value="nit">Nit</option>
                                <option value="ti">Tarjeta de identidad</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="no_documento">N° documento</label>
                            <input id="no_documento" type="number"
                                class="form-control @error('no_documento') is-invalid @enderror" name="no_documento"
                                value="{{ old('no_documento', $user->no_documento) }}" required autocomplete="no_documento" autofocus>

                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input id="telefono" type="text"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ old('telefono', $user->telefono) }}" autocomplete="telefono" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo de usuario</label>
                            <select id="tipo" class="form-control js-example-basic-single @error('tipo') is-invalid @enderror"
                                name="tipo" required autocomplete="tipo" autofocus>
                                @foreach (['PACIENTE', 'ADMIN', 'MEDICO'] as $option)
                                    <option value="{{ $option }}" @if($user->tipo === $option) selected @endif>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control js-example-basic-single @error('estado') is-invalid @enderror"
                                name="estado" required autocomplete="estado" autofocus>
                                @foreach (['ACTIVO', 'INACTIVO'] as $option)
                                    <option value="{{ $option }}" @if($user->estado === $option) selected @endif>{{ $option }}</option>
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

@endsection
