@extends('layouts.admin')
@section('title', 'Gestión de reporte de turnos')
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
                Reporte de turnos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="/reports">Panel de reportes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte de turnos</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Gestión de reporte de turnos</h4>
                        </div>
                        {!! Form::open(['route' => 'exportar.turno', 'method' => 'POST']) !!}
                        <span class="text-danger">Los campos con (*) son obligatorios</span>
                        <hr>
                        @include('alert.message')
                        <br>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="form-group">
                                    <div id="datepicker-popup" class="datepicker">
                                        <label for="fechaInicio">Desde *</label>
                                        <input type="date"
                                            class="form-control @error('fechaInicio') is-invalid @enderror" id="fechaInicio"
                                            placeholder="buscar fecha disponible" name="fechaInicio" autocomplete="off">
                                    </div>
                                    @error('fechaInicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div id="datepicker-popup" class="datepicker">
                                        <label for="fechaFin">Hasta *</label>
                                        <input type="date"
                                            class="form-control  @error('fechaInicio') is-invalid @enderror" id="fechaFin"
                                            placeholder="buscar fecha disponible" name="fechaFin" autocomplete="off">
                                    </div>
                                    @error('fechaInicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Exportar</button>
                        <a href="/reports" class="btn btn-light mr-2">
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
@endsection
