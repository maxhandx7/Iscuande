@extends('layouts.login')
@section('content')
    <div class="text-center">
        @include('alert.message')
    </div>
    <form class="pt-3" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Numero de documento</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-user text-primary"></i>
                    </span>
                </div>
                <input id="no_documento" type="no_documento" name="no_documento"
                    class="form-control form-control-lg border-left-0 @error('no_documento') is-invalid @enderror"
                    id="no_documento" placeholder="Ejemplo: 123456789" required>
                @error('no_documento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                    </span>
                </div>
                <input id="password" type="password" name="password"
                    class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror"
                    id="password" placeholder="Contraseña" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        class="form-check-input">
                    Mantenerme registrado
                </label>
            </div>

            {{--  <a href="#" class="auth-link text-black">Forgot password?</a>  --}}
        </div>
        <div class="my-3">
            <div class="d-flex justify-content-center align-items-center mt-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mr-3"
                    type="submit">Entrar</button>
                <a href="{{ url('auth/google') }}" class="btn btn-outline-primary btn-lg d-flex align-items-center">
                    <i class="fab fa-google mr-2"></i>
                </a>
            </div>
        </div>


        <div class="text-center mt-4 font-weight-light">
            <a href="{{ route('register') }}" class="text-primary">Registrarse</a>
        </div>
    </form>
@endsection
