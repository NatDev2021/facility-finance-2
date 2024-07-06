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
                    <x-adminlte-card title="Previsão Futura" theme="dark" icon="fa-solid fa-chart-mixed-up-circle-dollar">
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



            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d')
            var donutChartCanvas2 = $('#donutChart2').get(0).getContext('2d')
            var donutChartCanvas3 = $('#donutChart3').get(0).getContext('2d')

            var teste = {!! json_encode($teste, JSON_HEX_TAG) !!};
            var donutData = {
                labels: arrayColumn(teste, 'description'),
                datasets: [{
                    data: arrayColumn(teste, 'count'),
                    backgroundColor: arrayColumn(teste, 'color'),
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas1, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            new Chart(donutChartCanvas2, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
            new Chart(donutChartCanvas3, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })



        });
    </script>
@endpush
