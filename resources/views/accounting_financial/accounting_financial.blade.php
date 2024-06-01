@extends('layouts.page')

@section('title', 'Plano de Contas')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Plano de Contas</h1>
        <div>
            <button type="button" class="btn btn-outline-primary" id="import_accounting_financial"
                data-target="#accountingFinancialModal">
                <i class="fa-solid fa-upload"></i>
                Importar
            </button>
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
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>

                    </h3>
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
                                            style="background-color: {{ $item->end_duration_date < date('Y-m-d') ? '#f0a8a8' : '#a8f0cb' }};">{{ $item->end_duration_date < date('Y-m-d') ? 'Inativo' : 'Ativo' }}</span>
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


    <form>
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
                });

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


                });

            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('description')) {
                    return false;
                }
            });




        });
    </script>
@endpush
