@extends('layouts.admin')
@section('title', 'Panel administrador')
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
                Panel administrador
            </h3>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex flex-row text-center justify-content-center">
                        <div class="col-md-4">
                            <a href="http://" style="text-decoration: none; color:rgb(17, 15, 129);"><i
                                    class="fa fa-calendar fa-5x"></i>
                                <p>Citas</p>
                        </div></a>

                        @if (Auth::user()->tipo == 'ADMIN')
                            <div class="col-md-4">
                                <a href="http://" style="text-decoration: none; color:rgb(17, 15, 129);"><i
                                        class="fa fa-hospital fa-5x"></i>
                                    <p>Configurar disponibilidad</p>
                            </div></a>


                            <div class="col-md-4">
                                <a href="http://" style="text-decoration: none; color:rgb(17, 15, 129);"><i
                                        class="fa fa-user-md fa-5x"></i>
                                    <p>Medicos</p>
                            </div></a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
