<div class="row g-3">
    <input type="hidden" name="id_status" id="id_status" value="{{ '' }}">

    <div class="col-md-7 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-2 form-group">
        <label for="inputDescription">Cor</label>
        <input type="color" name="color" class="m-auto form-control form-control-color" id="color"
            value="#006600">
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

            $('#description').val(data.description);
            $('#color').val(data.color);
            $('#actived').val(data.actived);
            $('#id_status').val(data.id);

        }

        function cleanData() {
            $('#description').val('');
            $('#color').val('');
            $('#actived').val(1);
            $('#id_status').val('');
        }
    </script>
@endpush
