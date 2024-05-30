<div class="row g-3">
    <input type="hidden" name="movement_id" id="movement_id" value="">


    <div class="col-md-6 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control"
            placeholder="Identificação da entrada" value="">
    </div>

    <div class="col-md-2 form-group">
        <label for="inputDescription">Valor</label>
        <x-input-money id="value_amount" name="value_amount" />

    </div>

    <div class="col-md-2 form-group">
        <label for="inputDescription">Data</label>

        <div class="input-group date" id="date" data-target-input="nearest">
            <input type="text" name="date" id="input_date" class="form-control" data-target="#date" />
            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>


    <div class="col-md-2 form-group">
        <label for="inputDescription">Tipo</label>
        <select class="form-control" name="type" id="type">
            <option value="0">Selecione...</option>
            <option value="i">Entrada</option>
            <option value="e">Saída</option>
        </select>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="note" id="note" label="Observação" rows=5 igroup-size="sm"
            placeholder="Escreva...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-lg fa-file-alt "></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>



</div>

@push('js')
    <script>
        $(document).ready(function() { // onloadjs
            $('#input_date').daterangepicker({
                singleDatePicker: true,

                locale: {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "D",
                        "S",
                        "T",
                        "Q",
                        "Q",
                        "S",
                        "S"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]

                },
            });
        });

        function defineData(data) {
            cleanData();
            $('#movement_id').val(data['id']);
            $('#description').val(data['description']);
            $('#value_amount').val(data['value_amount']).trigger('input');
            $('#input_date').val(moment(data['date']).format('DD/MM/YYYY'));
            $('#type').val(data['type']);
            $('#note').val(data['note']);



        }

        function cleanData() {
            $('#movement_id').val('');
            $('#description').val('').css('border', '');
            $('#value_amount').val('').css('border', '');
            $('#input_date').val(moment(new Date).format('DD/MM/YYYY')).css('border', '');
            $('#type').val(0).css('border', '');
            $('#note').val('').css('border', '');
        }
    </script>
@endpush
