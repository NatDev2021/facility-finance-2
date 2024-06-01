<div class="row g-3">
    <input type="hidden" name="id_accounting_financial" id="id_accounting_financial" value="{{ '' }}">
    <div class="col-md-12 form-group">
        <label for="inputDescription">Nome</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Conta</label>
        <input type="text" id="account" name="account" class="form-control" value="{{ '' }}">
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Inicio de Vigência</label>

        <div class="input-group date" id="start_date" data-target-input="nearest">
            <input type="text" name="start_duration_date" id="start_duration_date" class="form-control"
                data-target="#start_duration_date" />
            <div class="input-group-append" data-target="#start_duration_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label for="inputDescription">Fim de Vigência</label>

        <div class="input-group date" id="end_date" data-target-input="nearest">
            <input type="text" name="end_duration_date" id="end_duration_date" class="form-control"
                data-target="#end_duration_date" />
            <div class="input-group-append" data-target="#end_duration_date" data-toggle=" ">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 form-group">
        <label for="inputDescription">Descrição</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ '' }}">
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() { // onloadjs
            $('#start_duration_date').daterangepicker({
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

            $('#end_duration_date').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: true,
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
            $('#ModalTitle').html('Editar Conta');
            $('#id_accounting_financial').val(data.id);
            $('#description').val(data.description);
            $('#account').val(data.account);
            $('#name').val(data.name);
            $('#start_duration_date').val(moment(data.start_duration_date).format('DD/MM/YYYY'));
            if (data.end_duration_date !== "0000-00-00") {
                $('#end_duration_date').val(moment(data.end_duration_date).format('DD/MM/YYYY'));
            }


        }

        function cleanData() {
            $('#ModalTitle').html('Nova Conta');
            $('#description').val('').css('border', '');
            $('#account').val('').css('border', '');
            $('#name').val('').css('border', '');
            $('#start_duration_date').val(moment(new Date).format('DD/MM/YYYY')).css('border', '');
            $('#end_duration_date').val('');
            $('#id_accounting_financial').val('');

        }
    </script>
@endpush
