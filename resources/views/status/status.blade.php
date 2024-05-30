@extends('layouts.page')

@section('title', 'Status')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Status</h1>
        <button type="button" class="btn btn-outline-primary" id="new_status" data-target="#statusModal">
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

                <div class="card-body table-responsive">
                    <table id="status_table" class="table table-striped table-valign-middle ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descrição</th>
                                <th>Ativo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status as $item)
                                <tr>
                                    <td id="id">{{ $item->id }}</td>
                                    <td><span class="badge"
                                            style="background-color: {{ $item->color ?? '' }};">{{ $item->description ?? '' }}</span>
                                    </td>
                                    <td>{{ ($item->actived ?? '') === 1 ? 'Sim' : 'Não' }}</td>

                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a id="edit_status" class="text-muted mr-3" style="cursor: pointer;"
                                                title="Editar">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a id="delete_status" class="text-muted" style="cursor: pointer;"
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
                        {{ $status->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('status/save') }}" id="status_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('status.forms.statusForm')
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

            $('#status_table').on('click', "#edit_status", function() { // onclick bot�o de anexo

                var row = $(this).parents('tr');
                var codStatus = $(row.children('#id'))[0].innerHTML;

                $.ajax({
                    url: "{{ url('status/get') }}" + "/" + codStatus,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        defineData(response);
                        $('#statusModal').modal('show');
                    }
                });
            });

            $('#new_status').on('click', function() {
                cleanData();
                $('#statusModal').modal('show');
            });


            $('#status_table').on('click', "#delete_status", function() { // onclick bot�o de anexo

                var row = $(this).parents('tr');
                var codStatus = $(row.children('#id'))[0].innerHTML;

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

                        window.location = "{{ url('status/delete') }}" + "/" + codStatus;

                    }
                });


            });

            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('description')) {
                    return false;
                }
            });




        });
    </script>
@endpush
