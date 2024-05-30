@extends('layouts.page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Cadastro de Clientes</h1>
@stop

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('customer/save') }}" id="customer_form" method="post">
                @csrf
                <input type="hidden" name="id_customer" id="id_customer" value="{{ $customer->id ?? '' }}" autocomplete="off">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>

                        </h3>
                    </div>

                    <div class="card-body table-responsive p-0">

                        <div class="timeline mt-3">


                            <div>
                                <i class="fas fa-address-card bg-blue"></i>
                                <div class="timeline-item">
                                    <x-adminlte-card title="Pessoa" theme="dark">
                                        @include('customer.forms.persomForm')
                                    </x-adminlte-card>

                                </div>
                            </div>

                            <div>
                                <i class="fas fa-clock-rotate-left bg-blue"></i>
                                <div class="timeline-item">
                                    <x-adminlte-card title="Histórico" theme="dark">
                                        @if (!empty($loans))
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
                                                                    <a id="loan_detail"
                                                                        href="{{ url('loans/detail/' . $item->id) }}"
                                                                        class="text-muted mr-3" style="cursor: pointer;"
                                                                        title="Editar">
                                                                        <i class="fas fa-search"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="d-felx justify-content-end mt-3">
                                                {{ $loans->links() }}
                                            </div>
                                        @endif
                                    </x-adminlte-card>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href="/customer" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-success float-right">Salvar</button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>

        </div>

    </div>

@stop
