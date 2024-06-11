<div class="row g-3">
    <input type="hidden" name="id_accounting_financial" id="id_accounting_financial" value="{{ '' }}">
    <div class="col-md-12 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-12 form-group">
        <label for="credit_account">Banco</label>
        <x-adminlte-select2 name="credit_account" id="credit_account">
            <option value="0">Salecione...</option>
            @foreach ($banks as $item)
                <option  value="{{ $item->id }}">
                    {{ $item->code . ' - ' . $item->name }}
                </option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Agência</label>
        <input type="text" id="account" name="account" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Conta</label>
        <input type="text" id="account" name="account" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Dig.Conta</label>
        <input type="text" id="account" name="account" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-12 form-group">
        <label for="inputDescription">Chave Pix</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ '' }}">
    </div>

</div>
