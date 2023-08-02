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
        <div class="page-header">
            <h3 class="page-title">
                Panel administrador
            </h3>
        </div>

        @if (Auth::user()->tipo == 'PACIENTE')
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" style="background-color: #392c70;">
                    <div class="card-body">
                        <h4 class="card-title" style="color: #fff">Binvenidos a <strong>Santa barbara centro de salud</strong>
                        </h4>
                        <img class="card-img-top" src="{{ asset('melody/images/iscuande.jpg') }}" alt="Title">
                    </div>
                </div>
            </div>
        @else
        
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
    <script>
        $(function() {
            var varCompra = document.getElementById('aceptadas').getContext('2d');

            var charCompra = new Chart(varCompra, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($citasMes as $reg) {
                        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                        $mes_traducido = strftime('%B', mktime(0, 0, 0, $reg->mes, 1));
                    
                        echo '"' . $mes_traducido . '",';
                    } ?>],
                    datasets: [{
                        label: 'Citas Mes',
                        data: [<?php foreach ($citasMes as $reg) {
                            echo '"' . $reg->mtotal . '",';
                        } ?>],

                        borderColor: 'rgba(255, 99, 132, 1)',
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
                        backgroundColor: 'rgba(20, 204, 20, 1)',
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
      data: [<?php echo '"' . $totalCitasRechazadas . '",', '"' . $totalCitasAceptadas . '",', '"' . $totalCitasPendientes . '",' ?>],
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

    // These labels appear in the legend and in the tooltips when hovering different arcs
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
        });
    </script>
@endsection
