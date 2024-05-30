<div class=" row mb-3 g-3">
    <div class="col-md-2 mr-auto">
        <label for="inputDescription">Incluido Por:</label>
        <input type="text" id="user_insert" class="form-control"   value="{{ $loan->userInsert->name ?? '' }}" disabled>
    </div>
    <div class="col-md-2">
        <label for="inputDescription">Status</label>
        <select class="form-control" name="status_id" id="status_id">
            @foreach ($status as $item)
                <option @selected(($loan->status_id ?? '') == $item->id) value="{{ $item->id }}">{{ $item->description }}</option>
            @endforeach
        </select>
    </div>

</div>
<div class="row">
    <div class="col">
        <x-adminlte-textarea name="note" label="Observação" rows=5 igroup-size="sm" placeholder="Escreva..." >
            <x-slot name="prependSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-lg fa-file-alt "></i>
                </div>
            </x-slot>
            {{ $loan->note ?? '' }}
        </x-adminlte-textarea>
    </div>

</div>

@section('js')
    <script></script>
@stop
