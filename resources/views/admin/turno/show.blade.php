@extends('layouts.admin')
@section('title','Información el turno')
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
            {{$turno->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="/">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('turnos.index')}}">Turnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$turno->fecha}}</li>
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
                                <h3>{{$turno->fecha}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <div class="list-group">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" turno="tab" aria-controls="home">
                                        Medico asignado
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-lg-5">

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" turno="tabpanel" aria-labelledby="list-home-list">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Información del turno</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">

                                            <div class="form-group col-md-6">
                                                <strong><i class="fa fa-user-md mr-1"></i> Nombre del medico</strong>
                                                <p class="text-muted">

                                                    {{$turno->user->name}}  {{$turno->user->apellido}}
                                                </p> 
                                                <hr>
                                                <strong><i class="fab fa fa-id-card mr-1"></i>Tipo de documento</strong>
                                                <p class="text-muted">
                                                    {{$turno->user->tipo_documento}}
                                                </p>
                                                <hr>
                                                <strong><i class="far fa-id-card mr-1"></i>Numero de documento</strong>
                                                <p class="text-muted">
                                                    {{$turno->user->no_documento}}
                                                </p>
                                                <hr>
                                                <strong>
                                                    <i class="fas fa-envelope mr-1"></i>
                                                    Correo electrónico</strong>
                                                <p class="text-muted">
                                                    {{$turno->user->email}}
                                                </p>
                                                
                                            </div>
        
                                            <div class="form-group col-md-6">
                                                <strong>
                                                    <i class="fas fa-align-left mr-1"></i>
                                                    Descripcion</strong>
                                                <p class="text-muted">
                                                    {{$turno->descripcion}}
                                                </p>
                                                <hr>
                                                <strong>
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Horario</strong>
                                                <p class="text-muted">
                                                    {{$turno->horas}}
                                                </p>
                                            </div>

                                            
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('turnos.index')}}" class="btn btn-primary float-right">Regresar</a>
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