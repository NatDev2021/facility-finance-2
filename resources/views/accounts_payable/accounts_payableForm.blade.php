@extends('layouts.page')
@section('title', 'Contas a Pagar')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>{{ empty($financialTransaction->id) ? 'Nova' : 'Editar' }} Conta a Pagar</h1>
    </div>

@stop


@section('content')

    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('accounts_payable/save') }}" id="accounts_payable" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">

                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#nav-cliente-fornecedor"
                                            role="tab" aria-controls="nav-cliente-fornecedor" aria-selected="true">
                                            <h3 class="card-title">
                                                <i class="fa-regular fa-down"></i>
                                                Dados da Conta
                                                {{ !empty($financialTransaction->id) ? 'Nº' . $financialTransaction->id : '' }}

                                            </h3>
                                        </a>

                                        @if (!empty($financialTransaction->id))
                                            <a class="nav-link" data-bs-toggle="tab" href="#nav-cliente-fornecedor"
                                                role="tab" aria-controls="nav-cliente-fornecedor" aria-selected="true">
                                                <h3 class="card-title">
                                                    <i class="fa-solid fa-list-ol"></i>
                                                    Títulos
                                                </h3>
                                            </a>
                                        @endif
                                    </div>
                                </nav>
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
        $(document).ready(function() {

            var paymentDate = '{{ $financialTransaction->pay_date ?? '' }}';
            if (paymentDate) {
                $('.card-body :button').addClass("disabled");
                $('.card-body .btn').prop("disabled", true);
                $(".card-body :input").prop("disabled", true);
                $("#save").prop("disabled", true);
            }

            $('#save').on("click", function() {

                let validateFields = validateEmptyFields('description', 'value', 'register_date',
                    'due_date');
                let validateSelect = validateEmptySelect('payment_method_id');
                let validateSelect2 = validateEmptySelect2('provider_id', 'credit_account', 'debit_account',
                    'disbursement_account_id');
                if (!validateFields || !validateSelect2 || !validateSelect) {
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




        });
    </script>
@endpush
