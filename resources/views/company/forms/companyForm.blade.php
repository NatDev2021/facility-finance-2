<div class="row g-3">
    <div class="col-md-2 form-group">
        <label for="inputName">CNPJ</label>
        <x-input-cnpj name="document" id="document" value="{{ $company->document ?? '' }}" />
        @error('document')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Razão Social</label>
        <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $company->company_name ?? '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Nome Fantasia</label>
        <input type="text" name="business_name" id="business_name" class="form-control" value="{{ $company->business_name ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputName">Telefone</label>
        <x-input-phone id="phone" name="phone" value="{{ $company->phone ?? '' }}" />
    </div>
</div>
