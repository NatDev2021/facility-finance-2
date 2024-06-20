@extends('layouts.page')

@section('title', 'Contas Bancária')

@section('content_header')
    <h1>Nova Contas Bancária</h1>
@stop

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('banks_accounts/save') }}" id="banks_accounts_form" method="post">
                @csrf

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center">
                                <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                </h3>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end ">

                                <a href="accounting_financial/import" class="btn btn-outline-primary card-title">
                                    <i class="fa-solid fa-upload"></i>
                                    OFX
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">

                        <div class="timeline mt-3">


                            <div>
                                <i class=" fas fa-solid fa-file-invoice-dollar bg-blue"></i>
                                <div class="timeline-item">
                                    <x-adminlte-card title="Dados da Conta" theme="dark">
                                        @include('banks_accounts.forms.banks_accountsForm')
                                    </x-adminlte-card>

                                </div>
                            </div>
                            @if (!empty($statement))
                                <div>
                                    <i class="fas fa-clock-rotate-left bg-blue"></i>
                                    <div class="timeline-item">
                                        <x-adminlte-card title="Extrato" theme="dark">
                                            <table id="loans_table" class="table table-striped table-valign-middle ">
                                                <thead>
                                                    <tr>
                                                        <th>Data</th>
                                                        <th class="text-center">Descrição</th>
                                                        <th class="text-center">Valor</th>
                                                        <th class="text-center">Tipo</th>
                                                        <th class="text-center">Origem</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($statement as $item)
                                                        <tr>
                                                            <td>{{ date('d/m/Y', strtotime($item->register_date ?? '')) }}
                                                            </td>
                                                            <td class="text-center">{{ $item->description ?? '' }}</td>
                                                            <td class="text-right">
                                                                {{ Helper::formatBrazilianNumber($item->amount ?? '') }}
                                                            </td>
                                                            <td class="text-center"><span class="badge"
                                                                    style="background-color: {{ $item->type == 'c' ? '#f0a8a8' : '#a8f0cb' }};">{{ $item->type == 'c' ? 'Crédito' : 'Débito' }}</span>
                                                            </td>
                                                            <td class="text-center">Pagamento de Conta</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="d-felx justify-content-end mt-3">
                                                {{ $statement->links() }}

                                            </div>
                                        </x-adminlte-card>

                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href="/banks_accounts" class="btn btn-secondary">Voltar</a>
                                <button id="bt_save" type="submit" class="btn btn-success float-right">Salvar</button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>

        </div>

    </div>

@stop


@push('js')
    <script>
        $(document).ready(function() { // onloadjs


            $('#bt_save').on('click', function() {

                let validateFields = validateEmptyFields('description', 'account', 'agency');
                let validateSelect2 = validateEmptySelect2('bank_id');
                if (!validateFields || !validateSelect2) {
                    return false;
                }
            });

        });
    </script>
@endpush
