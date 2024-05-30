<div class="row g-3">
    <input type="hidden" name="id_address" id="id_address" value="{{ $person->address[0]->id ?? '' }}">

    <div class="col-md-2 form-group">
        <label for="inputName">CEP</label>
        <x-input-zip-code id="zip_code" name="zip_code" value="{{ $person->address[0]->zip_code ?? '' }}" />

    </div>
    <div class="col-md-6 form-group">
        <label for="inputDescription">Rua</label>
        <input type="text" id="street_address" name="street_address" class="form-control"
            value="{{ $person->address[0]->street_address ?? '' }}">
    </div>
    <div class="col-md-1 form-group">
        <label for="inputDescription">Número</label>
        <input type="text" id="address_number" name="address_number" class="form-control"
            value="{{ $person->address[0]->address_number ?? '' }}">
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Bairro</label>
        <input type="text" id="neighborhood" name="neighborhood" class="form-control"
            value="{{ $person->address[0]->neighborhood ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Cidade</label>
        <input type="text" id="city" name="city" class="form-control"
            value="{{ $person->address[0]->city ?? '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Estado</label>
        <input type="text" id="state" name="state" class="form-control"
            value="{{ $person->address[0]->state ?? '' }}">
    </div>
    <div class="col-md-8 form-group">
        <label for="inputDescription">Complemento</label>
        <input type="text" id="complement" name="complement" class="form-control"
            value="{{ $person->address[0]->complement ?? '' }}">
    </div>

</div>


@push('js')
    <script>
        $(document).ready(function() { // onloadjs

            $('#zip_code').on("change", function() { // onclick bot�o de anexo
                console.log($(this))

                var zip_code = $(this).cleanVal();

                $.ajax({
                    url: "https://viacep.com.br/ws/" + zip_code + "/json/",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        defineData(response);
                    }
                });
            });

        });

        function defineData(data){
            $('#street_address').val(data.logradouro);
            $('#neighborhood').val(data.bairro);
            $('#city').val(data.localidade);
            $('#state').val(data.uf);
            $('#state').val(data.uf);

        }
    </script>
@endpush
