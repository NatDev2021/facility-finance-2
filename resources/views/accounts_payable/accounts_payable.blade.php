@extends('layouts.page')
@section('title', 'Contas a Pagar')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contas a Pagar</h1>
        <a href="accounts_payable/form" class="btn btn-outline-primary">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </a>
    </div>

@stop


@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">

                    <div class="d-flex align-items-center gap-3">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                        </h3>
                        &nbsp;
                        <span> Contas a Pagar Cadastradas | <a id="title_filter_span" href="javascript:showFilter()">Ocultar
                                Filtro</a></span>
                    </div>

                </div>




                <div class="card-body table-responsive">

                    <div class="card mb-4" id="filter">
                        <form action="{{ url('accounts_payable') }}" method="get">
                            @csrf
                            <div class="card-body">
                                <div class="row justify-content-between ">

                                    <div class="col-md-5  input-group-sm">
                                        <label for="description">Descrição</label>
                                        <input type="text" id="description" name="description" class="form-control"
                                            value="{{ '' }}">
                                    </div>
                                    <div class="col-md-5 input-group-sm">
                                        <label for="privder">Fornecedor</label>
                                        <x-adminlte-select2 name="provider_id" id="provider_id">
                                            <option value="0">Salecione...</option>
                                            @foreach ($providers as $item)
                                                <option @selected(($financialTransaction->customer_provider_id ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->person->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>


                                    <div class="col-md-2  input-group-sm">
                                        <label for="due_date">Vencimento</label>

                                        <div class="input-group input-group-sm date" id="start_date"
                                            data-target-input="nearest">

                                            <div class="input-group-append" data-target="#due_date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                            <input type="text" name="due_date" id="due_date" class="form-control"
                                                data-target="#due_date" />
                                        </div>
                                    </div>


                                    <div class="col-md-5 input-group-sm">
                                        <label for="credit_account">Conta Crédito</label>
                                        <x-adminlte-select2 name="credit_account" id="credit_account">
                                            <option value="0">Salecione...</option>
                                            @foreach ($accountFinancial as $item)
                                                <option @selected(($financialTransaction->debit_account_id ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->account . ' - ' . $item->name }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-md-5 input-group-sm">
                                        <label for="debit_account">Conta Débito</label>
                                        <x-adminlte-select2 name="debit_account" id="debit_account">
                                            <option value="0">Salecione...</option>
                                            @foreach ($accountFinancial as $item)
                                                <option @selected(($financialTransaction->credit_account_id ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->account . ' - ' . $item->name }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-md-2  input-group-sm">
                                        <label for="amount">Valor</label>
                                        <div class="input-group input-group-sm date" data-target-input="nearest">
                                            <div class="input-group-append" data-target="#amount"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text">R$</div>
                                            </div>
                                            <input type="text" name="amount" id="amount"
                                                class="form-control text-right" data-target="#amount" data-mask="#.##0,00"
                                                data-mask-reverse="true" />

                                        </div>
                                    </div>

                                </div>
                                <hr />

                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn btn-dark btn-sm"
                                            data-target="#accountingFinancialModal">
                                            Pesquisar
                                        </button>
                                        <button type="button" class="btn btn-dark btn-sm" id="new_accounting_financial"
                                            data-target="#accountingFinancialModal">
                                            Exportar
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                    <div style="padding-top: 15px" class="table-responsive">
                        <table id="accounting_financial_table" class="table table-striped table-valign-middle ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Vencimento</th>
                                    <th class="text-center">Descrição</th>
                                    <th class="text-center">Fornecedor</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Valor</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accountsPayable as $item)
                                    <tr>
                                        <td id="id">{{ $item->id }}</td>
                                        <td class="text-left">{{ date('d/m/Y', strtotime($item->due_date ?? '')) }}</td>
                                        <td class="text-center">{{ $item->description ?? '' }}</td>
                                        <td class="text-center">{{ $item->provider ?? '' }}</td>

                                        <td class="text-center"><span class="badge"
                                                style="background-color: {{ $item->status['color'] }};">{{ $item->status['message'] }}</span>
                                        </td>
                                        <td class="text-center">{{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a id="edit_accounting_financial" class="text-muted mr-3"
                                                    style="cursor: pointer;" title="Editar"
                                                    href="accounts_payable/edit/{{ $item->id }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                                <a id="delete_accounting_financial" class="text-muted"
                                                    style="cursor: pointer;" title="Excluir">
                                                    <i class="fa-regular fa-trash-can" style="color: red"></i>
                                                </a>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $accountsPayable->links() }}

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs
            $('#due_date').daterangepicker({
                singleDatePicker: false,
                autoUpdateInput: false,

                locale: {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "D",
                        "S",
                        "T",
                        "Q",
                        "Q",
                        "S",
                        "S"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]

                },
            });

        });

        $('#due_date').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('#due_date').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        function showFilter() {
            if ($('#filter').is(":visible")) {
                $('#filter').hide();
                $('#title_filter_span').text('Exibir Filtro');
            } else {
                $('#filter').show();
                $('#title_filter_span').text('Ocultar Filtro');
            }
        }
    </script>
@endpush
