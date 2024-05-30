@extends('layouts.page')

@section('title', 'Contratos')
@section('plugins.KrajeeFileinput', true)
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Detalhes do Contrato</h1>
    </div>
@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <form action="{{ url('loans/save') }}" id="loan_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary card-outline">
                            <input type="hidden" name="id_loan" id="id_loan" value="{{ $loan['id'] ?? '' }}">

                            <div class="card-header">
                                <ul class="nav nav-pills  d-flex justify-content-center" id="custom-tabs-four-tab"
                                    role="tablist">
                                    <li class="nav-item mr-3">
                                        <button class="btn btn-outline-dark nav-link active" id="overview-tab"
                                            data-toggle="pill" href="#overview" role="tab" aria-controls="overview"
                                            aria-selected="false"><i
                                                class="fa-solid fa-file-invoice-dollar"></i>&nbsp;&nbsp;Geral</button>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <button class="btn btn-outline-dark nav-link " id="documents-tab" data-toggle="pill"
                                            href="#documents" role="tab" aria-controls="documents"
                                            aria-selected="true"><i
                                                class="fa-solid fa-folder-open"></i>&nbsp;&nbsp;Documentos</button>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <button class="btn btn-outline-dark nav-link" id="contract-tab" data-toggle="pill"
                                            href="#contract" role="tab" aria-controls="contract"
                                            aria-selected="false"><i
                                                class="fa-solid fa-file-word"></i>&nbsp;&nbsp;Contrato</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">

                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade active show" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        <x-adminlte-card title="Contrato: #{{ $loan['id'] }}" theme="dark"
                                            icon="fa-solid fa-file-invoice-dollar" collapsible>
                                            @include('loans.forms.loansForm')
                                        </x-adminlte-card>
                                        <x-adminlte-card title="Cliente" theme="dark" icon="fa-solid fa-address-card"
                                            collapsible>
                                            @include('loans.forms.customerForm')
                                        </x-adminlte-card>
                                        <x-adminlte-card title="Dados Complementares" theme="dark" icon="fa-solid fa-note"
                                            collapsible>
                                            @include('loans.forms.complementForm')

                                        </x-adminlte-card>
                                        <x-adminlte-card title="Titular" theme="dark" icon="fa-solid fa-person"
                                            collapsible="{{ empty($loan->cardholder) ? 'collapsed' : '' }}">
                                            @include('loans.forms.cardHolderForm')

                                        </x-adminlte-card>

                                    </div>
                                    <div class="tab-pane fade " id="documents" role="tabpanel"
                                        aria-labelledby="documents-tab">
                                        @include('loans.forms.documentsForm')

                                    </div>
                                    <div class="tab-pane fade" id="contract" role="tabpanel"
                                        aria-labelledby="contract-tab">
                                        @include('loans.forms.contractForm')

                                    </div>

                                </div>



                            </div>

                            <div class="card-footer ">
                                <a class="btn btn-secondary" href="/loans">Voltar</a>
                                <button type="button" class="btn btn-success float-right" id="bt_save"   onclick="saveLoan()">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        </section>
    </div>
    </div>

@stop

@push('js')
    <script>
        $(document).ready(function() {

            var disbursementDate = '{{$loan['disbursement_date']}}';
            if(disbursementDate){
                $('.card-body :button').addClass("disabled");
                $('.card-body .btn').prop("disabled", true);
                $(".card-body :input").prop("disabled", true);
                $("#bt_save").prop("disabled", true);

                bt_save
            }

        })

        function saveLoan() {
            if (!validateEmptyFields('loan_amount', 'installments', 'interest_rate', 'installment_amount',
                    'financed_amount')) {
                return false;
            }

            if (!validateEmptySelect('select_customer')) {
                return false;

            }

            Swal.fire({
                title: "Tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sim, salvar"
            }).then((result) => {
                if (result.isConfirmed) {

                    $('.btn').addClass("disabled");
                    document.getElementById('loan_form').submit();

                }
            });


        }
    </script>
@endpush
