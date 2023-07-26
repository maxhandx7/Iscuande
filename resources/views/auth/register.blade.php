@extends('layouts.register')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="brand-logo  text-center">
                            <img src="{{ asset('melody/images/logo.png') }}" alt="logo">
                        </div>
                        <h1 class="card-title">Registro</h1>
                    </div>
                    <div class="card-body">

                        <form class="pt-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            @include('auth._form')
                            <div class="form-group row justify-content-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button> 
                                </div>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                <a href="{{route('login')}}" class="text-primary">Ya tengo una cuenta</a>
                                </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
