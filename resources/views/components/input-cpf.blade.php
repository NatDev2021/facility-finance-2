@props([
    'id',
    'name',
    'value',
    'disabled'

    ])

<input type="text" id="{{$id??''}}" name="{{$name}}" class="form-control cpf  @error('document') is-invalid @enderror"
       value="{{$value}}" autocomplete="off" data-mask="000.000.000-00" data-mask-reverse="true" autocomplete="off" {{$disabled??''}}>

