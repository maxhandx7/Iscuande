@extends('layouts.admin')
@section('title', 'Gestión de reporte de usuarios')
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
                Reporte de usuarios
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="/reports">Panel de reportes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte de usuarios</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Gestión de reporte de usuarios</h4>
                        </div>
                        {!! Form::open(['route' => 'exportar', 'method' => 'POST']) !!}
                        <span class="text-danger">Los campos con (*) son obligatorios</span>
                        <hr>
                        <div class="form-group">
                            <label for="tipo">Tipo de busqueda *</label>
                            <select id="tipo"
                                class="form-control js-example-basic-single @error('tipo') is-invalid @enderror"
                                name="tipo" name="tipo" required autocomplete="tipo" autofocus>
                                <option selected disabled value="">Seleccione tipo de busqueda</option>
                                <option value="all">todos</option>
                                <option value="MEDICO">Medicos</option>
                                <option value="PACIENTE">Pacientes</option>
                            </select>
                            @error('tipo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <hr>
                            <div class="form-group especialidad_id" hidden>
                                <label>Especialidad *</label>
                                <select id="especialidad_id" class="form-control " name="especialidad_id">
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Exportar</button>
                        <a href="/reports" class="btn btn-light mr-2">
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
                    especialidad_id.append('<option value="all">todos</option>');
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
