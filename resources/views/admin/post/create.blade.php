@extends('layouts.admin')
@section('title', 'Nueva publicación')
@section('styles')
@endsection

@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    {!! Html::style('melody/vendors/summernote/dist/summernote-bs4.css') !!}
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Nueva publicación
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel de administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Publicaciones</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva publicación</li>
                </ol>
            </nav>
        </div>
        {!! Form::open(['route' => 'posts.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('admin.post._form')
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select id="category_id" class="form-control js-example-basic-single " name="category_id"
                                style="width: 100%">
                                <option selected disabled value="">Seleccione Categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Etiquetas</label>
                            <select class="js-example-basic-multiple w-100" name="tags[]" id="tags"
                                style="width: 100%" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Imágen de la publicación</h4>
                        <input id="picture" name="picture" type="file" class="dropify" />
                        @error('picture')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary float-right">Registrar</button>
        <a href="{{ URL::previous() }}" class="btn btn-light">
            Cancelar
        </a>
        {!! Form::close() !!}
    </div>

@endsection
@section('scripts')
    {!! Html::script('melody/js/dropify.js') !!}
    {!! Html::script('melody/vendors/summernote/dist/summernote-bs4.min.js') !!}
    {!! Html::script('melody/js/editorDemo.js') !!}
    {!! Html::script('melody/js/select2.js') !!}
@endsection
