@extends('layouts.page')
@section('title', 'Contas a Pagar')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contas a Pagar</h1>
        <button type="button" class="btn btn-outline-primary" id="new_accounts_payable" data-target="#accountsPayableModal">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </button>
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
                                        <x-adminlte-select2 name="privder" id="privder">
                                            <option value="0">Salecione...</option>

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

                                        </x-adminlte-select2>
                                    </div>

                                    <div class="col-md-5 input-group-sm">
                                        <label for="debit_account">Conta Débito</label>
                                        <x-adminlte-select2 name="debit_account" id="debit_account">
                                            <option value="0">Salecione...</option>

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


                                {{-- <div style="padding-top: 0px; " class="d-flex justify-content-end gap-2">
                                    <button type="submit" name="btn_filtro" id="btn_filtro"    class="btn-block btn-secondary">Aplicar Filtro</button>
                                    <button type="button" name="btb_exportar" id="btb_exportar" class="btn-block btn-secondary">Exportar</button>
                                </div> --}}

                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn btn-outline-success btn-sm"
                                            data-target="#accountingFinancialModal">
                                            Pesquisar
                                        </button>
                                        <button type="button" class="btn btn-outline-dark btn-sm"
                                            id="new_accounting_financial" data-target="#accountingFinancialModal">
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

                            </tbody>
                        </table>
                        <div class="mt-3">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('accounts_payable/save') }}" id="accounts_payable" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="accountsPayableModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">Nova Conta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('accounts_payable.forms.accounts_payableForm')
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="bt_save" class="btn btn-success float-right">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs
            $('#due_date').daterangepicker({
                singleDatePicker: false,

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

            $('#new_accounts_payable').on('click', function() {
                // cleanData();
                $('#accountsPayableModal').modal('show');
            });

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
