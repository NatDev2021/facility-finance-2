@props([
    'id',
    'name',
    'value',
    'disabled'

    ])

<input type="text" id="{{$id??''}}" name="{{$name}}" class="form-control cnpj  @error('document') is-invalid @enderror"
       value="{{$value}}" autocomplete="off" data-mask="00.000.000/0000-00" data-mask-reverse="true" {{$disabled??''}}>

