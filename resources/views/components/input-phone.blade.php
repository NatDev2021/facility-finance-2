@props(['id', 'name', 'value', 'disabled'])

<input type="text" id="{{ $id ?? '' }}" name="{{ $name }}" class="form-control phone"
    value="{{ $value }}" data-mask-reverse="true" autocomplete="off" {{ $disabled ?? '' }}>

@push('js')
    <script>
        var options = {
            onKeyPress: function(phone, e, field, options) {
                var masks = ["(99) 9999-99999", "(99) 99999-9999"];
                var mask = (phone.length === 14) ? masks[1] : masks[0];
                $(field).mask(mask, options);
            }
        };

        $({{ $id ?? '.phone' }}).mask('(99) 9999-99990', options);
    </script>
@endpush
