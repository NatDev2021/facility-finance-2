@props([
    'id',
    'name',
    'value',
    'disabled'

    ])

<input type="text" id="{{$id??''}}" name="{{$name??''}}"  class="form-control zip_code  @error('zip_code') is-invalid @enderror"
       value="{{$value??''}}" data-mask="00000-000" data-mask-reverse="true" autocomplete="off" {{$disabled??''}}>

