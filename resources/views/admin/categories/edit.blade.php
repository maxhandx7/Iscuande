@extends('layouts.admin')
@section('title','Editar Categoria')
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
            Editar Categoria
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('categories.index') }}">Categorias</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar ategoria</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar categoria</h4>
                       
                    </div>
                    {!! Form::model($category,['route'=>['categories.update' ,$category], 'method'=>'PUT']) !!}
                    

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Descripcion</label>
                        <textarea id="body" class="form-control" value="" name="body" rows="3">{{$category->body}}</textarea>
                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                    <a href="{{route('categories.index') }}" class="btn btn-light mr-2">
                        cancelar
                    </a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection