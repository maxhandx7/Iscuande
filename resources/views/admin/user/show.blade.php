@extends('layouts.admin')
@section('title', 'Detalles de usuarios')
@section('styles')
@endsection
@section('styles')
@section('preference')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Detalles
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel de administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }} {{ $user->apellido }}</li>
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
                                    <h3>{{ $user->name }} {{ $user->apellido }}</h3>
                                    <div class="d-flex justify-content-between">
                                    </div>
                                </div>
                                <div class="border-bottom py-4">

                                    <div class="list-group">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" user="tab" aria-controls="home">
                                            Sobre el usuario
                                        </a>

                                        @if ($user->tipo == 'PACIENTE')
                                            <a type="button" class="list-group-item list-group-item-action"
                                                id="list-profile-list" data-toggle="list" href="#list-profile"
                                                user="tab" aria-controls="profile">Historial de citas</a>
                                        @endif
                                        @if ($user->tipo == 'MEDICO')
                                            <a type="button" class="list-group-item list-group-item-action"
                                                id="list-messages-list" data-toggle="list" href="#list-messages"
                                                user="tab" aria-controls="messages">Historial de turnos</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-home" user="tabpanel"
                                        aria-labelledby="list-home-list">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>Informacion del usuarios</h4>

                                            </div>

                                        </div>
                                        <div class="profile-feed" id="list-profile1">
                                            <div class="d-flex align-items-start profile-feed-item">

                                                <div class="form-group col-md-6">

                                                    <strong> <i class="fa fa-user mr-1"> Nombre </i> </strong>
                                                    <p class="text-muted"> {{ $user->name }} {{ $user->apellido }} </p>
                                                    <hr>

                                                    <strong> <i class="far fa-id-card mr-1"> </i>Cedula </strong>
                                                    <p class="text-muted">{{ $user->tipo_documento }}
                                                        {{ $user->no_documento }} </p>
                                                    <hr>


                                                    <strong> <i class="fas fa-envelope mr-1"> Correo Electronico </i>
                                                    </strong>
                                                    <p class="text-muted"> {{ $user->email }} </p>
                                                    <hr>

                                                    <strong> <i class="fa fa-user-circle-o mr-1"> Usuario </i>
                                                    </strong>
                                                    <p class="text-muted"> {{ $user->username }} </p>
                                                    <hr>
                                                </div>

                                                <div class="form-group col-md-6">

                                                    <strong> <i class="fa fa-users mr-1"> </i>Tipo de usuario </strong>
                                                    <p class="text-muted"> {{ $user->tipo }} </p>
                                                    <hr>
                                                    @if ($user->tipo == 'MEDICO')
                                                        <strong> <i class="fa fa-stethoscope mr-1"> </i>Especialidad
                                                        </strong>
                                                        <p class="text-muted"> {{ $user->especialidad->nombre }} </p>
                                                        <hr>
                                                    @endif
                                                    <strong> <i class="fas fa-check mr-1"> Estado </i> </strong>
                                                    <p class="text-muted"> {{ $user->estado }} </p>
                                                    <hr>
                                                    <strong> <i class="fas fa-phone"> Telefono </i> </strong>
                                                    <p class="text-muted"> {{ $user->telefono }} </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="list-profile" user="tabpanel"
                                        aria-labelledby="list-profile-list">

                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>Historial de {{ $user->name }} {{ $user->apellido }}</h4>
                                            </div>
                                        </div>
                                        <div class="profile-feed">
                                            <div class="d-flex align-items-start profile-feed-item">

                                                <div class="table-responsive">
                                                    <table id="order-listing" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Medico</th>
                                                                <th>Especialidad</th>
                                                                <th>Fecha de cita</th>
                                                                <th>Hora</th>
                                                                <th>Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (is_array($user->cita) || is_object($user->cita))
                                                                @foreach ($user->cita as $cita)
                                                                    <tr>
                                                                        <th scope="row">
                                                                            {{ $cita->id }}
                                                                        </th>
                                                                        <td>{{ $cita->turno->user->name }}</td>

                                                                        <td>{{ $cita->turno->user->especialidad->nombre }}
                                                                        </td>
                                                                        <td>{{ $cita->FechaCita }}</td>
                                                                        <td>{{ $cita->HoraCita }}</td>
                                                                        <td>{{ $cita->estado }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="list-messages" user="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>Historial de {{ $user->name }} {{ $user->apellido }}</h4>
                                            </div>
                                        </div>

                                        <div class="profile-feed">
                                            <div class="d-flex align-items-start profile-feed-item">

                                                <div class="table-responsive">
                                                    <table id="order-listing" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Fecha</th>
                                                                <th>Descripcion</th>
                                                                <th>Hora</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (is_array($user->turno) || is_object($user->turno))
                                                                @foreach ($user->turno as $turno)
                                                                    @php
                                                                        $horasArray = explode(', ', $turno->horas);
                                                                        $primeraHora = reset($horasArray);
                                                                        $ultimaHora = end($horasArray);
                                                                        $horaCombinada = $primeraHora . ' - ' . $ultimaHora;
                                                                        $turno->horas = $horaCombinada;
                                                                    @endphp
                                                                    <tr>
                                                                        <th scope="row">
                                                                            {{ $turno->id }}</th>
                                                                        <td> {{ $turno->fecha }}</td>
                                                                        <td> {{ $turno->descripcion }}</td>
                                                                        <td> {{ $turno->horas }}</td>
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
                    <div class="card text-muted">
                        <a href="{{ route('users.index') }}" class="btn btn-primary" type="button">Regresar</a>
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
