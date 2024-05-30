@extends('layouts.page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Simulador</h1>
    </div>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-9">
                            <div class="card card-primary card-outline card-tabs">

                                <div class="card-body">

                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">

                                            @foreach ($products as $key => $item)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $key == 0 ? ' active' : '' }}"
                                                        id="custom-tabs-three-{{ $item['description'] }}-tab"
                                                        data-toggle="pill"
                                                        href="#custom-tabs-three-{{ $item['description'] }}" role="tab"
                                                        aria-controls="custom-tabs-three-{{ $item['description'] }}"
                                                        aria-selected="{{ $key == 0 ? ' true' : 'false' }}">{{ $item['description'] }}&nbsp;&nbsp;<img
                                                            style="height: 25px;"
                                                            src="{{ asset('img/cards/' . ($item['icon'] ?? '') . '.svg') }}"></a>


                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content table-responsive" id="custom-tabs-three-tabContent">

                                            @foreach ($products as $key => $item)
                                                <div class="tab-pane fade {{ $key == 0 ? ' show active' : '' }}"
                                                    id="custom-tabs-three-{{ $item['description'] }}" role="tabpanel"
                                                    aria-labelledby="custom-tabs-three-{{ $item['description'] }}-tab">
                                                    <input type="hidden" name="id_product" id="id_product"
                                                        value="{{ $item['id'] ?? '' }}">
                                                    <input type="hidden" name="loan_amount" id="loan_amount"
                                                        value="{{ $loanAmount ?? '' }}">

                                                    <table id="simulate_table"
                                                        class="table table-striped table-valign-middle ">
                                                        <thead>
                                                            <tr>
                                                                <th>x</th>
                                                                <th class="text-center">Parcela</th>
                                                                <th class="text-center">Taxa</th>
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item['simulate'] as $simulate)
                                                                <tr>
                                                                    <td id="installment">
                                                                        {{ $simulate['installments'] }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ Helper::formatBrazilianNumber($simulate['installment_amount'] ?? '') }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ Helper::formatBrazilianNumber($simulate['interest_rate_month'] ?? '') }}&nbsp;%
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ Helper::formatBrazilianNumber($simulate['financed_amount'] ?? '') }}
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex justify-content-end">
                                                                            <a id="add_loan" class="text-muted"
                                                                                style="cursor: pointer;"
                                                                                title="Incluir Contrato">
                                                                                <i class="fa-solid fa-money-check-dollar-pen"
                                                                                    style="color: green"></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <form action="{{ url('simulate/pre_simulate') }}" id="simulate_form" method="get">
                                @csrf

                                <div class="card card-primary card-outline">
                                    <div class="card-body ">
                                        <div class="row ">

                                            <div class="col-12 form-group">
                                                <label for="inputDescription">Digite o valor solicitado para
                                                    simular.</label>
                                                <x-input-money id="loan_amount" name="loan_amount"
                                                    value="{{ $loanAmount ?? '' }}" />

                                            </div>
                                            <div class="col-12 form-group">
                                                <button type="button" id="bt_simulate"
                                                    class="btn btn-primary col">Simular</button>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </form>



                        </div>

                    </div>

                </div>
            </section>
        </div>

    </div>

@stop

@push('js')
    <script>
        $('.table').on('click', "#add_loan", function() {

            $('.btn .text-muted').addClass("disabled");
            var row = $(this).parents('tr');
            var installment = $(row.children('#installment'))[0].innerHTML;
            var carouseProduct = $(this).parents('.tab-pane');
            var idProduct = $(carouseProduct.children('#id_product')).val();
            var loanAmount = $(carouseProduct.children('#loan_amount')).val();
            window.location.href = window.location.origin + '/simulate/form?id_product=' + idProduct +
                '&installment=' + installment + '&loan_amount=' + loanAmount;

        });


        
        $('#bt_simulate').on('click', function() {
            if (validateEmptyFields('loan_amount')) {
                document.getElementById('simulate_form').submit();
            }
        })
    </script>
@endpush
