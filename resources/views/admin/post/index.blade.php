@extends('layouts.admin')
@section('title', 'Gestión de Publicaciones')
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
                Administrar Publicaciones
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Publicaciones</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Publicaciones</h4>
                            <div class="btn-group">
                                <a href="{{ route('posts.create') }}" class="btn btn-success" type="button">
                                    <i class="fa fa-plus"></i>
                                    Agregar</a>
                            </div>
                        </div>
                        <br>
                        @include('alert.message')
                        <div class="table-responsive">
                            <table id="order-listing" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-image"></i></th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        <th style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{ asset('image/' . $post->image) }}" alt="image" />
                                            </td>
                                            <td> <a href="{{ route('post', $post->slug) }}" Target="_blank">
                                                    {{ $post->name }} </a></td>

                                            <td>
                                                <p class="text-justify">{{ $post->Previa }}</p>
                                            </td>
                                            <td>{{ $post->category->name }}</td>
                                            @if ($post->status == 'PUBLISHED')
                                                <td>
                                                    <a class="badge badge-success"
                                                        href="{{ route('change.status.posts', $post) }}" title="Activado">
                                                        Publicado<i class="fa fa-check"></i>
                                                    </a>

                                                </td>
                                            @else
                                                <td>
                                                    <a class="badge badge-danger"
                                                        href="{{ route('change.status.posts', $post) }}"
                                                        title="Desactivado">
                                                        Privado
                                                    </a>

                                                </td>
                                            @endif



                                            <td style="width: 100px;">
                                                {!! Form::open(['route' => ['posts.destroy', $post], 'method' => 'DELETE', 'id' => 'delete-form']) !!}
                                                <a class="btn btn-outline-info" href="{{ route('posts.edit', $post) }}"
                                                    title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <button class="btn btn-outline-danger delete-confirm" type="submit"
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
@endsection
