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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
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
                        @include('admin.cita._form')
                    </div>
                    <a href="{{ route('citas.index') }}" class="btn btn-light mr-2">
                        cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('melody/js/bootstrap-datepicker.es.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#fecha").datepicker({
                language: 'es',
                enableOnReadonly: true,
                todayHighlight: true,
                startDate: new Date()
            });
            $('.btn-reservar').hide();
        });
    </script>
    <script>
        var selectedId;
        var fechaSelect;
        var horaSelect;
        (function($) {
            var verticalForm = $("#example-vertical-wizard");
            var steps = verticalForm.children("div").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
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
                        } else {
                            $.ajax({
                                url: "{{ route('get_turnos') }}",
                                method: 'GET',
                                data: {
                                    fecha: fecha.val(),
                                    especialidad: especialidad_id.val(),
                                },
                                success: function(response) {
                                    if (response.data) {
                                        mostrarMedicos(response);
                                    } else {
                                        swal("No hay citas disponibles",
                                            "Por favor intente de nuevo",
                                            "error").then(
                                            function() {
                                                location.reload();
                                            });
                                    }
                                },
                                error: function() {
                                    console.log(
                                        "Error al obtener los médicos desde el servidor.");
                                }
                            });
                        }
                    } else if (currentIndex === 2) {
                        selectedId = $("input[name='card']:checked").val();
                        if (!selectedId) {
                            swal({
                                text: 'Debes seleccionar una opción antes de continuar.',
                                icon: 'warning',
                                button: {
                                    text: "OK",
                                    value: true,
                                    visible: true,
                                    className: "btn btn-primary"
                                }
                            })
                            return false;
                        } else {
                            $.ajax({
                                url: "{{ route('get_horarios') }}",
                                method: 'GET',
                                data: {
                                    idTurno: selectedId,
                                },
                                success: function(response) {
                                    response.data.forEach(function(info) {
                                        fechaSelect = info.fecha;
                                    });
                                    mostrarhorarios(response);
                                },
                                error: function() {
                                    console.log(
                                        "Error al obtener el horario del medico desde el servidor."
                                    );
                                }
                            });
                        }
                    }

                    return true;
                },
                onStepChanged: function(event, currentIndex, newIndex) {
                    $('#medicosContainer').empty();
                },
                onFinished: function(event, currentIndex) {
                    const token = $('meta[name="csrf-token"]').attr(
                        'content');
                    $.ajax({
                        url: "{{ route('storeCita') }}",
                        method: 'POST',
                        data: {
                            id_turno: selectedId,
                            fecha_turno: fechaSelect,
                            hora_seleccionada: $('#hora').val(),
                        },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            console.log(response.cita_id);
                            if (response.success) {
                                swal("Reserva exitosa!",
                                    "La reserva ha sido realizada con éxito.",
                                    "success").then(function() {
                                    $("#hora").prop("hidden", true);
                                    $(".dot-opacity-loader").prop("hidden", false);
                                    $.ajax({
                                        url: "{{ route('send_email') }}",
                                        method: 'GET',
                                        data: {
                                            cita_id: response.cita_id,
                                        },
                                        success: function(response) {
                                            window.location.href =
                                                "{{ route('citas.index') }}";
                                        },
                                        error: function() {
                                            console.log(
                                                "Error al enviar correo"
                                            );
                                        }
                                    });
                                })
                            } else {
                                swal("Error",
                                    "Hubo un error al realizar la reserva.",
                                    "error");
                            }
                        },
                        error: function(xhr, status,
                            error) {
                            console.error(error);
                        }
                    });

                }
            });
        })(jQuery);



        function mostrarMedicos(medicos) {
            const medicosContainer = $("#medicosContainer");
            medicos.data.forEach(function(medico) {
                const html = `
                <div class="col">
                    <label>
                    <input type="radio" id="card${medico.id}" name="card" value="${medico.id}">
                    <div class="card">
                        <img class="img-fluid mx-auto" width="64px" src="{{ asset('image/system/medico.png') }}" alt="Title">
                        <div class="card-body">
                        <h4 class="card-title">${medico.medico}</h4>
                        <p class="card-text">${medico.descripcion}</p>
                        </div>
                    </div>
                    </label>
                </div>
                `;

                medicosContainer.append(html);
            });
        }

        var horasDisponibles = [];

        function mostrarhorarios(horarios) {
            if (horarios.data.length > 0) {
                const datosTurno = horarios.data[0];
                if (datosTurno && datosTurno.horas) {
                    const horasRegistradas = horarios.cuposRegistrados || [];
                    const horasDisponiblesOriginal = datosTurno.horas.split(", ");

                    horasDisponibles = horasDisponiblesOriginal.filter(hora => !horasRegistradas.includes(hora));

                    const fechaActual = moment();
                    const fechaTurno = moment(datosTurno.fecha,
                        "YYYY-MM-DD");

                    const esHoy = fechaTurno.isSame(fechaActual, "day");

                    /* if (esHoy) {
                        const horaActual = moment().format("h:mm A");
                        console.log(horasDisponibles);
                        horasDisponibles = horasDisponibles.filter(hora => {
                            return moment(hora, "h:mm A").isSameOrAfter(horaActual);
                        });
                    } */

                    const selectHora = $("#hora");
                    selectHora.empty();

                    horasDisponibles.forEach(function(hora) {
                        const option = `<option value="${hora}">${hora}</option>`;
                        selectHora.append(option);
                    });
                } else {
                    console.log("No se encontraron horas disponibles.");
                }
            } else {
                console.log("No se encontraron datos de horarios.");
            }
        }
    </script>
@endsection
