<div class="row g-3">
    <input type="hidden" name="id_banks_accounts" id="id_banks_accounts" value="{{ $person->banksAccount->id ?? '' }}">
    <div class="col-md-6 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ $person->banksAccount->description ?? '' }}">
    </div>

    <div class="col-md-6 form-group">
        <label for="bank_id">Banco</label>
        <x-adminlte-select2 name="bank_id" id="bank_id">
            <x-slot name="prependSlot">
                <div class="input-group-text ">
                    <i class=" fa-regular fa-building-columns"></i>
                </div>
            </x-slot>
            <option value="0">Salecione...</option>
            @foreach ($banks as $item)
                <option   @selected(($person->banksAccount->bank_id ?? '') == $item->id) value="{{ $item->id }}">
                    {{ $item->code . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>

    <div class="col-md-2 form-group">
        <label for="inputDescription">Agência</label>
        <input type="text" autocomplete="off" data-mask="0000"  id="agency" name="agency"
            class="form-control" value="{{ $person->banksAccount->agency ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Conta</label>
        <input type="text" autocomplete="off" data-mask="00000000"  id="account"
            name="account" class="form-control" value="{{ $person->banksAccount->account ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Dig.Conta</label>
        <input type="text" autocomplete="off" data-mask="0"  id="account_dig"
            name="account_dig" class="form-control" value="{{ $person->banksAccount->account_dig ?? '' }}">
    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription">Chave Pix</label>
        <input type="text" id="pix_key" name="pix_key" class="form-control" value="{{ $person->banksAccount->pix_key ?? '' }}">
    </div>

</div>



