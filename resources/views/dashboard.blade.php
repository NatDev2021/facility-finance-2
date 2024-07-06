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
                    <div class="col-lg col-6">
                        <div class="small-box  bg-info">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumOpneAccountsReceivable ?? '') }}</h3>
                                <p>Total a Receber: <strong>{{ $countOpneAccountsReceivable }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <a href="/accounts_receivable?status=o" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg col-6">
                        <div class="small-box  bg-success">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumCloseAccountsReceivable ?? '') }}</h3>
                                <p>Liquidados: <strong>{{ $countCloseAccountsReceivable }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-arrow-down-to-line"></i>
                            </div>
                            <a href="/accounts_receivable?status=p" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg col-6">
                        <div class="small-box  bg-info">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumOpneAccountsPayable ?? '') }}</h3>
                                <p>Total a Pagar: <strong>{{ $countOpneAccountsPayable }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <a href="/accounts_payable?status=o" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($sumCloseAccountsPayable ?? '') }}</h3>
                                <p>Pagos: <strong>{{ $countCloseAccountsPayable }}</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-arrow-up-to-line"></i>
                            </div>
                            <a href="/accounts_payable?status=p" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>R$ {{ Helper::formatBrazilianNumber($balance ?? '') }}</h3>
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

                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Receber - A vencer" theme="dark"
                        icon="fa-solid fa-arrow-down-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($receivables as $item)
                                        <tr>
                                            <td id="id">{{ $item->id }}</td>
                                            <td class="text-center">{{ $item->customer ?? '' }}</td>
                                            <td class="text-center"><span class="badge"
                                                    style="background-color: {{ $item->status['color'] }};">{{ $item->status['message'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <a id="edit_accounting_financial" class="text-muted mr-3"
                                                        style="cursor: pointer;" title="Editar"
                                                        href="accounts_receivable/edit/{{ $item->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </a>

                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-adminlte-card>

                </div>
                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Receber - Em Atraso" theme="dark"
                        icon="fa-solid fa-arrow-down-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overDueReceivables as $item)
                                        <tr>
                                            <td id="id">{{ $item->id }}</td>
                                            <td class="text-center text-danger">{{ $item->customer ?? '' }}</td>
                                            <td class="text-center"><span class="badge"
                                                    style="background-color: {{ $item->status['color'] }};">{{ $item->status['message'] }}</span>
                                            </td>
                                            <td class="text-center text-danger">
                                                {{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <a id="edit_accounting_financial" class="text-muted mr-3"
                                                        style="cursor: pointer;" title="Editar"
                                                        href="accounts_receivable/edit/{{ $item->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </a>

                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-adminlte-card>

                </div>
                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Pagar - A vencer" theme="dark" icon="fa-solid fa-arrow-up-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Fornecedor</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payables as $item)
                                        <tr>
                                            <td id="id">{{ $item->id }}</td>
                                            <td class="text-center">{{ $item->provider ?? '' }}</td>
                                            <td class="text-center"><span class="badge"
                                                    style="background-color: {{ $item->status['color'] }};">{{ $item->status['message'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <a id="edit_accounting_financial" class="text-muted mr-3"
                                                        style="cursor: pointer;" title="Editar"
                                                        href="accounts_receivable/edit/{{ $item->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </a>

                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </x-adminlte-card>

                </div>
                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Pagar - Em Atraso" theme="dark"
                        icon="fa-solid fa-arrow-up-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Fornecedor</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overDuePayables as $item)
                                        <tr>
                                            <td id="id">{{ $item->id }}</td>
                                            <td class="text-center text-danger">{{ $item->provider ?? '' }}</td>
                                            <td class="text-center"><span class="badge"
                                                    style="background-color: {{ $item->status['color'] }};">{{ $item->status['message'] }}</span>
                                            </td>
                                            <td class="text-center text-danger">
                                                {{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <a id="edit_accounting_financial" class="text-muted mr-3"
                                                        style="cursor: pointer;" title="Editar"
                                                        href="accounts_receivable/edit/{{ $item->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </a>

                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </x-adminlte-card>

                </div>

                <div class="col-md-12">
                    <x-adminlte-card title="Análise de Desempenho" theme="dark"
                        icon="fa-solid fa-chart-pie-simple-circle-dollar">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-center">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="donutChart1"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; width: 321px;"
                                    width="321" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="donutChart2"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; width: 321px;"
                                    width="321" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="donutChart3"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; width: 321px;"
                                    width="321" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>

                    </x-adminlte-card>

                </div>
                <div class="col-md-12">
                    <x-adminlte-card title="Balanço anual" theme="dark" icon="fa-solid fa-chart-simple">
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

                <div class="col-md-12">
                    <x-adminlte-card title="Previsão Futura" theme="dark"
                        icon="fa-solid fa-chart-mixed-up-circle-dollar">
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


            </div>
        </div>
    </section>
@stop
@section('css')
@stop

@push('js')
    <script>
        $(document).ready(function() {


            donutChartCanvas();
            areaChartCanvas();

        });



        function donutChartCanvas() {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d')
            var donutChartCanvas2 = $('#donutChart2').get(0).getContext('2d')
            var donutChartCanvas3 = $('#donutChart3').get(0).getContext('2d')

            var data1 = {!! json_encode($donutChartCanvas1, JSON_HEX_TAG) !!};
            var data2 = {!! json_encode($donutChartCanvas2, JSON_HEX_TAG) !!};
            var data3 = {!! json_encode($donutChartCanvas3, JSON_HEX_TAG) !!};

            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas1, {
                type: 'doughnut',
                data: {
                    labels: arrayColumn(data1, 'description'),
                    datasets: [{
                        data: arrayColumn(data1, 'sum'),
                        backgroundColor: arrayColumn(data1, 'color'),
                    }]
                },
                options: donutOptions
            })

            new Chart(donutChartCanvas2, {
                type: 'doughnut',
                data: {
                    labels: arrayColumn(data2, 'description'),
                    datasets: [{
                        data: arrayColumn(data2, 'sum'),
                        backgroundColor: arrayColumn(data2, 'color'),
                    }]
                },
                options: donutOptions
            })
            new Chart(donutChartCanvas3, {
                type: 'doughnut',
                data: {
                    labels: arrayColumn(data3, 'description'),
                    datasets: [{
                        data: arrayColumn(data3, 'sum'),
                        backgroundColor: arrayColumn(data3, 'color'),
                    }]
                },
                options: donutOptions
            })

        }

        function areaChartCanvas() {

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
                        data: {!! json_encode($monthlyPayable, JSON_HEX_TAG) !!}
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
                        data: {!! json_encode($monthlyReceivable, JSON_HEX_TAG) !!}
                    },
                ]
            }


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

        }
    </script>
@endpush
