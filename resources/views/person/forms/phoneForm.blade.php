<div class="d-flex row gap-3">
    <input type="hidden" name="id_phone" value="{{$person->phone[0]->id??''}}" autocomplete="off">

    <div class="col-4 form-group">
        <label for="inputName">Telefone</label>
        <x-input-phone id="phone" name="phone" value="{{$person->phone[0]->phone??''}}" />
    </div>
    <div class="col-4 form-group">
        <label for="inputDescription">Celular</label>
        <x-input-phone id="phone" name="phone" value="{{$person->phone[0]->phone??''}}" />
    </div>
</div>
