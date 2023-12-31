@extends('layouts.admin')
@section('title', 'Gestión de Turnos')
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
                Configurar disponibilidad
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Turnos</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Turnos</h4>
                            <div class="btn-group">
                                <a href=" {{ route('turnos.create') }} " class="btn btn-success" type="button">
                                    <i class="fa fa-plus"></i>
                                    Registrar nuevo turno</a>
                            </div>
                        </div>
                        <br>
                        @include('alert.message')
                        <div class="table-responsive">
                            <table id="order-listing" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Medico</th>
                                        <th>Fecha</th>
                                        <th>Horario</th>
                                        <th style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($turnos as $turno)
                                        <tr>
                                            <td><a href="{{route('turnos.show',$turno)}}">{{ $turno->id }}</a></td>
                                            <td> {{ $turno->user->name . ' ' . $turno->user->apellido }}
                                            </td>

                                            <td> {{ $turno->fecha }} </td>

                                            <td>{{ $turno->horas }}</td>

                                            <td style="width: 180px;">
                                                {!! Form::open(['route' => ['turnos.destroy', $turno], 'method' => 'DELETE', 'id' => 'delete-form']) !!}
                                                <a class="btn btn-info" href="{{ route('turnos.edit', $turno) }}"
                                                    title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <button class="btn btn-danger delete-confirm" type="submit"
                                                    title="Eliminar" onclick="return confirmDelete()">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>

                                                <a class="btn btn-info" href="{{ route('turnos.show', $turno) }}"
                                                    title="Editar">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
@endsection
