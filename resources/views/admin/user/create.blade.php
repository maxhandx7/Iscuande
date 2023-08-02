@extends('layouts.admin')
@section('title', 'Nuevo usuario')
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
                Nuevo usuario
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo usuario</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registrar nuevo usuario</h4>

                        </div>
                        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                        <span class="text-danger">Los campos con (*) son obligatorios</span>
                        <hr>
                        @include('admin.user._form')
                        <button type="submit" class="btn btn-primary mr-2">Agregar</button>
                        <a href="{{ route('users.index') }}" class="btn btn-light mr-2">
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
    {!! Html::script('melody/js/select2.js') !!}
    <script>
        $(document).ready(function() {
            var especialidad_id = $('#especialidad_id');
            var isEspecialidadesLoaded =
            false; // Variable para verificar si las especialidades ya han sido cargadas

            $("#tipo").on('change', function() {
                if ($('#tipo').val() == 'MEDICO') {
                    mostrarMedicos();
                } else {
                    ocultarMedicos();
                }
            });

            function mostrarMedicos() {
                if (!isEspecialidadesLoaded) {
                    especialidad_id.val("");
                    $('.especialidad_id').removeAttr('hidden');
                    especialidad_id.children('option:not(:first)').remove();
                    @foreach ($especialidades as $especialidad)
                        var option = $('<option></option>').val('{{ $especialidad->id }}').text(
                            '{{ $especialidad->nombre }}');
                        especialidad_id.append(option);
                    @endforeach
                    isEspecialidadesLoaded = true; // Marcar las especialidades como cargadas
                }
            }

            function ocultarMedicos() {
                especialidad_id.val("");
                especialidad_id.children('option').remove();
                $('.especialidad_id').attr("hidden", true);
                isEspecialidadesLoaded =
                false; // Reiniciar la variable para volver a cargar las especialidades cuando sea necesario
            }


        });
    </script>

@endsection
