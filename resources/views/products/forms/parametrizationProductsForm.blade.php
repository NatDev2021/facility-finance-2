<div class="row g-3">
    <input type="hidden" name="product_id" id="product_id" value="{{ $products->id ?? '' }}">
    <input type="hidden" name="parametrization_id" id="parametrization_id" value="">

    <div class="col-md-2 form-group">
        <label for="inputDescription">Parcelas</label>
        <input type="number" name="installments" id="installments" class="form-control" value="">

    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Taxa</label>
        <x-input-percent id="interest_rate" name="rate" />

    </div>

    <div class="col-md-2 form-group">
        <label for="inputDescription">Taxa Máquina</label>
        <x-input-percent id="commission_rate" name="commission" />

    </div>


    <div class="col-md-4 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control"
            placeholder="Identificação da parametrização" value="">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Ativo</label>
        <select class="form-control" name="actived" id="actived">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
    </div>

    <div class="col-md-12 form-group">
        <label for="inputDescription">Tarifas</label>
        <div class="custom-control row d-flex">
            @foreach ($charges as $item)
                <div class=" custom-checkbox col-3">
                    <input class="custom-control-input" type="checkbox" name="charges[]" id="charge_{{ $item->id }}"
                        value="{{ $item->id }}">
                    <label class="custom-control-label"
                        for="charge_{{ $item->id }}">{{ $item->description }}</label>
                </div>
            @endforeach
        </div>
    </div>

</div>

@push('js')
    <script>
        function defineData(data) {
            cleanData();
            $('#interest_rate').val(data.interest_rate).trigger('input');
            $('#installments').val(data.installments).trigger('input');
            $('#commission_rate').val(data.commission_rate).trigger('input');
            $('#parametrizationModal #description').val(data.description);
            $('#parametrization_id').val(data.id);
            $('#actived').val(data.actived);

            data.charges.forEach(charge => {
                $('.custom-control-input#charge_' + charge.charge_id).prop('checked', true);
            });

        }

        function cleanData() {
            $('#interest_rate').val('').css('border', '');
            $('#installments').val('').css('border', '');
            $('#commission_rate').val('').css('border', '');
            $('#parametrizationModal #description').val('');
            $('#parametrization_id').val('');
            $('#actived').val(1);
            $('.custom-control-input').prop('checked', false);
            $("#parametrizationModal input").prop('disabled', false);

        }
    </script>
@endpush
