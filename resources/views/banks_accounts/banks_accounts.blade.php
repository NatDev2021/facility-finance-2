@extends('layouts.page')

@section('title', 'Contas Bancárias')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contas Bancárias</h1>
        <div>

            <a href="{{ url('banks_accounts/form') }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-plus"></i>
                Adicionar
            </a>
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
                    <table id="banks_accounts_table" class="table table-striped table-valign-middle ">
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
                                    <td class="text-center">{{ $item->bank->name ?? '' }}</td>
                                    <td class="text-center">{{ $item->agency ?? '' }}</td>
                                    <td class="text-center">{{ ($item->account ?? '') . '-' . ($item->account_dig ?? '') }}
                                    </td>
                                    <td class="text-center">{{ $item->pix_key ?? '' }}</td>

                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a id="edit_banks_accounts" class="text-muted mr-3" style="cursor: pointer;"
                                                href="banks_accounts/edit/{{ $item->id }}" title="Editar">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a id="delete_banks_accounts" class="text-muted" style="cursor: pointer;"
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


@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs




            $('#banks_accounts_table').on('click', "#delete_banks_accounts",

                function() { // onclick bot�o de anexo

                    var row = $(this).parents('tr');
                    var codBanksAccount = $(row.children('#id'))[0].innerHTML;

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

                            window.location = "{{ url('banks_accounts/delete') }}" + "/" +
                                codBanksAccount;

                        }
                    });


                }
            );



        });
    </script>
@endpush
