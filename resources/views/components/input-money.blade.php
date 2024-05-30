@props(['id', 'name', 'value', 'placeholder', 'disabled'])

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">R$</span>
    </div> <input type="text" id="{{ $id ?? '' }}" name="{{ $name }}" class="form-control money text-right"
        value="{{ $value ?? '' }}" autocomplete="off" data-mask="#.##0,00" data-mask-reverse="true" placeholder="{{$placeholder ?? ''}}" {{ $disabled ?? '' }}>
</div>
