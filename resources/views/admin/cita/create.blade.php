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


                        @include('admin.cita._form')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#fecha").datepicker({
                enableOnReadonly: true,
                todayHighlight: true,
                startDate: new Date()
            });

            $('.btn-reservar').hide();

            $(window).resize(function() {
                if ($(window).width() < 576) {

                    $('.btn-reservar').show();
                } else {
                    $('.btn-reservar').hide();
                }
            }).trigger('resize');

        });
    </script>
    <script>
        (function($) {
            var verticalForm = $("#example-vertical-wizard");
            verticalForm.children("div").steps({
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
                        var especialidad_id = $("#especialidad_id");
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
                                    if (currentIndex === 1) {
                                        if (response.data.length === 0) {
                                            swal({
                                                text: 'No se encontraron citas para el día seleccionado',
                                                icon: 'warning',
                                                button: {
                                                    text: "OK",
                                                    value: true,
                                                    visible: true,
                                                    className: "btn btn-primary"
                                                }
                                            });
                                            if (currentIndex > newIndex) {
                                                $('#info-error').attr("hidden", true);
                                            } else {
                                                $('#info-error').removeAttr("hidden");
                                            }
                                            return false;
                                        }
                                    }

                                    if (currentIndex > newIndex) {
                                        $('#info-ok').attr("hidden", true);
                                    } else {
                                        $('#info-ok').removeAttr("hidden");
                                    }

                                    const tabla = $('#tabla-turnos tbody');

                                    tabla.empty();

                                    const cuposRegistrados = response.cuposRegistrados;
                                    for (const turno of response.data) {
                                        const id = turno.id;
                                        const fecha = turno.fecha;
                                        const descripcion = turno.descripcion;
                                        const medico = turno.medico;
                                        const medico_id = turno.medico_id;
                                        const newRow = $(`
                                        <tr>
                                            <td>${id}</td>
                                            <td>${fecha}</td>
                                            <td>${descripcion}</td>
                                            <td>${medico}</td>
                                            <td><select class="form-control horas" name="horas"></select></td>
                                            <td><a class="btn btn-info reservar-link" href="" title="reservar">
                                                <i class="far fa-check-circle">reservar</i>
                                            </a></td>
                                        </tr>
                                    `);

                                        const horasSelect = newRow.find('.horas');
                                        const horasArray = turno.horas.split(', ');

                                        for (const hora of horasArray) {
                                            if (!cuposRegistrados.includes(hora)) {
                                                horasSelect.append(
                                                    `<option value="${hora}">${hora}</option>`
                                                );
                                            }
                                        }

                                        tabla.append(newRow);
                                    }

                                    tabla.on('click', 'a.reservar-link', function(e) {
                                        e.preventDefault();
                                        const fila = $(this).closest('tr');
                                        const idTurno = fila.find('td:nth-child(1)')
                                            .text();
                                        const fechaTurno = fila.find('td:nth-child(2)')
                                            .text();
                                        const horaSeleccionada = fila.find(
                                            'select.horas').val();

                                        const token = $('meta[name="csrf-token"]').attr(
                                            'content');
                                        $.ajax({
                                            url: "{{ route('storeCita') }}",
                                            method: 'POST',
                                            data: {
                                                id_turno: idTurno,
                                                fecha_turno: fechaTurno,
                                                hora_seleccionada: horaSeleccionada,
                                            },
                                            headers: {
                                                'X-CSRF-TOKEN': token
                                            },
                                            success: function(response) {
                                                if (response.success) {
                                                    swal("Reserva exitosa!",
                                                        "La reserva ha sido realizada con éxito.",
                                                        "success").then(
                                                        function() {
                                                            window
                                                                .location
                                                                .href =
                                                                response
                                                                .redirect_url;
                                                        });
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
                                    });
                                }
                            });
                        }

                    }

                    return true;
                },
                onStepChanged: function(event, currentIndex, newIndex) {
                    $('#info-ok').attr("hidden", true);
                    $('#info-error').attr("hidden", true);
                },
                onFinished: function(event, currentIndex) {
                    window.location.href = "{{ route('citas.index') }}";
                }
            });
        })(jQuery);
    </script>
@endsection
