@extends('layouts.admin')
@section('title', 'Resultado de la busqueda')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            @include('alert.message')
            @if ($xml->count() > 0)
                <h2 class="page-title">
                    {!! $xml[0] !!}
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="/">Panel administrador</a></li>
                        <li class="breadcrumb-item active" aria-current="page">busqueda</li>
                    </ol>
                </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h3 class="card-title">{!! $xml[1] !!}</h3>
                        <hr>
                        @php
                            for ($i = 0; $i < count($xml); $i++) {
                                echo "<ul>
                                        <li>".$xml[$i]."</li>
                                     </ul>";
                            }
                        @endphp
                        @endif


                        @if ($xml->count() === 0)
                            <div class="alert alert-fill-danger">
                                <i class="fa fa-exclamation-triangle"></i>
                                No hubo resultados para ""
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
@endsection
