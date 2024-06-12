<div class="row g-3">
    <input type="hidden" name="id_accounting_financial" id="id_accounting_financial" value="{{ '' }}">
    <div class="col-md-12 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-12 form-group">
        <label for="bank_id">Banco</label>
        @php
            $config = [
                'dropdownParent' => '#banksAccountsModal',
            ];
        @endphp
        <x-adminlte-select2 name="bank_id" id="bank_id" :config="$config">
            <x-slot name="prependSlot">
                <div class="input-group-text ">
                    <i class=" fa-regular fa-building-columns"></i>
                </div>
            </x-slot>
            <option value="0">Salecione...</option>
            @foreach ($banks as $item)
                <option value="{{ $item->id }}">
                    {{ $item->code . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Agência</label>
        <input type="text" id="agency" name="agency" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Conta</label>
        <input type="text" id="account" name="account" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Dig.Conta</label>
        <input type="text" id="account_dig" name="account_dig" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-12 form-group">
        <label for="inputDescription">Chave Pix</label>
        <input type="text" id="pix_key" name="pix_key" class="form-control" value="{{ '' }}">
    </div>

</div>
@push('js')
    <script>
        $(document).ready(function() { // onloadjs


        });
    </script>
@endpush
