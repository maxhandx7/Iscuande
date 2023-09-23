@extends('layouts.admin')
@section('title', 'Gestión de reportes')
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
                Gestión de reportes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de reportes</li>
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

                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('image/system/report.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title">Reporte de usuarios</h5>
                                      <p class="card-text">Se puede exportar los informes de usuarios del sistema en
                                        formato Excel.</p>
                                      <a href=" {{ route('reports.user') }} " class="btn btn-primary stretched-link">entrar</a>
                                    </div>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('image/system/shift.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title">Reporte de turnos</h5>
                                      <p class="card-text">Se pueden exportar los informes de los turnos en el sistema en formato Excel.</p>
                                      <a href="#" class="btn btn-primary stretched-link">entrar</a>
                                    </div>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('image/system/calendar.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title">Reporte de citas</h5>
                                      <p class="card-text">Se pueden exportar los informes de las citas en el sistema en formato Excel.</p>
                                      <a href="#" class="btn btn-primary stretched-link">entrar</a>
                                    </div>
                                  </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')

@endsection
