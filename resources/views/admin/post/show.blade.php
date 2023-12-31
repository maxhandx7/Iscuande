@extends('layouts.admin')
@section('title', 'Gestión de mensajes')
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
                Administrar comentarios
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Comentarios</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Comentarios</h4>
                        </div>
                        <br>
                        @include('alert.message')
                        <div class="table-responsive">
                            <table id="order-listing" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Publicacion</th>
                                        <th>Correo</th>
                                        <th>Comentario</th>
                                        <th>Fecha y hora</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comentarios as $comentario)
                                        <tr>
                                            <td> <a href="{{ route('users.show', $comentario->user) }}">
                                                {{ $comentario->user->username }} </a></td>

                                            <td> <a href="{{ route('post', $comentario->post->slug) }}" Target="_blank">
                                                {{ $comentario->post->name }} </a></td>

                                            <td> {{ $comentario->email }} </td>

                                            <td>
                                                <p class="text-justify">{{ $comentario->body }} </p>
                                            </td>

                                            <td> {{ $comentario->created_at }} </td>
                                            <td>
                                                {!! Form::open(['route' => ['comments.destroy', $comentario], 'method' => 'DELETE', 'id' => 'delete-form']) !!}
                                                <button class="btn btn-danger delete-confirm" type="submit"
                                                    title="Eliminar" onclick="return confirmDelete()">
                                                    <i class="far fa-trash-alt"></i>
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
    
    {!! Html::script('melody/responsive/js/responsive.bootstrap4.min.js') !!}
    {!! Html::script('melody/responsive/js/responsive.min.js') !!}
@endsection
