@extends('layouts.page')

@section('title', 'Contas Bancárias')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contas Bancárias</h1>
        <div>

            <button type="button" class="btn btn-outline-primary" id="new_bank_account" data-target="#banksAccountsModal">
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
                                <th class="text-left">Descrição</th>
                                <th class="text-center">Banco</th>
                                <th class="text-center">Agencia</th>
                                <th class="text-center">Conta</th>
                                <th class="text-center">Chave Pix</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banksAccounts as $item)
                                <tr>
                                    <td id="id">{{ $item->id }}</td>
                                    <td class="text-left">{{ $item->description ?? '' }}</td>
                                    <td class="text-center">{{ $item->bank_id ?? '' }}</td>
                                    <td class="text-center">{{ $item->agency ?? '' }}</td>
                                    <td class="text-center">{{ ($item->account ?? '') . '-' . ($item->account_dig ?? '') }}
                                    </td>
                                    <td class="text-center">{{ $item->pix_key ?? '' }}</td>

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
                        {{ $banksAccounts->links() }}

                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('banks_accounts/save') }}" id="banks_accounts_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="banksAccountsModal" tabindex="-1" role="dialog"
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
                        @include('banks_accounts.forms.banks_accountsForm')

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

            $('#new_bank_account').on('click', function() {
                // cleanData();
                $('#banksAccountsModal').modal('show');
            });



        });
    </script>
@endpush
