@extends('layouts.admin')
@section('title', 'Panel de reportes')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700');

        body {
            background: #fff;
            font-family: 'Josefin Sans', sans-serif;
        }

        h3 {
            font-family: 'Josefin Sans', sans-serif;
        }

        .box {
            padding: 60px 0px;
            margin: -4em 0;
        }

        .box-part {
            background: #F0FFFF;
            height: 330px;
            padding: 60px 10px;
            margin: 30px 0px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
        }

        .box-part:hover {
            background: #392C70;
        }

        .box-part:hover .fa,
        .box-part:hover .title,
        .box-part:hover .text,
        .box-part:hover a {
            color: #FFF;
            -webkit-transition: all 1s ease-out;
            -moz-transition: all 1s ease-out;
            -o-transition: all 1s ease-out;
            transition: all 1s ease-out;
        }

        .text {
            margin: 20px 0px;
        }

        .fa {
            color: #392C70;
        }

        .title {
            margin: 10px;
        }
    </style>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Panel de reportes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Panel de reportes</li>
                </ol>
            </nav>
        </div>

        <div class="box">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                        <div class="box-part text-center">

                            <i class="fa fa-users fa-3x" aria-hidden="true"></i>

                            <div class="title">
                                <h3>Reporte de usuarios</h3>
                            </div>

                            <div class="text">
                                <span>Se puede exportar los informes de usuarios del sistema en
                                    formato Excel.</span>
                            </div>

                            <a href="{{ route('reports.user') }}">Entrar</a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                        <div class="box-part text-center">

                            <i class="fa fa-clock fa-3x" aria-hidden="true"></i>

                            <div class="title">
                                <h3>Reporte de turnos</h3>
                            </div>

                            <div class="text">
                                <span>Se pueden exportar los informes de los turnos en el sistema en formato Excel.</span>
                            </div>

                            <a href="{{ route('reports.turno') }}">Entrar</a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                        <div class="box-part text-center">

                            <i class="fa fa-calendar fa-3x" aria-hidden="true"></i>

                            <div class="title">
                                <h3>Reporte de citas</h3>
                            </div>

                            <div class="text">
                                <span>Se pueden exportar los informes de las citas en el sistema en formato Excel.</span>
                            </div>

                            <a href="{{ route('reports.cita') }}">Entrar</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('body').addClass('sidebar-icon-only');
        });
    </script>
@endsection
