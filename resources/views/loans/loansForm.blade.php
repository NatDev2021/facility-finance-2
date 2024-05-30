@extends('layouts.page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Inclusão de Contrato</h1>
    </div>
@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <form action="{{ url('loans/save') }}" id="loan_form" method="post">
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">
                                    <div class="bs-stepper linear">
                                        <div class="bs-stepper-header" role="tablist">
                                            <div class="step active" data-target="#logins-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="logins-part" id="logins-part-trigger"
                                                    aria-selected="true">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Proposta</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="information-part" id="information-part-trigger"
                                                    aria-selected="false" disabled="disabled">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Cliente</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <div id="logins-part" class="content active dstepper-block" role="tabpanel"
                                                aria-labelledby="logins-part-trigger">
                                                @include('loans.forms.loansForm')
                                            </div>
                                            <div id="information-part" class="content" role="tabpanel"
                                                aria-labelledby="information-part-trigger">
                                                @include('loans.forms.customerForm')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer ">
                                <button type="button" onclick="btPrevious()" class="btn btn-secondary ">Voltar</button>
                                <button type="button" onclick="btnNext()"
                                    class="btn btn-success float-right ">Avançar</button>
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
            stepper = new Stepper($('.bs-stepper')[0]);
            step = 0;
        })

        function btnNext() {

            if (step == 0) {
                if (validateEmptyFields('loan_amount', 'installments', 'interest_rate', 'installment_amount',
                        'financed_amount')) {
                    stepper.next()
                    step++;

                }
            } else if (step == 1) {

                if (validateEmptySelect('select_customer')) {


                    Swal.fire({
                        title: "Atenção!",
                        text: "Deseja prosseguir com a inclusão deste contrato? ",
                        icon: "warning",
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "Cancelar",
                        confirmButtonText: "Sim"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('.btn').addClass("disabled");
                            document.getElementById('loan_form').submit();

                        }
                    });
                }
            }

        }

        function btPrevious() {

            if (step == 0) {

                var loanAmount = "{{ $loan['loan_amount'] ?? '' }}";

                if (loanAmount) {
                    $('.btn').addClass("disabled");
                    window.location.href = window.location.origin +
                        '/simulate/pre_simulate?loan_amount=' + loanAmount;
                }
            } else {
                stepper.previous();
                step--;
            }


        }
    </script>
@endpush
