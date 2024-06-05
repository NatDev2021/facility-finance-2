<div class="row ">
    <input type="hidden" name="id_accounting_financial" id="id_accounting_financial" value="{{ '' }}">
    <div class="col-md-12 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-12 form-group">
        <label for="privder">Fornecedor</label>
        <x-adminlte-select2 name="privder" id="privder">
            <option value="0">Salecione...</option>
            @foreach ($providers as $item)
                <option @selected(($loan->customer_id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->person->name }}</option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-6 form-group">
        <label for="credit_account">Conta Crédito</label>
        <x-adminlte-select2 name="credit_account" id="credit_account">
            <option value="0">Salecione...</option>
            @foreach ($accountFinancial as $item)
                <option @selected(($loan->customer_id ?? '') == $item->id) value="{{ $item->id }}">
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
                <option @selected(($loan->customer_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->account . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-3  form-group">
        <label for="value">Valor</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#value" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="value" id="value" class="form-control text-right" data-target="#value"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="addition">Acréscimos/Juros</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#addition" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="addition" id="addition" class="form-control text-right" data-target="#addition"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="discount">Abatimentos/Descontos </label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#discount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="discount" id="discount" class="form-control text-right" data-target="#discount"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-3  form-group">
        <label for="amount">Total </label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#amount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="amount" id="amount" class="form-control text-right" data-target="#amount"
                data-mask="#.##0,00" data-mask-reverse="true" disabled />

        </div>
    </div>
    <div class="col-md-12 form-group">
        <label for="disbursement_account">Conta de Desembolso</label>
        <x-adminlte-select2 name="disbursement_account" id="disbursement_account">
            <option value="0">Salecione...</option>
            @foreach ($disbursementAccounts as $item)
                <option @selected(($loan->customer_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->account . ' - ' . $item->description }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Data de Cadastro</label>

        <div class="input-group date"  data-target-input="nearest">
            <input type="text" name="register_date" id="register_date" class="form-control" />
            <div class="input-group-append" data-target="#register_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Vencimento</label>

        <div class="input-group date"  data-target-input="nearest">
            <input type="text" name="due_date" id="due_date" class="form-control" value=""/>
            <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Data do Pagamento</label>

        <div class="input-group date"  data-target-input="nearest">
            <input type="text" name="pay_date" id="pay_date" class="form-control" />
            <div class="input-group-append" data-target="#pay_date" data-toggle=" ">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>


    <div class="col-md-12 form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1">
            <label class="custom-control-label" for="customSwitch1">Esta conta se repete?</label>
        </div>
    </div>

    <div id ="account_frequency" class="col-md-12 row" style="display: none">
        <div class="col-md-4 form-group">
            <label for="inputDescription">Quant Parcelas/Mensalidades *</label>
            <input type="number" id="description" name="description" class="form-control"
                value="{{ '' }}">
        </div>
        <div class="col-md-4 form-group">
            <label for="privder">Frequência de Repetição </label>
            <x-adminlte-select2 name="privder" id="privder">
                <option value="0">Salecione...</option>

            </x-adminlte-select2>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() { // onloadjs
            $('#register_date').daterangepicker({
                singleDatePicker: true,
                startDate:'',
                locale: {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "D",
                        "S",
                        "T",
                        "Q",
                        "Q",
                        "S",
                        "S"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]

                },
            });

            $('#due_date').daterangepicker({
                singleDatePicker: true,

                locale: {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "D",
                        "S",
                        "T",
                        "Q",
                        "Q",
                        "S",
                        "S"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]

                },
            });
            $('#due_date').val('');

            $('#pay_date').daterangepicker({
                singleDatePicker: true,

                locale: {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "D",
                        "S",
                        "T",
                        "Q",
                        "Q",
                        "S",
                        "S"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]

                },
            });
            $('#pay_date').val('');

            $('#customSwitch1').change(function() {
                if ($(this).is(':checked')) {
                    $('#account_frequency').show();
                } else {
                    $('#account_frequency').hide();
                }
            });
        });
    </script>
@endpush
