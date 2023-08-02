@extends('layouts.admin')
@section('title','Gestión de medicos')
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
            Administrar personal medico
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Medicos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Medicos</h4>
                        <div class="btn-group">
                            <a href=" {{route('medicos.create')}} " class="btn btn-success" type="button">
                                <i class="fa fa-plus"></i>
                                Registrar nuevo medico</a>
                        </div>
                    </div>
                    <br>
                    @include('alert.message') 
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Medico</th>
                                    <th>Especialidad</th>
                                    <th style="width: 100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicos as $medico)

                                <tr>

                                    <td> {{$medico->nombre
                                    ." ".
                                    $medico->apellido }} </td>

                                    <td> {{$medico->especialidad->nombre }} </td>



                                    <td style="width: 230px;">
                                        {!! Form::open(['route'=>['medicos.destroy', $medico], 'method'=>'DELETE', 'id'=>'delete-form']) !!}
                                        <a class="btn btn-info" href="{{ route('medicos.edit', $medico)}}" title="Editar">
                                            <i class="far fa-edit">Editar</i>
                                        </a>

                                        <button class="btn btn-danger delete-confirm" type="submit" title="Eliminar" onclick="return confirmDelete()">
                                            <i class="far fa-trash-alt">Eliminar</i>
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