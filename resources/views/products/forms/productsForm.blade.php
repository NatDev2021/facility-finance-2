<div class="row g-3">
    <input type="hidden" name="product_id" id="product_id" value="{{ $products->id ?? '' }}">

    <div class="col-md-6 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control"
            value="{{ $products->description ?? '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Icone</label>
        <select class="form-control" name="icon" id="icon" style="font-family: fontAwesome">

            <option @selected(($products->icon ?? '') == 'visa') value="visa">&#xf1f0; Visa
            <option @selected(($products->icon ?? '') == 'master') value="master">&#xf1f1; Master
            <option @selected(($products->icon ?? '') == 'elo') value="elo">&#xf09d; Elo
            <option @selected(($products->icon ?? '') == 'outros') value="outros">&#xf09d; Outros
        </select>
    </div>

    <div class="col-md-2 form-group">
        <label for="inputDescription">Ativo</label>
        <select class="form-control" name="actived" id="actived">
            <option @selected(($products->actived ?? '') === 1) value="1">Sim</option>
            <option @selected(($products->actived ?? '') === 0) value="0">Não</option>
        </select>
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Status Inicial</label>
        <select class="form-control" name="initial_status_id" id="initial_status_id">
            @foreach ($status as $item)
                <option @selected(($products->initial_status_id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->description }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 form-group">
        <label for="inputDescription">Status Final</label>
        <select class="form-control" name="final_status_id" id="final_status_id">
            @foreach ($status as $item)
                <option @selected(($products->final_status_id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->description }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12 form-group">
        <label for="inputDescription">Documentos Obrigatórios</label>
        <div class="custom-control row d-flex">
            @foreach ($documents as $item)
                <div class=" custom-checkbox col-3">
                    <input class="custom-control-input" type="checkbox" name="documents[]"
                        id="document_{{ $item->id }}" value="{{ $item->id }}" {{ $item->checked ?? '' }}>
                    <label class="custom-control-label"
                        for="document_{{ $item->id }}">{{ $item->description }}</label>
                </div>
            @endforeach
        </div>
    </div>


</div>

@push('js')
    <script>
        function defineData(data) {
            cleanData();
            $('#description').val(data.description);
            $('#color').val(data.color);
            $('#active').val(data.active);
            $('#id_status').val(data.id);

        }

        function cleanData() {
            $('#description').val('').css('border', '');
            $('#initial_status_id').css('border', '');
            $('#final_status_id').css('border', '');
            $('#color').val('');
            $('#active').val('y');
            $('#id_status').val('');
            $('.custom-control-input').prop('checked', false);

        }
    </script>
@endpush
