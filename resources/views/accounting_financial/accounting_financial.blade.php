@extends('layouts.page')

@section('title', 'Plano de Contas')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Plano de Contas</h1>
        <div>
            <a href="accounting_financial/import" class="btn btn-outline-primary">
                <i class="fa-solid fa-upload"></i>
                Importar
            </a>
            <button type="button" class="btn btn-outline-primary" id="new_accounting_financial"
                data-target="#accountingFinancialModal">
                <i class="fa-solid fa-plus"></i>
                Adicionar
            </button>
        </div>

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
                        </div>
                        <div class="col-md-6 d-flex justify-content-end  p-0">

                            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                                <i class="fas fa-search text-end"></i>
                            </a>

                            <div class="navbar-search-block" style="display: {{ empty($search) ? 'none' : 'flex' }};">
                                <x-adminlte-input name="search" id="search" placeholder="pesquisar" label="&nbsp;"
                                    value="{{ $search ?? '' }}">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button icon="fas fa-search" theme="success" id="bt_search" />

                                        <x-adminlte-button icon="fas fa-times" theme="danger" data-widget="navbar-search" />
                                    </x-slot>

                                </x-adminlte-input>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="accounting_financial_table" class="table table-striped table-valign-middle ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">Nome</th>
                                <th class="text-center">Conta</th>
                                <th class="text-center">Status</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accountingFinancial as $item)
                                <tr>
                                    <td id="id">{{ $item->id }}</td>
                                    <td class="text-left">{{ $item->name ?? '' }}</td>
                                    <td class="text-center">{{ $item->account ?? '' }}</td>
                                    <td class="text-center"><span class="badge"
                                            style="background-color: {{ $item->end_duration_date != '0000-00-00' && $item->end_duration_date < date('Y-m-d') ? '#f0a8a8' : '#a8f0cb' }};">{{ $item->end_duration_date != '0000-00-00' && $item->end_duration_date < date('Y-m-d') ? 'Inativo' : 'Ativo' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a id="edit_accounting_financial" class="text-muted mr-3"
                                                style="cursor: pointer;" title="Editar">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a id="delete_accounting_financial" class="text-muted" style="cursor: pointer;"
                                                title="Excluir">
                                                <i class="fa-regular fa-trash-can" style="color: red"></i>
                                            </a>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $accountingFinancial->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('accounting_financial/save') }}" id="accounting_financial_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="accountingFinancialModal" tabindex="-1" role="dialog"
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
                        @include('accounting_financial.forms.accounting_financialForm')
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

            $('#accounting_financial_table').on('click', "#edit_accounting_financial",
                function() { // onclick bot�o de anexo

                    var row = $(this).parents('tr');
                    var codAccountingFinancial = $(row.children('#id'))[0].innerHTML;

                    $.ajax({
                        url: "{{ url('accounting_financial/get') }}" + "/" + codAccountingFinancial,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            cleanData();
                            defineData(response);
                            $('#accountingFinancialModal').modal('show');
                        }
                    });
                }
            );

            $('#new_accounting_financial').on('click', function() {
                cleanData();
                $('#accountingFinancialModal').modal('show');
            });

            $('#accounting_financial_table').on('click', "#delete_accounting_financial",

                function() { // onclick bot�o de anexo

                    var row = $(this).parents('tr');
                    var codAccountingFinancial = $(row.children('#id'))[0].innerHTML;

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

                            window.location = "{{ url('accounting_financial/delete') }}" + "/" +
                                codAccountingFinancial;

                        }
                    });


                }
            );


            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('description', 'account')) {
                    return false;
                }
            });

            $('#bt_search').on('click', function() {

                var search = $('#search').val();

                window.location.href = "{{ url('accounting_financial?search=') }}" + search;


            });

        });
    </script>
@endpush
