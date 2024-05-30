<div class="row g-3">
    <div class="col-md-3 form-group">
        <label for="inputName">CNPJ</label>
        <x-input-cnpj  name="document" id="document" value="{{$person->document??''}}" />
        @error('document')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription">Razão Social</label>
        <input type="text" name="name" id="name" class="form-control" value="{{$person->name??''}}">
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Representante</label>
        <input type="text" id="representative" name="representative" value="{{$person->representative??''}}" class="form-control">
    </div>
    <div class="col-md-9 form-group">
        <label for="inputDescription">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{$person->email??''}}">
    </div>
    <input type="hidden" name="id_phone" value="{{$person->phone[0]->id??''}}" autocomplete="off"> {{-- TODO: Alterar isso depois --}}
    <div class="col-md-3 form-group">
        <label for="inputName">Telefone</label>
        <x-input-phone id="phone" name="phone" value="{{$person->phone[0]->phone??''}}" />
    </div>
</div>
