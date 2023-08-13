@extends('layouts.admin')
@section('title', 'Información de la cita')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }
    </style>
@endsection
@section('create')

@endsection
@section('options')

@endsection
@section('preference')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ $cita->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('citas.index') }}">Citas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $cita->fecha }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <h3>{{ $cita->user->name . ' ' . $cita->user->apellido }}</h3>
                                    <div class="d-flex justify-content-between">
                                        {{-- <p class="text-muted">
                                            {{ $cita->user->no_documento }}
                                        </p> --}}
                                    </div>
                                </div>
                                <div class="border-bottom py-4">
                                    <div class="list-group">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" cita="tab" aria-controls="home">
                                            Informacion
                                        </a>

                                        <a type="button" class="list-group-item list-group-item-action"
                                            id="list-messages-list" data-toggle="list" href="#list-messages" user="tab"
                                            aria-controls="messages">Historial</a>
                                    </div>
                                </div>

                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Paciente
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $cita->user->name }} {{ $cita->user->apellido }}
                                        </span>
                                    </p>

                                    <p class="clearfix">
                                        <span class="float-left">
                                            Documento
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $cita->user->tipo_documento }}. {{ $cita->user->no_documento }}
                                        </span>
                                    </p>

                                    <p class="clearfix">
                                        <span class="float-left">
                                            Correo electrónico
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $cita->user->email }}
                                        </span>
                                    </p>


                                    <p class="clearfix">
                                        <span class="float-left">
                                            Telefono
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $cita->user->telefono }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-home" cita="tabpanel"
                                        aria-labelledby="list-home-list">

                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>Información de la cita</h4>
                                            </div>
                                        </div>
                                        <div class="profile-feed">
                                            <div class="d-flex align-items-start profile-feed-item">

                                                <div class="form-group col-md-6">
                                                    <strong>
                                                        <i class="fas fa-user-md mr-1"></i>
                                                        Medico</strong>
                                                    <p class="text-muted">
                                                        Dr.
                                                        {{ $cita->turno->user->name . ' ' . $cita->turno->user->apellido }}
                                                    </p>
                                                    <hr>
                                                    <strong>
                                                        <i class="fas fa-stethoscope mr-1"></i>
                                                        Especialidad</strong>
                                                    <p class="text-muted">
                                                        {{ $cita->turno->user->especialidad->nombre }}
                                                    </p>

                                                </div>

                                                <div class="form-group col-md-6">
                                              
                                                    <strong>
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        Fecha</strong>
                                                    <p class="text-muted">
                                                        {{ $cita->fecha_formateada }}
                                                    </p>

                                                    <hr>
                                                    <strong>
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Hora de la cita</strong>
                                                    <p class="text-muted">
                                                        {{ $cita->HoraCita }}
                                                    </p>
                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="list-messages" user="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>Historial de {{ $cita->user->name }}</h4>
                                            </div>
                                        </div>

                                        <div class="profile-feed">
                                            <div class="d-flex align-items-start profile-feed-item">

                                                <div class="table-responsive">
                                                    <table id="order-listing" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Doctor</th>
                                                                <th>Fecha</th>
                                                                <th>Hora</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (is_array($citas_user) || is_object($citas_user))
                                                                @foreach ($citas_user as $user)
                                                                    <tr>
                                                                        <th scope="row">
                                                                            {{ $user->id }}</th>
                                                                        <td>Dr. {{ $user->turno->user->name }}</td>
                                                                        <td> {{ $user->FechaCita }}</td>
                                                                        <td> {{ $user->HoraCita }}</td>


                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('citas.index') }}" class="btn btn-primary float-right">Regresar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    {!! Html::script('melody/js/profile-demo.js') !!}
    {!! Html::script('melody/js/data-table.js') !!}
@endsection
