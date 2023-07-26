@extends('layouts.admin')
@section('title', 'Nuevo medico')
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
                Nuevo medico
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('medicos.index') }}">Medicos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo medico</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registrar nuevo medico</h4>

                        </div>
                        {!! Form::open(['route' => 'medicos.store', 'method' => 'POST']) !!}
                        @include('admin.medico._form')
                        <button type="submit" class="btn btn-primary mr-2">Agregar</button>
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
    {!! Html::script('melody/js/x-editable.js') !!}
    {!! Html::script('melody/js/formpickers.js') !!}
   
@endsection
