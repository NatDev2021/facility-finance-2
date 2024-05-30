<div class="row g-3">
    <input type="hidden" name="id_charge" id="id_charge" value="{{ '' }}">

    <div class="col-md-6 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Tipo</label>
        <select class="form-control" name="type" id="type">
            <option value="value">(R$) - Valor</option>
            <option value="percent">(%) - Percentual</option>
        </select>
    </div>
    <div class="col-md-3 form-group">
        <label for="inputDescription">Ativo</label>
        <select class="form-control" name="actived" id="actived">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
    </div>

</div>

@push('js')
    <script>
        function defineData(data) {
            cleanData()
            $('#description').val(data.description);
            $('#actived').val(data.actived);
            $('#id_charge').val(data.id);
            $('#type').val(data.type);

        }

        function cleanData() {
            $('#description').val('').css('border', '');;
            $('#actived').val(1);
            $('#type').val('value');
            $('#id_charge').val('');
        }
    </script>
@endpush
