<div class=" row g-3">
    <input type="hidden" name="id_document" id="id_document" value="{{ '' }}">

    <div class="col-md-9 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
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
            cleanData();
            $('#description').val(data.description);
            $('#actived').val(data.actived);
            $('#id_document').val(data.id);

        }

        function cleanData() {
            $('#description').val('').css('border', ''); 
            $('#actived').val(1);
            $('#id_document').val('');
        }
    </script>
@endpush
