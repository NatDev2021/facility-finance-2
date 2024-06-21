@extends('layouts.page')
@section('title', 'Contas a Receber')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contas a Receber</h1>
        <a href="accounts_receivable/form" class="btn btn-outline-primary">
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


                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                            </h3>
                            &nbsp;
                            <span> Contas a Receber Cadastradas | <a id="title_filter_span"
                                    href="javascript:showFilter()">Ocultar
                                    Filtro</a></span>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end ">

                            <a id="title_filter_span" href="javascript:cleanFilter()" title="Limpar Filtro"><i
                                    class="fa-solid fa-broom-wide"></i></a>
                        </div>
                    </div>

                </div>




                <div class="card-body table-responsive">

                    <div class="card mb-4" id="filter">
                        <form action="{{ url('accounts_receivable') }}" method="get">
                            @csrf
                            <div class="card-body">
                                <div class="row justify-content-between ">

                                    <div class="col-md-4  input-group-sm">
                                        <label for="description">Descrição</label>
                                        <input type="text" id="description" name="description" class="form-control"
                                            value="{{ $search['description'] ?? '' }}">
                                    </div>
                                    <div class="col-md-4 input-group-sm">
                                        <label for="privder">Cliente</label>
                                        <x-adminlte-select2 name="customer_id" id="customer_id">
                                            <option value="0">Salecione...</option>
                                            @foreach ($customers as $item)
                                                <option @selected(($search['customer_id'] ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->person->name }}</option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>
                                    <div class="col-md-2  input-group-sm">
                                        <label for="amount">Status</label>
                                        <x-adminlte-select igroup-size="sm" name="status" id="status">
                                            <option value="0">Salecione...</option>
                                            <option @selected(($search['status'] ?? '') == 'p') value="p">Pago</option>
                                            <option @selected(($search['status'] ?? '') == 'o') value="o">Pendente</option>
                                            <option @selected(($search['status'] ?? '') == 'd') value="d">Em Atraso</option>
                                            <option @selected(($search['status'] ?? '') == 't') value="t">Vence Hoje</option>
                                        </x-adminlte-select>
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
                                                value="{{ $search['due_date'] ?? '' }}" data-target="#due_date" />
                                        </div>
                                    </div>


                                    <div class="col-md-4 input-group-sm">
                                        <label for="credit_account">Conta Crédito</label>
                                        <x-adminlte-select2 name="credit_account" id="credit_account">
                                            <option value="0">Salecione...</option>
                                            @foreach ($accountFinancial as $item)
                                                <option @selected(($search['credit_account'] ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->account . ' - ' . $item->name }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-md-4 input-group-sm">
                                        <label for="debit_account">Conta Débito</label>
                                        <x-adminlte-select2 name="debit_account" id="debit_account">
                                            <option value="0">Salecione...</option>
                                            @foreach ($accountFinancial as $item)
                                                <option @selected(($search['debit_account'] ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->account . ' - ' . $item->name }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select2>
                                    </div>
                                    <div class="col-md-2  input-group-sm">
                                        <label for="amount">Forma de Pagamento</label>
                                        <x-adminlte-select igroup-size="sm" name="payment_method_id" id="payment_method_id">
                                            <option value="0">Salecione...</option>
                                            @foreach ($paymentMethod as $item)
                                                <option @selected(($search['payment_method_id'] ?? '') == $item->id) value="{{ $item->id }}">
                                                    {{ $item->description }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select>
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
                                                value="{{ $search['amount'] ?? '' }}" data-mask-reverse="true" />

                                        </div>
                                    </div>

                                </div>
                                <hr />

                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn btn-dark btn-sm">
                                            Pesquisar
                                        </button>
                                        <button type="button" class="btn btn-dark btn-sm" id="export_accounts">
                                            Exportar
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                    <div style="padding-top: 15px" class="table-responsive">
                        <table id="accounts_receivable_table" class="table table-striped table-valign-middle ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Vencimento</th>
                                    <th class="text-center">Descrição</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Valor</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accountsReceivable as $item)
                                    <tr>
                                        <td id="id">{{ $item->id }}</td>
                                        <td class="text-left">{{ date('d/m/Y', strtotime($item->due_date ?? '')) }}</td>
                                        <td class="text-center">{{ $item->description ?? '' }}</td>
                                        <td class="text-center">{{ $item->customer ?? '' }}</td>

                                        <td class="text-center"><span class="badge"
                                                style="background-color: {{ $item->status['color'] }};">{{ $item->status['message'] }}</span>
                                        </td>
                                        <td class="text-center">{{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a id="edit_accounting_financial" class="text-muted mr-3"
                                                    style="cursor: pointer;" title="Editar"
                                                    href="accounts_receivable/edit/{{ $item->id }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                                <a id="delete_accounts_receivable" class="text-muted"
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
                            {{ $accountsReceivable->links() }}

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTitle">Exportar Registros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Selecione o formato que deseja exportar.

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" onclick="export_excel()" class="btn btn-success">Excel <i
                            class="fa-regular fa-file-spreadsheet"></i></button>
                    <button type="button" onclick="export_pdf()" class="btn btn-danger ">PDF <i
                            class="fa-solid fa-file-pdf"></i></button>
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


            $('#accounts_receivable_table').on('click', "#delete_accounts_receivable",

                function() { // onclick bot�o de anexo

                    var row = $(this).parents('tr');
                    var codAccountingReceivable = $(row.children('#id'))[0].innerHTML;

                    Swal.fire({
                        title: "Tem certeza?",
                        text: "Você não poderá reverter isso!",
                        icon: "warning",
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "Cancelar",
                        confirmButtonText: "Sim, excluir"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            window.location = "{{ url('accounts_receivable/delete') }}" + "/" +
                                codAccountingReceivable;

                        }
                    });


                });


            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('description', 'account')) {
                    return false;
                }
            });


            $('#export_accounts').on('click', function() {
                $('#exportModal').modal('show');
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

        function cleanFilter() {
            window.location.href = 'accounts_receivable';
        }

        function export_excel() {

            const urlParams = new URLSearchParams(window.location.search);
            const data = urlParams.toString();
            window.location.href = 'accounts_receivable/export/excel?' + data;
        }


        function export_pdf() {

            const urlParams = new URLSearchParams(window.location.search);
            const data = urlParams.toString();
            window.location.href = 'accounts_receivable/export/pdf?' + data;
        }
    </script>
@endpush
