@extends('layouts.admin')
@section('title', 'Gestión de reporte de usuarios')
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
                Reporte de usuarios
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="/reports">Panel de reportes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte de usuarios</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Gestión de reportes</h4>
                        </div>

                        <a href="{{ route('exportar') }}" class="btn btn-primary">Exportar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')

@endsection
