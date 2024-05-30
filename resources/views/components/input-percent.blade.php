@props(['id', 'name', 'value', 'placeholder', 'disabled'])

<div class="input-group">
    <input type="text" id="{{ $id ?? '' }}" name="{{ $name }}" class="form-control money text-right"
        value="{{ $value ?? '' }}" autocomplete="off" data-mask="000,00" data-mask-reverse="true" placeholder="{{$placeholder ?? ''}}" {{ $disabled ?? '' }}>
    <div class="input-group-prepend">
        <span class="input-group-text">%</span>
    </div>
</div>
