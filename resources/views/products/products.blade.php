@extends('layouts.page')

@section('title', 'Produtos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Produtos</h1>
        <button type="button" class="btn btn-outline-primary" id="new_product" onclick="cleanData()" data-toggle="modal"
            data-target="#productModal">
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

                <div class="card-body  p-4">
                    <div class="row">
                        @foreach ($products as $item)
                            <div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch flex-column">
                                <div class="card card-product bg-light d-flex flex-fill">
                                    <input type="hidden" id="id_product" value="{{ $item->id }}">

                                    <div class="card-header text-muted border-bottom-0 ">
                                        <div class="d-flex justify-content-between">
                                            <h2 class="lead"><b>{{ $item->description ?? '' }}</b></h2>
                                            @if($item->actived === 0)
                                            <i class="fa-solid fa-ban" style="color: darkred" title="Inativo"></i>

                                            @elseif(empty($item->parametrizations[0]))
                                            <i class="fa-solid fa-triangle-exclamation" style="color: orange" title="Sem paramentrização disponível."></i>

                                            @else
                                            <i class="fa-solid fa-check" style="color: green" title="Configurado."></i>

                                            @endif

                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-8">
                                                <h1 class="lead">{{ $item->productsType->description ?? '' }}</h1>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fa-solid fa-file-invoice-dollar"></i></span>
                                                        <b>Contratos: </b>0
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-4 text-center" style="font-size: xxx-large">
                                                <img style="height: 55px;"
                                                    src="{{ asset('img/cards/' . ($item->icon ?? '') . '.svg') }}">

                                                {{-- <i class="{{ $item->icon ?? '' }}"></i> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between">
                                            <a id="delete_product" class="text-muted" style="cursor: pointer;"
                                                title="Excluir">
                                                <i class="fa-regular fa-trash-can" style="color: red"></i>
                                            </a>
                                            <a href="products/config/{{ $item->id }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-gear"></i> Configurar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
  
                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('products/save') }}" id="product_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('products.forms.productsForm')
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


            $('.card-product').on('click', "#delete_product", function() { // onclick bot�o de anexo

                var element = $(this).parents('.card-product');
                var idProduct = $(element.children('#id_product')).val();

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

                        window.location = "{{ url('products/delete') }}" + "/" + idProduct;

                    }
                });


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


        });
    </script>
@endpush
