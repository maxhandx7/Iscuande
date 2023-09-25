@extends('layouts.admin')
@section('title','Gestión de users')
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
            Administrar usuarios
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Usuarios</h4>
                        <div class="btn-group">
                            <a href=" {{route('users.create')}} " class="btn btn-success" type="button">
                                <i class="fa fa-plus"></i>
                                Registrar nuevo usuario</a>
                        </div>
                    </div>
                    <br>
                    @include('alert.message') 
                    <div class="table-responsive">
                        <table id="order-listing" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Tipo de documento</th>
                                    <th>documento</th>
                                    <th>Rol</th>

                                    <th style="width: 100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)

                                <tr>
                                    @if ($user->tipo == 'ADMIN')
                                    <td> {{$user->id }} </td>
                                    <td>{{$user->name
                                    ." ".
                                    $user->apellido }} </td>
                                    @else
                                    <td> {{$user->id }} </td>
                                    <td> {{$user->name
                                        ." ".
                                        $user->apellido }} </td>
                                    @endif
                                    <td> {{$user->tipo_documento }} </td>
                                    
                                    <td> {{$user->no_documento }} </td>
                                    <td> {{$user->tipo }} </td>



                                    <td style="width: 230px;">
                                        {!! Form::open(['route'=>['users.destroy', $user], 'method'=>'DELETE', 'id'=>'delete-form']) !!}
                                        <a class="btn btn-info" href="{{ route('users.edit', $user)}}" title="Editar">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <button class="btn btn-danger delete-confirm" type="submit" title="Eliminar" onclick="return confirmDelete()">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    @if ($user->tipo != 'ADMIN')
                                
                                    <a class="btn btn-info" href="{{ route('users.show', $user) }}"
                                        title="Editar">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    @endif
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
{!! Html::script('melody/responsive/js/responsive.bootstrap4.min.js') !!}
{!! Html::script('melody/responsive/js/responsive.min.js') !!}
@endsection