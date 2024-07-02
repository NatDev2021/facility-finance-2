<div class="row ">
    <input type="hidden" name="id_financial_transactions" id="id_financial_transactions"
        value="{{ $financialTransaction->id ?? '' }}">
    <div class="col-md-6 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control"
            value="{{ $financialTransaction->description ?? '' }}">
    </div>
    <div class="col-md-6 form-group">
        <label for="provider_id">Fornecedor</label>
        <x-adminlte-select2 name="provider_id" id="provider_id">
            <option value="0">Salecione...</option>
            @foreach ($providers as $item)
                <option @selected(($financialTransaction->customer_provider_id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->person->name }}</option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-6 form-group">
        <label for="credit_account">Conta Crédito</label>
        <x-adminlte-select2 name="credit_account" id="credit_account">
            <option value="0">Salecione...</option>
            @foreach ($accountFinancial as $item)
                <option @selected(($financialTransaction->credit_account_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->account . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>

    <div class="col-md-6 form-group">
        <label for="debit_account">Conta Débito</label>
        <x-adminlte-select2 name="debit_account" id="debit_account">
            <option value="0">Salecione...</option>
            @foreach ($accountFinancial as $item)
                <option @selected(($financialTransaction->debit_account_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->account . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-6 form-group">
        <label for="disbursement_account">Conta de Desembolso</label>
        <x-adminlte-select2 name="disbursement_account_id" id="disbursement_account_id">
            <option value="0">Salecione...</option>
            @foreach ($disbursementAccounts as $item)
                <option @selected(($financialTransaction->disbursement_account_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->description . ' - ' . $item->agency . ' - ' . $item->account . ' - ' . $item->account_dig . ' / ' . $item->bank->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-6 form-group">
        <label for="disbursement_account">Forma de Pagamento</label>
        <x-adminlte-select name="payment_method_id" id="payment_method_id">
            <option value="0">Salecione...</option>
            @foreach ($paymentMethod as $item)
                <option @selected(($financialTransaction->payment_method_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->description }}
                </option>
            @endforeach
        </x-adminlte-select>
    </div>

    <div class="col-md-12 form-group" id="document_key_group"
        style="display: {{ ($financialTransaction->payment_method_id ?? '') == 2 ? 'block' : 'none' }}">
        <label for="document_key">Código de barras / Linha Digitável</label>
        <input type="text" id="document_key" name="document_key" class="form-control"
            value="{{ $financialTransaction->document_key ?? '' }}">
    </div>

    <div class="col-md-4 form-group">
        <label for="inputDescription">Data de Cadastro</label>

        <div class="input-group date" data-target-input="nearest">
            <input type="date" name="register_date" id="register_date" class="form-control"
                value="{{ $financialTransaction->register_date ?? date('Y-m-d') }}" />
            <div class="input-group-append" data-target="#register_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Vencimento</label>

        <div class="input-group date" data-target-input="nearest">
            <input type="date" name="due_date" id="due_date" class="form-control"
                value="{{ $financialTransaction->due_date ?? '' }}" />
            <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Data do Pagamento</label>

        <div class="input-group date" data-target-input="nearest">
            <input type="date" name="pay_date" id="pay_date" class="form-control"
                value="{{ $financialTransaction->pay_date ?? '' }}" />
            <div class="input-group-append" data-target="#pay_date" data-toggle=" ">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="value">Valor</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#value" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="value" id="value" class="form-control text-right"
                data-target="#value" value="{{ $financialTransaction->value ?? '' }}" data-mask="#.##0,00"
                data-mask-reverse="true" onkeyup="updateAmount()" />

        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="addition">Acréscimos/Juros</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#addition" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="addition" id="addition" class="form-control text-right"
                data-target="#addition" data-mask="#.##0,00" data-mask-reverse="true"
                value="{{ $financialTransaction->addition ?? '' }}" onkeyup="updateAmount()" />

        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="discount">Abatimentos/Descontos </label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#discount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="discount" id="discount" class="form-control text-right"
                data-target="#discount" value="{{ $financialTransaction->discount ?? '' }}" data-mask="#.##0,00"
                data-mask-reverse="true" onkeyup="updateAmount()" />

        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="amount">Total </label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#amount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="amount" id="amount" class="form-control text-right"
                data-target="#amount" value="{{ $financialTransaction->amount ?? '' }}" data-mask="#.##0,00"
                data-mask-reverse="true" disabled />

        </div>
    </div>
    @empty($financialTransaction->id)
        <div class="col-md-12 form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="enable_frequency" name="enable_frequency">
                <label class="custom-control-label" for="enable_frequency">Esta conta se repete?</label>
            </div>
        </div>

        <div id ="account_frequency" class="col-md-12 row" style="display: none">
            <div class="col-md-4 form-group">
                <label for="inputDescription">Quant Parcelas/Mensalidades *</label>
                <input type="number" id="frequency_number" name="frequency_number" class="form-control"
                    value="{{ '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="privder">Frequência de Repetição </label>
                <x-adminlte-select name="frequency" id="frequency">
                    <option selected value="30">MENSAL</option>
                    <option value="365">ANUAL</option>
                    <option value="7">SEMANAL</option>
                    <option value="15">QUINZENAL</option>
                    <option value="1">DIARIO</option>

                </x-adminlte-select>
            </div>
        </div>
    @endempty
</div>
@push('js')
    <script>
        $(document).ready(function() { // onloadjs

            $('#enable_frequency').change(function() {
                if ($(this).is(':checked')) {
                    $('#account_frequency').show();
                } else {
                    $('#account_frequency').hide();
                }
            });

            $('#payment_method_id').change(function() {
                if ($(this).val() == 2) {
                    $('#document_key_group').show();

                } else {
                    $('#document_key_group').hide();
                }
            });

            $('#provider_id').on('change', function() {

                let id_provider = $('#provider_id').val();
                $.ajax({
                    url: "{{ url('provider/get') }}" + "/" + id_provider,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        defineData(response)
                    }
                });


            });

        });

        function updateAmount() {
            let value = $('#value').val();
            value = value.replace(".", "");
            value = value.replace(",", ".");
            let discount = $('#discount').val();
            discount = discount.replace(".", "");
            discount = discount.replace(",", ".");
            let addition = $('#addition').val();
            addition = addition.replace(".", "");
            addition = addition.replace(",", ".");

            if (value.trim() == "") {
                value = 0;
            }

            if (discount.trim() == "") {
                discount = 0;
            }
            if (addition.trim() == "") {
                addition = 0;
            }

            var amount = parseFloat(value) + parseFloat(addition) - parseFloat(discount);
            $('#amount').val(amount.toLocaleString('pt-br', {
                minimumFractionDigits: 2
            }));
        }

        function defineData(data) {

            if (data.debit_account_id) {
                $('#debit_account').val(data.debit_account_id).trigger('change');

            }
            if (data.credit_account_id) {
                $('#credit_account').val(data.credit_account_id).trigger('change');

            }


        }
    </script>
@endpush
