@extends('layouts.admin')
@section('title','Gestión de citas')
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
            Administrar Citas
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Citas</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Citas</h4>
                        <div class="btn-group">
                            <a href=" {{route('citas.create')}} " class="btn btn-success" type="button">
                                <i class="fa fa-plus"></i>
                                Solicitar cita</a>
                        </div>
                    </div>
                    <br>
                    @include('alert.message') 
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Medico</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th style="width: 100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)

                                <tr>
                                    <td> {{$cita->user->name. " " . $cita->user->apellido  }} </td>

                                    <td> {{$cita->cupo->medico->nombre
                                    ." ".
                                    $cita->cupo->medico->apellido }} </td>

                                    <td> {{$cita->fecha_formateada  }} </td>

                                    <td> {{ $cita->HoraCita }} </td>

                                    <td> {{ $cita->estado }} </td>

                                    <td style="width: 230px;">
                                        {!! Form::open(['route'=>['citas.destroy', $cita], 'method'=>'DELETE', 'id'=>'delete-form']) !!}
                                        <a class="btn btn-info" href="{{ route('citas.edit', $cita)}}" title="Editar">
                                            <i class="far fa-edit">Modificar</i>
                                        </a>

                                        <button class="btn btn-danger delete-confirm" type="submit" title="Eliminar" onclick="return confirmDelete()">
                                            <i class="far fa-trash-alt">Cancelar</i>
                                        </button>
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