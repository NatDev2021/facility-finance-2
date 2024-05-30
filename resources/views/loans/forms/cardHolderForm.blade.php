<div class=" row g-3">
    <div class="col-md-8 form-group">
        <div class="d-flex justify-content-between">
            <label>Selecionar Pessoa</label>
            <button type="button" class="btn fa-solid fa-arrows-rotate" style="color:lime" title="Atualizar"
                id="bt_update_person"></button>
        </div>

        <x-adminlte-select2 name="select_holder" id="select_holder">
            <option value="0">Salecione...</option>
            @foreach ($persons as $item)
                <option @selected(($loan->cardholder ?? '') == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </x-adminlte-select2>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputName">CPF/CNPJ</label>
        <x-input-cnpj name="document_holder" id="document_holder" value="{{ $loan->holder->document ?? '' }}" disabled="disabled" />
    </div>
</div>
@push('js')
    <script>
        $('#select_holder').on('change', function() {

            let id_person = $('#select_holder').val();

            if (id_person != 0) {
                $.ajax({
                    url: "{{ url('person/get') }}" + "/" + id_person,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        definePersonData(response)
                    }
                });
            } else {
                cleanData()
            }


        });

        function definePersonData(data) {

            $('#document_holder').val(data.document).trigger('input');

        }


        function cleanData() {
            $('#document_holder').val('').trigger('input');

        }

        $('#bt_update_person').on('click', function() {

            $.ajax({
                url: "{{ url('person/get') }}",
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $('#bt_update_person').addClass("disabled");

                },
                complete: function() {
                    $('#bt_update_person').removeClass("disabled");

                },
                success: function(response) {
                    updatePerson(response)
                }
            });
        });

        function updatePerson(response) {

            var selectElement = document.getElementById('select_holder');
            selectElement.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = 0;
            optionElement.textContent = 'Salecione...';
            selectElement.appendChild(optionElement);

            // Adiciona as novas opções ao select
            response.forEach(function(option) {
                var optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.name;
                selectElement.appendChild(optionElement);
            });

            Toast.fire({
                icon: "success",
                title: "Lista de pessoas atualizada.",
            });
        }
    </script>
@endpush
