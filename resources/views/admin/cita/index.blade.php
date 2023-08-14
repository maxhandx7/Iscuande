@extends('layouts.admin')
@section('title', 'Gestión de citas')
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
                Administrar Citas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Citas</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body ">
                        @if (Auth::user()->tipo == 'ADMIN')
                            <span>Fecha de consulta: <b> </b></span>
                            <div class="form-group">
                                <form id="filtrar-citas">
                                    <input type="date" name="filterFecha" id="filterFecha" class="form-control">
                                    <input type="submit" class="btn btn-link" value="consultar">
                                </form>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Citas</h4>
                            @if (Auth::user()->tipo !== 'MEDICO')
                                <div class="btn-group">
                                    <a href=" {{ route('citas.create') }} " class="btn btn-success" type="button">
                                        <i class="fa fa-plus"></i>
                                        Solicitar cita</a>
                                </div>
                            @endif
                        </div>
                        <br>
                        @include('alert.message')
                        <div class="table-responsive">
                            <table id="order-listing" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>documento</th>
                                        <th>Fecha</th>
                                        <th style="width: 200px;">Estado</th>
                                        <th>Ver</th>
                                        @if (Auth::user()->tipo == 'PACIENTE')
                                            <th>Cancelar</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($citas as $cita)
                                        <tr>
                                            <td>{{ $cita->id }}</td>
                                            <td><a
                                                    href="{{ route('citas.show', $cita) }}">{{ $cita->user->name . ' ' . $cita->user->apellido }}</a>
                                            </td>
                                            <td>{{ $cita->user->no_documento }}</td>
                                            <td> {{ $cita->fecha_formateada }} </td>
                                            @if (Auth::user()->tipo == 'ADMIN' || Auth::user()->tipo == 'MEDICO')
                                                <td>
                                                    <div class="editable-form" data-pk="{{ $cita->id }}">
                                                        <a href="#" class="text-primary editable-text"
                                                            data-type="select" data-value="{{ $cita->estado }}"
                                                            data-title="Select estado">{{ $cita->estado }}</a>
                                                    </div>
                                                </td>
                                            @else
                                                <td>{{ $cita->estado }}</td>
                                            @endif
                                            <td><a class="btn btn-info" href="{{ route('citas.show', $cita) }}"
                                                title="Ver">
                                                <i class="far fa-eye"></i>
                                            </a></td>
                                            @if (Auth::user()->tipo == 'PACIENTE' && $cita->estado != 'ACEPTADA')
                                                <td>
                                                    {!! Form::open(['route' => ['citas.destroy', $cita], 'method' => 'DELETE', 'id' => 'delete-form']) !!}
                                                    <button class="btn btn-danger delete-confirm" type="submit"
                                                        title="Eliminar" onclick="return confirmDelete()">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endif
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
    {!! Html::script('melody/js/toastDemo.js') !!}
    <script>
        $(document).ready(function() {
            $.fn.editable.defaults.mode = 'inline';
            $.fn.editableform.buttons =
                '<button type="submit" class="btn btn-primary btn-sm editable-submit">' +
                '<i class="fa fa-fw fa-check"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm editable-cancel">' +
                '<i class="fa fa-fw fa-times"></i>' +
                '</button>';

            $('.editable-text').editable({
                source: [{
                        value: 'PENDIENTE',
                        text: 'PENDIENTE'
                    },
                    {
                        value: 'ACEPTADA',
                        text: 'ACEPTADA'
                    },
                    {
                        value: 'RECHAZADA',
                        text: 'RECHAZADA'
                    },
                ],
                success: function(response, newValue) {
                    var citaId = $(this).closest('.editable-form').data('pk');
                    $.ajax({
                        url: "{{ route('update_status') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: citaId,
                            estado: newValue
                        },
                        success: function(response) {
                            if (response.success) {
                                showSuccessToast();
                            } else {
                                showDangerToast();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
            var filterFecha = $('#filterFecha');
            $.ajax({
                url: "{{ route('filter_fecha') }}",
                method: 'GET',
                data: {
                    filterFecha: filterFecha.val(),
                },
                success: function(response) {

                }
            });
        });
    </script>
@endsection
