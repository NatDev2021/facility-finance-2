<div class=" row g-3">
    <div class="col-md-8 form-group">
        <div class="d-flex justify-content-between">
            <label>Selecionar Cliente</label>
            <button type="button" class="btn fa-solid fa-arrows-rotate" style="color:lime" title="Atualizar"
                id="bt_update_customer"></button>
        </div>

        <x-adminlte-select2 name="select_customer" id="select_customer">
            <option value="0">Salecione...</option>
            @foreach ($customers as $item)
                <option @selected(($loan->customer_id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->person->name }}</option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputName">CPF/CNPJ</label>
        <x-input-cnpj name="document" id="document" value="{{ $customer->person->document ?? '' }}"
            disabled="disabled" />
    </div>
    <div class="col-md-2 form-group">
        <label for="inputName">CEP</label>
        <x-input-zip-code id="zip_code" name="zip_code" value="{{ $customer->personAddress->zip_code ?? '' }}"
            disabled="disabled" />

    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription">Rua</label>
        <input type="text" id="street_address" class="form-control"
            value="{{ $customer->personAddress->street_address ?? '' }}" disabled>
    </div>
    <div class="col-md-1 form-group">
        <label for="inputDescription">Número</label>
        <input type="text" id="address_number" class="form-control"
            value="{{ $customer->personAddress->address_number ?? '' }}" disabled>
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Bairro</label>
        <input type="text" id="neighborhood" class="form-control"
            value="{{ $customer->personAddress->neighborhood ?? '' }}" disabled>
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Cidade</label>
        <input type="text" id="city" class="form-control"
            value="{{ $customer->personAddress->city ?? '' }}" disabled>
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Estado</label>
        <input type="text" id="state" class="form-control"
            value="{{ $customer->personAddress->state ?? '' }}" disabled>
    </div>
    <div class="col-md-8 form-group">
        <label for="inputDescription">Complemento</label>
        <input type="text" id="complement" class="form-control"
            value="{{ $customer->personAddress->complement ?? '' }}" disabled>
    </div>
</div>
@push('js')
    <script>
        $('#select_customer').on('change', function() {

            let id_customer = $('#select_customer').val();
            $.ajax({
                url: "{{ url('customer/get') }}" + "/" + id_customer,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    defineCustomerData(response)
                }
            });


        });

        function defineCustomerData(data) {

            $('#document').val(data.person.document).trigger('input');
            $('#zip_code').val(data.person_address.zip_code).trigger('input');
            $('#street_address').val(data.person_address.street_address);
            $('#address_number').val(data.person_address.address_number);
            $('#neighborhood').val(data.person_address.neighborhood);
            $('#city').val(data.person_address.city);
            $('#state').val(data.person_address.state);
            $('#complement').val(data.person_address.complement);


        }

        $('#bt_update_customer').on('click', function() {

            $.ajax({
                url: "{{ url('customer/get') }}",
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $('#bt_update_customer').addClass("disabled");

                },
                complete: function() {
                    $('#bt_update_customer').removeClass("disabled");

                },
                success: function(response) {
                    updateCustomer(response)
                }
            });
        });

        function updateCustomer(response) {

            var selectElement = document.getElementById('select_customer');
            selectElement.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = 0;
            optionElement.textContent = 'Salecione...';
            selectElement.appendChild(optionElement);

            // Adiciona as novas opções ao select
            response.forEach(function(option) {
                var optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.person.name;
                selectElement.appendChild(optionElement);
            });

            Toast.fire({
                icon: "success",
                title: "Lista de clientes atualizada.",
            });
        }
    </script>
@endpush
