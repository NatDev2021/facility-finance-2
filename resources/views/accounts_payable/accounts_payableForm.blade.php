@extends('layouts.page')
@section('title', 'Plano de Contas')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>{{ empty($financialTransaction->id) ? 'Nova' : 'Editar' }} Conta a Pagar</h1>
    </div>

@stop


@section('content')

    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('accounts_payable/save') }}" id="accounts_payable" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-regular fa-up"></i>
                                    Dados da Conta

                                </h3>
                            </div>

                            <div class="card-body table-responsive">

                                @include('accounts_payable.forms.accounts_payableForm')


                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="/accounts_payable" class="btn btn-secondary">Voltar</a>
                                        <button type="submit" id="save"
                                            class="btn btn-success float-right">Salvar</button>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-3 ">
                        <div class="row">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fa-regular fa-lightbulb"></i>
                                        Dica do Sistema

                                    </h3>
                                </div>

                                <div class="card-body table-responsive">
                                    <p> - O plano de contas facilita agrupar melhor suas contas em categorias.</p>
                                    <p> - Os campos marcados com <span class="text-danger"> (*)</span> são obrigatórios.</p>
                                </div>


                            </div>
                        </div>
                        @if (!empty($financialTransaction->id))
                            <div class="row">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fa-regular fa-folder-open"></i>
                                            Documentos

                                        </h3>
                                    </div>

                                    <div class="card-body table-responsive">
                                        
                                        @include('accounts_payable.forms.import_filesForm')

                                    </div>


                                </div>
                            </div>
                        @endif

                    </div>

                </div>

            </form>

        </div>

    </div>

@stop

@push('js')
    <script>
        $('#save').on("click", function() {

            let validateFields = validateEmptyFields('description', 'value', 'register_date', 'due_date');
            let validateSelect2 = validateEmptySelect2('provider_id', 'credit_account', 'debit_account');
            if (!validateFields || !validateSelect2) {
                return false;
            }

            if ($('#enable_frequency').is(':checked')) {

                if (!validateEmptyFields('frequency_number')) {
                    return false;
                }


                if (parseFloat($('#frequency_number').val()) < 1) {

                    $('#frequency_number').css({
                        "border": "1px solid red"
                    });
                    Toast.fire({
                        icon: 'error',
                        title: 'O número de parcelas a reptir deve ser maior do que 0.',
                    });
                    return false;
                }

            }


        });
    </script>
@endpush
