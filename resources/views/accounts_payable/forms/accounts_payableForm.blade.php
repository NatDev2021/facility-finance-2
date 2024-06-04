<div class="row g-3">
    <input type="hidden" name="id_accounting_financial" id="id_accounting_financial" value="{{ '' }}">
    <div class="col-md-8 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="privder">Fornecedor</label>
        <x-adminlte-select2 name="privder" id="privder">
            <option value="0">Salecione...</option>

        </x-adminlte-select2>
    </div>
    <div class="col-md-6 form-group">
        <label for="credit_account">Conta Crédito</label>
        <x-adminlte-select2 name="credit_account" id="credit_account">
            <option value="0">Salecione...</option>

        </x-adminlte-select2>
    </div>

    <div class="col-md-6 form-group">
        <label for="debit_account">Conta Débito</label>
        <x-adminlte-select2 name="debit_account" id="debit_account">
            <option value="0">Salecione...</option>

        </x-adminlte-select2>
    </div>

    <div class="col-md-3  input-group">
        <label for="amount">Valor</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#amount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="amount" id="amount" class="form-control text-right" data-target="#amount"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-3  input-group">
        <label for="amount">Acréscimos/Juros</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#amount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="amount" id="amount" class="form-control text-right" data-target="#amount"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-3  input-group">
        <label for="amount">Abatimentos/Descontos *</label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#amount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="amount" id="amount" class="form-control text-right" data-target="#amount"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-3  input-group">
        <label for="amount">Total </label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#amount" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="amount" id="amount" class="form-control text-right" data-target="#amount"
                data-mask="#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-12 form-group">
        <label for="debit_account">Conta de Desembolso</label>
        <x-adminlte-select2 name="debit_account" id="debit_account">
            <option value="0">Salecione...</option>

        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Data de Cadastro</label>

        <div class="input-group date" id="start_date" data-target-input="nearest">
            <input type="text" name="start_duration_date" id="start_duration_date" class="form-control"
                data-target="#start_duration_date" />
            <div class="input-group-append" data-target="#start_duration_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Vencimento</label>

        <div class="input-group date" id="start_date" data-target-input="nearest">
            <input type="text" name="start_duration_date" id="start_duration_date" class="form-control"
                data-target="#start_duration_date" />
            <div class="input-group-append" data-target="#start_duration_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Data do Pagamento</label>

        <div class="input-group date" id="end_date" data-target-input="nearest">
            <input type="text" name="end_duration_date" id="end_duration_date" class="form-control"
                data-target="#end_duration_date" />
            <div class="input-group-append" data-target="#end_duration_date" data-toggle=" ">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

</div>
