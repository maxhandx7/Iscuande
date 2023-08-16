@extends('layouts.admin')
@section('title', 'Gestión de asistente virtual')
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
                Gestión de asistente virtual
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de asistente virtual</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Gestión de asistente virtual</h4>
                        </div>
                        @include('alert.message')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <strong><i class="fas fa-file-signature mr-1"></i> Nombre </strong>

                                <p class="text-muted">
                                    {{ $assistant->nombre }}
                                </p>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-align-left mr-1"></i> Principios</strong>

                                <p class="text-muted">
                                    @foreach ($principios as $principio)
                                        <li>{{ $principio }}</li>
                                    @endforeach
                                </p>
                            </div>

                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-align-right mr-1"></i>Directivas</strong>

                                <p class="text-muted">
                                    @foreach ($directivas as $directiva)
                                        <li>{{ $directiva }}</li>
                                    @endforeach
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">

                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModal-2">Configurar asistente</button>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Configuración de asistente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                {!! Form::model($assistant, ['route' => ['assistants.update', $assistant], 'method' => 'PUT']) !!}


                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"
                            value="{{ $assistant->nombre }}" aria-describedby="helpId">
                    </div>


                    <div class="form-group">
                        <label for="principios">Principios</label>
                        <input name="principios[]" id="principios" class="form-control" value="{{ $string }}"
                            data-role="tagsinput" />
                    </div>

                    <div class="form-group">
                        <label for="directivas">Directivas</label>
                        <input name="directivas[]" id="directivas" class="form-control"
                            value="{{ $string2 }}" data-role="tagsinput" />
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    <script>
        var tagsInputP = $('#principios');
        var tagsInputD = $('#directivas');
        tagsInputP.tagsInput({
            'width': '100%',
            'height': '75%',
            'interactive': true,
            'defaultText': 'Agregar',
            'removeWithBackspace': true,
            'placeholderColor': '#666666'
        });

        tagsInputD.tagsInput({
            'width': '100%',
            'height': '75%',
            'interactive': true,
            'defaultText': 'Agregar',
            'removeWithBackspace': true,
            'placeholderColor': '#666666'
        });
    </script>
@endsection
