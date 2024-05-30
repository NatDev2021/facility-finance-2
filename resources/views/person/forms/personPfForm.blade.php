<div class="row g-3">
    <div class="col-md-3 form-group">
        <label for="inputName" class="form-label">CPF</label>
        <x-input-cpf name="document" id="document" value="{{ $person->document ?? '' }}" />
        @error('document')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription" class="form-label">Nome</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ $person->name ?? '' }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription" class="form-label">Data de Nascimento</label>
        <input type="date" id="date_birthday" name="date_birthday" class="form-control"
            value="{{ $person->date_birthday ?? '' }}">
    </div>
    <div class="col-md-9 form-group">
        <label for="inputDescription" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $person->email ?? '' }}">
    </div>
    <input type="hidden" name="id_phone" id="id_phone" value="{{ $person->phone[0]->id ?? '' }}" autocomplete="off">
    {{-- TODO: Alterar isso depois --}}
    <div class="col-md-3 form-group">
        <label for="inputName" class="form-label">Telefone</label>
        <x-input-phone id="phone" name="phone" value="{{ $person->phone[0]->phone ?? '' }}" />
    </div>
</div>

