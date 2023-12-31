@extends('layouts.admin')
@section('title', 'Panel administrador')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div class="content-wrapper">
        @if (Auth::user()->tipo == 'PACIENTE')
            <div class="page-header">
                <h3 class="page-title">
                    {{ Auth::user()->name." ".Auth::user()->apellido}}
                </h3>
                @include('alert.message')
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $saludo }} <strong>{{ Auth::user()->name}}</strong>, bienvenido a
                                <strong>{{ $business->name }}</strong>
                            </h4>
                            <hr>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('citas.create') }}" class="btn btn-primary">Solicitar cita</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5>Ultimas Noticias</h5>
                            <div class="owl-carousel owl-theme loop">
                                @foreach ($posts as $post)
                                    <div class="item">
                                        <div class="card mb-2">
                                            <a href="{{ route('post', $post->slug) }}" target="_blank"><img
                                                    class="card-img-top" src="{{ asset('image/' . $post->image) }}"
                                                    height="170px" alt="Title"></a>
                                            <div class="card-body">
                                                <a href="{{ route('post', $post->slug) }}" target="_blank">
                                                    <h4 class="card-title">{{ $post->name }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="page-header">
                <h3 class="page-title">
                    Panel administrador
                </h3>
                @include('alert.message')
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa fa-medkit"></i>
                                ranking medico
                            </h4>
                            <canvas id="citas_medicos" height="100"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa fa-medkit"></i>
                                citas diarias
                            </h4>
                            <canvas id="citas_diarias" height="100"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa fa-medkit"></i>
                                Total Citas
                            </h4>
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa fa-calendar"></i>
                                citas - mensuales
                            </h4>
                            <canvas id="aceptadas"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>

@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/owl-carousel.js') !!}
    <script>
        $(function() {
            var varCompra = document.getElementById('aceptadas').getContext('2d');

            var charCompra = new Chart(varCompra, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($citasMes as $reg) {
                        echo '"' . $reg->mes . '",';
                    } ?>],
                    datasets: [{
                        label: 'Citas Mes',
                        data: [<?php foreach ($citasMes as $reg) {
                            echo '"' . $reg->mtotal . '",';
                        } ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });



            var varVenta = document.getElementById('citas_diarias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($totalCitasDia as $ventadia) {
                        $dia = $ventadia->dia;
                    
                        echo '"' . $dia . '",';
                    } ?>],
                    datasets: [{
                        label: 'Citas',
                        data: [<?php foreach ($totalCitasDia as $reg) {
                            echo '"' . $reg->total_citas . '",';
                        } ?>],
                        backgroundColor: 'rgba(20, 204, 20, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var doughnutPieData = {
                datasets: [{
                    data: [<?php echo '"' . $totalCitasRechazadas . '",', '"' . $totalCitasAceptadas . '",', '"' . $totalCitasPendientes . '",'; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],

                labels: [
                    'Citas Rechazadas',
                    'Citas Aceptadas',
                    'Citas Pendientes',
                ]
            };
            var doughnutPieOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            };


            if ($("#pieChart").length) {
                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: doughnutPieData,
                    options: doughnutPieOptions
                });
            }



            var varVenta = document.getElementById('citas_medicos').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($medicosMasAtendidos as $medico) {
                        $nombre = $medico->name;
                        $apellido = $medico->apellido;
                    
                        echo '"' . $nombre . ' ' . $apellido . '",';
                    } ?>],
                    datasets: [{
                        label: 'Citas realizadas',
                        data: [<?php foreach ($medicosMasAtendidos as $reg) {
                            echo '"' . $reg->cita_count . '",';
                        } ?>],
                        backgroundColor: 'rgba(20, 91, 204, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
