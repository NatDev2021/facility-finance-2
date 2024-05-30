@extends('layouts.page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            @can('is_admin')
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box  bg-info">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumLoans ?? '') }}</h3>
                                <p>Contratos: <strong>{{ $countLoans }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <a href="/loans" class="small-box-footer">Mais detalhes <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box  bg-success">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumIncome ?? '') }}</h3>
                                <p>Entradas: <strong>{{ $countIncome }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-arrow-down-to-line"></i>
                            </div>
                            <a href="/financial_movement" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumExpense ?? '') }}</h3>
                                <p>Saídas: <strong>{{ $countExpense }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-arrow-up-to-line"></i>
                            </div>
                            <a href="/financial_movement" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($balanceMovement ?? '') }}</h3>
                                <p>Balanço</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-chart-mixed-up-circle-dollar"></i>
                            </div>
                            <a href="/financial_movement" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            @endcan
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Últimos Contratos</h3>

                        </div>
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Parcelas</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $item)
                                        <tr>
                                            <td id="id">{{ $item->id }}</td>
                                            <td class="text-center">{{ $item->customer ?? '' }}</td>
                                            <td class="text-right">
                                                {{ Helper::formatBrazilianNumber($item->loan_amount ?? '') }}
                                            </td>
                                            <td class="text-center">{{ $item->installments ?? '' }}</td>
                                            <td class="text-center"><span class="badge"
                                                    style="background-color: {{ $item->status_color ?? '' }};">{{ $item->status ?? '' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <a id="loan_detail" href="{{ url('loans/detail/' . $item->id) }}"
                                                        class="text-muted mr-3" style="cursor: pointer;" title="Editar">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-felx justify-content-center">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <x-adminlte-card title="Contratos por status" theme="dark" icon="fa-solid fa-right-left">
                        <div class="d-flex justify-content-center">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; width: 321px;"
                                width="321" height="250" class="chartjs-render-monitor"></canvas>
                        </div>

                    </x-adminlte-card>

                </div>
                @can('is_admin')
                    <div class="col-md-12">
                        <x-adminlte-card title="Balanço anual" theme="dark" icon="fa-solid fa-chart-mixed-up-circle-dollar">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 321px;"
                                    width="321" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </x-adminlte-card>

                    </div>
                @endcan


            </div>
        </div>
    </section>
@stop
@section('css')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            var areaChartData = {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ],
                datasets: [{
                        label: 'Saída',
                        backgroundColor: 'rgba(220, 53, 69, 1)',
                        borderColor: 'rgba(220, 53, 69, 1)',
                        pointRadius: false,
                        pointColor: '#dc3545',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: {!! json_encode($monthlyExpense, JSON_HEX_TAG) !!}
                    },
                    {
                        label: 'Entrada',
                        backgroundColor: 'rgba(40, 167, 69, 1)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#28a745',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: {!! json_encode($monthlyIncome, JSON_HEX_TAG) !!}
                    },
                ]
            }


            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var statuses = {!! json_encode($statuses, JSON_HEX_TAG) !!};
            var donutData = {
                labels: arrayColumn(statuses, 'description'),
                datasets: [{
                    data: arrayColumn(statuses, 'loans'),
                    backgroundColor: arrayColumn(statuses, 'color'),
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })



            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                locale: 'br-BR',
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return new Intl.NumberFormat('br-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                    maximumSignificantDigits: 3
                                }).format(value);
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


        });
    </script>
@endpush
