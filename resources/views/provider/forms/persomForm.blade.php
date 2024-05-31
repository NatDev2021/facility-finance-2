<div class="row g-3">
    <div class="col-md-8 form-group">
        <label>Selecionar Pessoa</label>
        @php
            $config = [
                'disabled' => collect($provider ?? [])->isNotEmpty(),
            ];
        @endphp
        <x-adminlte-select2 name="select_person" id="select_person" :config="$config">
            <option value="0">Salecione...</option>
            @foreach ($person as $item)
                <option @selected(($provider->person->id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputName">CPF/CNPJ</label>
        <x-input-cnpj name="document" id="document" value="{{ $provider->person->document ?? '' }}" disabled="disabled" />
    </div>
    <div class="col-md-2 form-group">
        <label for="inputName">CEP</label>
        <x-input-zip-code id="zip_code" name="zip_code" value="{{ $provider->person->address[0]->zip_code ?? '' }}"
            disabled="disabled" />

    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription">Rua</label>
        <input type="text" id="street_address" class="form-control"
            value="{{ $provider->person->address[0]->street_address ?? '' }}" disabled>
    </div>
    <div class="col-md-1 form-group">
        <label for="inputDescription">Número</label>
        <input type="text" id="address_number" class="form-control"
            value="{{ $provider->person->address[0]->address_number ?? '' }}" disabled>
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Bairro</label>
        <input type="text" id="neighborhood" class="form-control"
            value="{{ $provider->person->address[0]->neighborhood ?? '' }}" disabled>
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Cidade</label>
        <input type="text" id="city" class="form-control" value="{{ $provider->person->address[0]->city ?? '' }}"
            disabled>
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Estado</label>
        <input type="text" id="state" class="form-control" value="{{ $provider->person->address[0]->state ?? '' }}"
            disabled>
    </div>
    <div class="col-md-8 form-group">
        <label for="inputDescription">Complemento</label>
        <input type="text" id="complement" class="form-control"
            value="{{ $provider->person->address[0]->complement ?? '' }}" disabled>
    </div>
</div>
@section('js')
    <script>
        $('#select_person').on('change', function() {

            let id_person = $('#select_person').val();
            $.ajax({
                url: "{{ url('person/get') }}" + "/" + id_person,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    defineData(response)
                }
            });


        });

        function defineData(data) {

            $('#document').val(data.document).trigger('input');
            $('#zip_code').val(data.address[0].zip_code).trigger('input');
            $('#street_address').val(data.address[0].street_address);
            $('#address_number').val(data.address[0].address_number);
            $('#neighborhood').val(data.address[0].neighborhood);
            $('#city').val(data.address[0].city);
            $('#state').val(data.address[0].state);
            $('#complement').val(data.address[0].complement);


        }
    </script>
@stop
