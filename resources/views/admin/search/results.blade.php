@extends('layouts.admin')
@section('title', 'Resultado de la busqueda')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <style>
        .title {
            font-weight: bold;
            font-size: 24px;
        }

        .organization {
            font-style: italic;
        }

        .content-box {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.5;
        }

        .snippet {
            font-style: italic;
        }

        a {
            color: #0077cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .card {
            background-color: #fff;
            color: #333;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: #1a202c;
            color: #fff;
        }


        .dark-mode .card-title {
            color: #fff !important;
            font-weight: normal;
            margin-bottom: 1.25rem;
            text-transform: capitalize;
            font-size: 1.125rem;
        }
    </style>
    <div class="content-wrapper">
        <div class="page-header">
            @include('alert.message')
            @if ($xml[1])
                <h2 class="page-title">
                    {!! $xml[0] !!}
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="home">Panel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">busqueda</li>
                    </ol>
                </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h3 class="card-title">{!! $xml[1] !!}</h3>
                        <ul>
                            <li><span class="text-muted">{!! $xml[3] !!}</span></li>
                            <li><span class="text-muted">{!! $xml[4] !!}</span></li>
                        </ul>
                        @php
                            for ($i = 5; $i < count($xml); $i++) {
                                echo $xml[$i];
                            }
                            
                        @endphp
                    @else
                        <div class="alert alert-fill-danger">
                            <i class="fa fa-exclamation-triangle"></i>
                            No hubo resultados
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
    <script>
        const darkModeButton = document.getElementById('cambiar');
        const cards = document.querySelectorAll('.card');

        const temaGuardado = localStorage.getItem("tema");

        if (temaGuardado === "oscuro") {
            document.querySelector(".card").classList.toggle('dark-mode');
        } else if (temaGuardado === "claro") {
            document.querySelector(".dark-mode").setAttribute("class", "card");
        }

        darkModeButton.addEventListener('click', () => {
            cards.forEach(card => {
                card.classList.toggle('dark-mode');
            });
        });
    </script>
@endsection
