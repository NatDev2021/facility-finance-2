<x-adminlte-input-file name="input_file[]" label="Selecionar Arquivo" id="input_file" placeholder="Selecione..."
    legend="Navegar" multiple>
    <x-slot name="appendSlot">
        <x-adminlte-button theme="primary" label="Importar" id="btn_impot_file" type="submit" />
    </x-slot>
    <x-slot name="prependSlot">
        <div class="input-group-text text-primary">
            <i class="fas fa-file-upload"></i>
        </div>
    </x-slot>
</x-adminlte-input-file>
<div style="padding-top: 15px" class="table-responsive">
    <table class="table" id="files_table">
        <thead>
            <tr style="color: #455a64; background-color: #f5f5f5">
                <th style='text-align: left;'></th>
                <th style='text-align: left; '>Documento</th>
                <th style='text-align: left;'></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($transactionFiles as $item)
                <tr>
                    <td class="text-left"> <input type="hidden" name="id_file" id="id_file"
                            value="{{ $item->id }}"><i class="fa-regular fa-paperclip"></i></td>
                    <td class="text-left">{{ $item->file_name ?? '' }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a id="loan_detail" href="{{ url('accounts_payable/files/download/' . $item->id) }}"
                                class="text-muted mr-3" style="cursor: pointer;" title="Baixar" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down"></i> </a>
                            @can('is_admin')
                                <a id="delete_file" class="text-muted" style="cursor: pointer;" title="Excluir">
                                    <i class="fa-regular fa-trash-can" style="color: red"></i>
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $transactionFiles->links() }}

    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() { // onloadjs



            $('#files_table').on('click', "#delete_file",

                function() { // onclick bot�o de anexo

                    var row = $(this).closest('tr'); // Seleciona o pai 'tr' mais próximo
                    var firstCell = row.find('td:first-child'); // Seleciona o primeiro filho 'td'
                    var codFile = firstCell.find('#id_file').val(); // Procura pelo elemento com ID 'id_file' dentro do primeiro 'td'
                    Swal.fire({
                        title: "Tem certeza?",
                        text: "Você não poderá reverter isso!",
                        icon: "warning",
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "Cancelar",
                        confirmButtonText: "Sim, excluir"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            window.location = "{{ url('accounts_payable/files/delete') }}" + "/" +
                            codFile;

                        }
                    });


                });


        });
    </script>
@endpush
