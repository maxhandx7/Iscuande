@extends('layouts.admin')
@section('title', 'Nueva cita')
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
                Nueva cita
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('citas.index') }}">citas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva cita</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registrar nueva cita</h4>

                        </div>
                        {!! Form::open(['route' => 'citas.store', 'method' => 'POST']) !!}

                        @include('admin.cita._form')

                        <a href="{{ route('citas.index') }}" class="btn btn-light mr-2">
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
            $("#fecha").datepicker();
        });
    </script>
    <script>
        (function($) {
            var verticalForm = $("#example-vertical-wizard");
            verticalForm.children("div").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                stepsOrientation: "vertical",
                labels: {
                    cancel: "Cancelar",
                    current: "Paso actual:",
                    pagination: "Paginación",
                    finish: "Finalizar",
                    next: "Siguiente",
                    previous: "Anterior",
                    loading: "Cargando ..."
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    var especialidad_id = $("#especialidad_id");
                    if (currentIndex === 0) {
                        if (especialidad_id.val() === null) {
                            swal({
                                text: 'Debes completar este campo antes de continuar.',
                                icon: 'warning',
                                button: {
                                    text: "OK",
                                    value: true,
                                    visible: true,
                                    className: "btn btn-primary"
                                }
                            })
                            return false;
                        }
                    } else if (currentIndex === 1) {
                        var fecha = $("#fecha");
                        console.log(fecha.val());
                        if (fecha.val().trim() === "") {
                            swal({
                                text: 'Debes completar este campo antes de continuar.',
                                icon: 'warning',
                                button: {
                                    text: "OK",
                                    value: true,
                                    visible: true,
                                    className: "btn btn-primary"
                                }
                            })
                            return false;
                        } else if (currentIndex === 1) {
                            $.ajax({
                                url: "{{ route('get_turnos') }}",
                                method: 'GET',
                                data: {
                                    fecha: fecha.val(),
                                },
                                success: function(data) {
                                    if (currentIndex === 1) {
                                        if (data.length === 0) {
                                            swal({
                                                text: 'No se encontraron citas para el dia seleccionado',
                                                icon: 'warning',
                                                button: {
                                                    text: "OK",
                                                    value: true,
                                                    visible: true,
                                                    className: "btn btn-primary"
                                                }
                                            });
                                            $('#info-error').removeAttr("hidden");
                                            return false;
                                        }
                                    }
                                    $('#info-ok').removeAttr("hidden");
                                    console.log(data);
                                    $("#medico").text(data);
                                }
                            });
                        }
                    }

                    return true;
                },
                onFinished: function(event, currentIndex) {
                    alert("¡Enviado!");
                }
            });
        })(jQuery);
    </script>

@endsection
