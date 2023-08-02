@extends('layouts.admin')
@section('title', 'Nuevo turno')
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
                Nuevo turno
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('turnos.index') }}">Turnos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo turno</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registrar nuevo turno</h4>

                        </div>
                        {!! Form::open(['route' => 'turnos.store', 'method' => 'POST']) !!}
                        @include('admin.turno._form')
                        <button type="submit" class="btn btn-primary mr-2">Agregar</button>
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
    {!! Html::script('melody/js/x-editable.js') !!}
    {!! Html::script('melody/js/formpickers.js') !!}
   
@endsection
