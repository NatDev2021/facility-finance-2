@extends('layouts.page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Configuração de Produtos</h1>

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

                <div class="card-body table-responsive p-0">

                    <div class="timeline mt-3">
                        <div>
                            <i class="fa fa-shopping-bag bg-blue"></i>
                            <div class="timeline-item">
                                <form action="{{ url('products/save') }}" id="product_form" method="post">


                                    <x-adminlte-card title="Produto" theme="dark">
                                        @csrf

                                        @include('products.forms.productsForm')
                                        <x-slot name="footerSlot">
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" id="bt_save"
                                                        class="btn btn-success float-right">Salvar</button>

                                                </div>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-card>
                                </form>

                            </div>
                        </div>

                        <div>
                            <i class="fa fa-gear bg-blue"></i>
                            <div class="timeline-item">

                                <x-adminlte-card title="Parametrização" theme="dark" body-class="table-responsive">
                                    <table id="parametrization_table" class="table table-striped table-valign-middle ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Descrição</th>
                                                <th>Parcelas</th>
                                                <th>Taxa</th>
                                                <th>Taxa Máquina</th>
                                                <th>Ativo</th>
                                                <th>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="new_parametrization" title="Adicionar Parametrização">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products->parametrizations as $item)
                                                <tr>
                                                    <td id="id">{{ $item->id }}</td>
                                                    <td>{{ $item->description ?? '' }}</td>
                                                    <td>{{ $item->installments ?? '' }}</td>

                                                    <td>{{ ($item->interest_rate ?? '') . ' %' }}
                                                    </td>

                                                    <td>{{ ($item->commission_rate ?? '') . ' %' }}
                                                    </td>
                                                    <td>{{ ($item->actived ?? '') === 1 ? 'Sim' : 'Não' }}</td>

                                                    <td style="text-align: right">
                                                        <a id="edit_parametrization" class="text-muted"
                                                            style="cursor: pointer;">
                                                            <i class="fas fa-search"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </x-adminlte-card>

                            </div>
                        </div>


                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <a href="/products" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>


    <form action="{{ url('products/config/save_parametrization') }}" id="product_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="parametrizationModal">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Parametrização</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('products.forms.parametrizationProductsForm')
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="bt_save_parametrization"
                            class="btn btn-success float-right">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@stop


@push('js')
    <script>
        $(document).ready(function() { // onloadjs

            $('#parametrization_table').on('click', "#edit_parametrization", function() { // onclick bot�o de anexo

                var row = $(this).parents('tr');
                var codParam = $(row.children('#id'))[0].innerHTML;

                $.ajax({
                    url: "{{ url('products/config/get_parametrization') }}" + "/" + codParam,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        defineData(response);
                        $('#parametrizationModal').modal('show');
                    }
                });
            });

            $('#new_parametrization').on('click', function() {
                cleanData();
                $('#parametrizationModal').modal('show');
            });

            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('description', 'icon', 'initial_status_id', 'final_status_id')) {
                    return false;
                }

                let statusInitial = $('#initial_status_id');
                let statusFinal = $('#final_status_id');
                if (statusInitial.val() == statusFinal.val()) {

                    statusInitial.css('border-color', 'red');
                    statusFinal.css('border-color', 'red');

                    Toast.fire({
                        icon: "error",
                        title: "Os campos Status Inicial e Status Final não pdem ser iguais!",
                    });
                    return false;
                }
            });

            $('#bt_save_parametrization').on('click', function() {

                if (!validateEmptyFields('installments', 'interest_rate', 'commission_rate', 'actived')) {
                    return false;
                }
            });


        });
    </script>
@endpush
