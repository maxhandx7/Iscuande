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
                        
                        <button type="submit" class="btn btn-primary mr-2">Agregar</button>
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
    {!! Html::script('melody/js/select2.js') !!}
    {!! Html::script('melody/js/wizard.js') !!}

    <script>
        var cupo_id = $('#cupo_id');
        var Fecha = $('#Fecha');
        var HoraCita = $('#HoraCita');

        Fecha.change(mostrarValores);
        HoraCita.change(mostrarValores2);

        function mostrarValores() {
            HoraCita.val("");
            HoraCita.children('option:not(:first)').remove();
            @foreach ($horasFaltantes as $hora)
                var option = $('<option></option>').val('{{ $hora }}').text('{{ $hora }}');
                HoraCita.append(option);
            @endforeach
        }


        function mostrarValores2() {
            cupo_id.val("");
            var id_cupo =  Fecha.val();
            cupo_id.children('option:not(:first)').remove();
            @foreach ($cupos as $cupo)
            if (id_cupo == {{$cupo->id}}) {
                var option = $('<option></option>').val('{{ $cupo->id }}').text('{{ $cupo->medico->nombre }} {{ $cupo->medico->apellido }} - {{ $cupo->descripcion }}');
                cupo_id.append(option);
            }
            @endforeach
            var textoSeleccionado = $("#Fecha option:selected").text(); 
            $('#FechaCita').val(textoSeleccionado);
        }
    </script>


@endsection
