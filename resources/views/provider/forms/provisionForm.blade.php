<div class="row g-3">
    <div class="col-md-6 form-group">
        <label for="credit_account">Conta Crédito</label>
        <x-adminlte-select2 name="credit_account" id="credit_account">
            <option value="0">Salecione...</option>
            @foreach ($accountFinancial as $item)
                <option @selected(($provider->credit_account_id ?? '') == $item->id) value="{{ $item->id }}">
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
                <option @selected(($provider->debit_account_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->account . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
</div>
