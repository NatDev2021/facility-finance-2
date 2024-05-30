<div>
    <div class="row g-3">
        <div class="col-md-3 form-group">
            <label for="inputDescription">Produto</label>
            <select class="form-control" name="id_product" id="id_product" onchange="getProduct()">
                @foreach ($products as $item)
                    <option @selected(($loan['product']['id'] ?? '') == $item->id) value="{{ $item->id }}">{{ $item->description }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-1 mr-auto form-group">
            <label for="inputDescription">&nbsp;</label>
            <img class="form-control" id="image" style="height: 38px; width: 70px"
                src="{{ asset('img/cards/' . ($loan['product']['icon'] ?? $products[0]->icon) . '.svg') }}">

        </div>
        @can('is_admin')
            @if (!empty($loan['id']))
                <div class="col-md-2  form-group ">
                    <label for="inputDescription">Juros</label>
                    <x-input-money id="interest_amount" name="interest_amount" value="{{ $loan['interest_amount'] ?? '' }}"
                        disabled="disabled" />

                </div>
                <div class="col-md-2  form-group ">
                    <label for="inputDescription">Comissão</label>
                    <x-input-money id="commission_amount" name="commission_amount"
                        value="{{ $loan['commission_amount'] ?? '' }}" disabled="disabled" />

                </div>
            @endif
        @endcan


    </div>

    <div class="row g-3">
        <div class="col form-group">
            <label for="inputDescription">Valor Requerido</label>
            <x-input-money id="loan_amount" name="loan_amount" value="{{ $loan['loan_amount'] ?? '' }}" />

        </div>
        <div class="col-md form-group">
            <label for="inputDescription">Parcelas</label>
            <select class="form-control" name="installments" id="installments" onchange="getInterestRate()">
                @foreach ($loan['product']['parametrizations'] ?? $products[0]->parametrizations as $item)
                    <option @selected(($loan['installments'] ?? '') == $item['installments']) value="{{ $item['installments'] }}">{{ $item['installments'] }}
                    </option>
                @endforeach
            </select>

        </div>
        <div class="col-md form-group">
            <label for="inputDescription">Taxa</label>
            <x-input-percent id="interest_rate" name="interest_rate"
                value="{{ $loan['interest_rate'] ?? $products[0]->parametrizations[0]->interest_rate }}" />

        </div>

        <div class="col-md form-group">
            <label for="inputDescription">Taxa ao Mês</label>
            <x-input-percent id="interest_rate_month" name="interest_rate_month"
                value="{{ $loan['interest_rate_month'] ?? '' }}" />

        </div>
        <div class="col-md form-group">
            <label for="inputDescription">Valor da Parcela</label>
            <x-input-money id="installment_amount" name="installment_amount"
                value="{{ $loan['installment_amount'] ?? '' }}" />

        </div>
        <div class="col-md form-group">
            <label for="inputDescription">Valor Total</label>
            <x-input-money id="financed_amount" name="financed_amount" value="{{ $loan['financed_amount'] ?? '' }}" />

        </div>
        <div class="col-md form-group">
            <label for="inputDescription">&nbsp;</label>
            <button type="button" id="bt_calculate" onclick="calculate()"
                class="form-control btn btn-primary ">Calcular&nbsp;
                <span id="spinner"></span>

            </button>
        </div>
    </div>


</div>

@push('js')
    <script>
        $(document).ready(function() {

            $("#interest_rate_month").prop('disabled', true);
            $("#installment_amount").prop('disabled', true);


        });


        function defineLoanData(data) {
            cleanData();
            $('#loan_amount').val(data['loan_amount']).trigger('input');
            $('#interest_rate').val(data['interest_rate']).trigger('input');
            $('#interest_rate_month').val(data['interest_rate_month']).trigger('input');
            $('#installments').val(data['installments']).trigger('input');
            $('#financed_amount').val(data['financed_amount']).trigger('input');
            $('#installment_amount').val(data['installment_amount']).trigger('input');
            $('#interest_amount').val(data['interest_amount']).trigger('input');
            $('#commission_amount').val(data['commission_amount']).trigger('input');



        }

        function cleanData() {
            $('#loan_amount').val(0).trigger('input');
            $('#interest_rate').val(0).trigger('input');
            $('#interest_rate_month').val(0).trigger('input');
            $('#installments').val(0).trigger('input');
            $('#financed_amount').val(0).trigger('input');
            $('#installment_amount').val(0).trigger('input');
            $('#interest_amount').val(0).trigger('input');
            $('#commission_amount').val(0).trigger('input');

        }

        function calculate() {

            if (!validateEmptyFields('installments', 'interest_rate')) {
                return false
            }

            let loanAmount = $('#loan_amount').val();
            let financedAmount = $('#financed_amount').val();
            var installment = $('#installments').val();
            var idProduct = $('#id_product').val();
            var interestRate = $('#interest_rate').val();


            $.ajax({
                url: "{{ url('simulate/get_simulate') }}" + '?id_product=' + idProduct + '&installment=' +
                    installment + '&loan_amount=' + loanAmount + '&financed_amount=' + financedAmount +
                    '&interest_rate=' +
                    interestRate,
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $('#spinner').addClass("spinner-border spinner-border-sm"); // Liga spiner
                    $('#bt_calculate').addClass("disabled");

                },
                complete: function() {
                    $('#spinner').removeClass("spinner-border spinner-border-sm"); //Desliga spiner
                    $('#bt_calculate').removeClass("disabled");

                },
                success: function(response) {
                    defineLoanData(response);
                }
            });
        }

        function getProduct() {

            var idProduct = $('#id_product').val();

            $.ajax({
                url: "{{ url('products/get') }}" + '/' + idProduct,
                type: "GET",
                dataType: "json",
                success: function(response) {

                    alterProductImage(response);
                    alterInstalmentSelect(response);
                }
            });


        }



        function alterProductImage(response) {
            var img = document.querySelector("#image");
            img.setAttribute('src', window.location.origin + '/img/cards/' + response.icon + '.svg');
        }

        function alterInstalmentSelect(response) {

            var selectElement = document.getElementById('installments');
            selectElement.innerHTML = '';

            // Adiciona as novas opções ao select
            response.parametrizations.forEach(function(option, index) {
                if (index == 0) {
                    alterInterestRate(option);
                }
                var optionElement = document.createElement('option');
                optionElement.value = option.installments;
                optionElement.textContent = option.installments;
                selectElement.appendChild(optionElement);
            });
        }

        function alterInterestRate(parametrizations) {
            $('#interest_rate').val(parametrizations.interest_rate).trigger('input');
        }

        function getInterestRate() {
            var idProduct = $('#id_product').val();
            var installment = $('#installments').val();

            $.ajax({
                url: "{{ url('products/get_parametrization') }}" + '/' + idProduct + '/' + installment,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $('#interest_rate').val(response.parametrizations[0].interest_rate).trigger('input');
                }
            });
        }
    </script>
@endpush
