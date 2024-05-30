@extends('layouts.page')

@section('title', 'Movimento Financeiro')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Movimento Financeiro</h1>
        <button type="button" class="btn btn-outline-primary" id="new_movement" data-target="#movementModal">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </button>
    </div>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>

                    </h3>
                </div>

                <div class="card-body table-responsive ">
                    <table id="movement_table" class="table table-striped table-valign-middle ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movements as $item)
                                <tr>
                                    <td id="id">{{ $item->id }}</td>
                                    <td><i style="font-size: x-large; opacity: 0.7;"
                                            class="fa-solid fa-circle-arrow-{{ $item->type == 'e' ? 'up text-danger' : 'down text-success' }}"
                                            title="{{ $item->type == 'e' ? 'Saída' : 'Entrada' }}"></i></td>
                                    <td class="text-left">{{ $item->description ?? '' }}</td>
                                    <td class="text-right">{{ Helper::formatBrazilianNumber($item->value_amount ?? '') }}
                                    <td class="text-center">{{ Helper::convertToBrazilianDate($item->date ?? '') }}

                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a id="edit_movement" class="text-muted mr-3" style="cursor: pointer;"
                                                title="Editar">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a id="delete_movement" class="text-muted" style="cursor: pointer;"
                                                title="Excluir">
                                                <i class="fa-regular fa-trash-can" style="color: red"></i>
                                            </a>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $movements->links() }}

                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('financial_movement/save') }}" id="movement_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="movementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Movimento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('financial_movement.forms.movementForm')
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="bt_save" class="btn btn-success float-right">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop


@push('js')
    <script>
        $(document).ready(function() { // onloadjs

            $('#movement_table').on('click', "#edit_movement", function() { // onclick bot�o de anexo

                var row = $(this).parents('tr');
                var codMovement = $(row.children('#id'))[0].innerHTML;

                $.ajax({
                    url: "{{ url('financial_movement/get') }}" + "/" + codMovement,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        defineData(response);
                        $('#movementModal').modal('show');
                    }
                });
            });

            $('#new_movement').on('click', function() {
                cleanData();
                $('#movementModal').modal('show');
            });

            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('description', 'value_amount', 'input_date')) {
                    return false;
                }

                if (!validateEmptySelect('type')) {
                    return false;
                }
            });

            $('#movement_table').on('click', "#delete_movement", function() { // onclick bot�o de anexo

                var row = $(this).parents('tr');
                var codMovement = $(row.children('#id'))[0].innerHTML;

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

                        window.location = "{{ url('financial_movement/delete') }}" + "/" + codMovement;

                    }
                });


            });

        });
    </script>
@endpush
