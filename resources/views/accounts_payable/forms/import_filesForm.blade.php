<x-adminlte-input-file name="input_file" label="Selecionar Arquivo" id="input_file" placeholder="Selecione..."
    legend="Navegar">
    <x-slot name="appendSlot">
        <x-adminlte-button theme="primary" label="Importar" id="btn_impot_file"  type="submit" />
    </x-slot>
    <x-slot name="prependSlot">
        <div class="input-group-text text-primary">
            <i class="fas fa-file-upload"></i>
        </div>
    </x-slot>
</x-adminlte-input-file>
<div style="padding-top: 15px" class="table-responsive">
    <table class="table" id="import_table">
        <thead>
            <tr style="color: #455a64; background-color: #f5f5f5">
                <th style='text-align: left; '>Documento</th>
                <th style='text-align: left;'></th>

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
