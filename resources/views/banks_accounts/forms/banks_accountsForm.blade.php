<div class="row g-3">
    <input type="hidden" name="id_banks_accounts" id="id_banks_accounts" value="{{ $account->id ?? '' }}">
    <div class="col-md-6 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ $account->description ?? '' }}">
    </div>

    <div class="col-md-4 form-group">
        <label for="bank_id">Banco</label>
        <x-adminlte-select2 name="bank_id" id="bank_id">
            <x-slot name="prependSlot">
                <div class="input-group-text ">
                    <i class=" fa-regular fa-building-columns"></i>
                </div>
            </x-slot>
            <option value="0">Salecione...</option>
            @foreach ($banks as $item)
                <option   @selected(($account->bank_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->code . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-2  form-group">
        <label for="account_balance">Saldo </label>
        <div class="input-group  date" data-target-input="nearest">
            <div class="input-group-append" data-target="#account_balance" data-toggle="datetimepicker">
                <div class="input-group-text">R$</div>
            </div>
            <input type="text" name="account_balance" id="account_balance" class="form-control text-right"
                data-target="#account_balance" value="{{ $account->account_balance ?? '0,00' }}"
                data-mask="-#.##0,00" data-mask-reverse="true" />

        </div>
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Agência</label>
        <input type="text" autocomplete="off" data-mask="0000"  id="agency" name="agency"
            class="form-control" value="{{ $account->agency ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Conta</label>
        <input type="text" autocomplete="off" data-mask="00000000"  id="account"
            name="account" class="form-control" value="{{ $account->account ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Dig.Conta</label>
        <input type="text" autocomplete="off" data-mask="0"  id="account_dig"
            name="account_dig" class="form-control" value="{{ $account->account_dig ?? '' }}">
    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription">Chave Pix</label>
        <input type="text" id="pix_key" name="pix_key" class="form-control" value="{{ $account->pix_key ?? '' }}">
    </div>

</div>



