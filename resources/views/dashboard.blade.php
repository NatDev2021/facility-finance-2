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
                                <h3>R$ 2.00,00</h3>
                                <p>Total a Receber: <strong>5</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <a href="/loans" class="small-box-footer">Mais detalhes <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg col-6">
                        <div class="small-box  bg-success">
                            <div class="inner">
                                <h3>R$ 5.000,22</h3>
                                <p>Liquidados: <strong>3</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-arrow-down-to-line"></i>
                            </div>
                            <a href="/financial_movement" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg col-6">
                        <div class="small-box  bg-info">
                            <div class="inner">
                                <h3>R$ 2.00,00</h3>
                                <p>Total a Pagar: <strong>5</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <a href="/loans" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>R$ 3.000,25</h3>
                                <p>Pagos: <strong>6</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-arrow-up-to-line"></i>
                            </div>
                            <a href="/financial_movement" class="small-box-footer">Mais detalhes <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>R$ 6.000,36</h3>
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
                    <x-adminlte-card title="Contas a Pagar - A vencer" theme="dark" icon="fa-solid fa-arrow-up-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Fornecedor</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Vencimeto</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </x-adminlte-card>

                </div>
                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Pagar - Em Atraso" theme="dark" icon="fa-solid fa-arrow-up-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Fornecedor</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Vencimeto</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </x-adminlte-card>

                </div>
                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Receber - A vencer" theme="dark"  icon="fa-solid fa-arrow-down-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Vencimeto</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </x-adminlte-card>

                </div>
                <div class="col-md-6">
                    <x-adminlte-card title="Contas a Receber - Em Atraso" theme="dark"   icon="fa-solid fa-arrow-down-to-line">
                        <div class="card-body table-responsive p-0">
                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Vencimeto</th>
                                        <th class="text-center">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </x-adminlte-card>

                </div>

                <div class="col-md-12">
                    <x-adminlte-card title="Análise de Desempenho:" theme="dark" icon="fa-solid fa-right-left">
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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Últimos Lançametos</h3>

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
                        <x-adminlte-card title="Balanço anual" theme="dark"
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
                @endcan


            </div>
        </div>
    </section>
@stop
@section('css')
@stop

@push('js')
    <script></script>
@endpush
