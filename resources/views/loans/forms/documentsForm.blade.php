@php
    $config = [
        'dropZoneTitle' => 'Arraste e solte arquivos aqui…',
        'msgProcessing' => 'Carregando...',
    ];
@endphp
<x-adminlte-input-file-krajee id="input_document" name="input_document[]" igroup-size="sm" :config="$config"
    data-msg-placeholder="Selecione múltiplos arquivos..." data-show-cancel="false" data-show-close="false" multiple />
<x-adminlte-card title="Documentos Adicionados" theme="dark" icon="fa-solid fa-folder-open" body-class="table-responsive"
    collapsible>
    <table id="loans_table" class="table table-striped table-valign-middle ">
        <thead>
            <tr>
                <th class="text-center">Arquivo</th>
                <th class="text-center">Data/Hora</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $item)
                <tr>
                    <td class="text-center">{{ $item->file_name }}</td>
                    <td class="text-center">{{ Helper::convertToBrazilianDateHour($item->created_at ?? '') }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a id="loan_detail" href="{{ url('loans/files/download/' . $item->id) }}"
                                class="text-muted mr-3" style="cursor: pointer;" title="Baixar" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down"></i> </a>
                            @can('is_admin')
                                <a id="delete_document" class="text-muted" style="cursor: pointer;" title="Excluir">
                                    <i class="fa-regular fa-trash-can" style="color: red"></i>
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-adminlte-card>
