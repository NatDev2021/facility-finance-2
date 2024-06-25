@extends('layouts.page')

@section('title', 'Integração Finne')

@section('content_header')
    <h1>Integração Finne</h1>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">


            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h2 class="card-title">

                    </h2>
                </div>

                <div class="card-body">
                    <div class="card card-body">

                        <form id="finne_form" method="post">
                            @csrf
                            <div class="row justify-content-md-center">
                                <div class="col-md-2">
                                    <label for="amount">Tipo</label>
                                    <x-adminlte-select name="type" id="type">
                                        <option value="0">Salecione...</option>
                                        <option @selected(($search['status'] ?? '') == 'p') value="p">Pagamento</option>
                                        <option @selected(($search['status'] ?? '') == 'r') value="r">Recebimento</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col-md-4">
                                    <x-adminlte-select2 id="customer" name="person" label="Cliente/Fornecedor" >
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fa-solid fa-address-card"></i>
                                            </div>
                                        </x-slot>
                                        <option value="0">Salecione...</option>
                                        @foreach ($person as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                </div>
                                <div class="col-md-2">
                                    <label for="amount">Status</label>
                                    <x-adminlte-select name="status" id="status">
                                        <option value="0">Salecione...</option>
                                        <option @selected(($search['status'] ?? '') == 'p') value="p">Pago</option>
                                        <option @selected(($search['status'] ?? '') == 'o') value="o">Pendente</option>
                                        <option @selected(($search['status'] ?? '') == 'd') value="d">Em Atraso</option>
                                        <option @selected(($search['status'] ?? '') == 't') value="t">Vence Hoje</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputDescription">Vencimento</label>
                                    <div class="input-group date" id="date" data-target-input="nearest">
                                        <div class="input-group-append" data-target="#due_date">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="text" name="due_date" id="due_date" class="form-control "
                                            data-target="#due_date" />

                                    </div>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="inputDescription">&nbsp;</label>
                                    <button type="button" id="bt_search" class="form-control btn btn-success ">Buscar
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div style="padding-top: 15px" class="table-responsive">
                        <div id="jsGrid"></div>
                        {{-- <table class="table" id="import_table">
                            <thead>
                                <tr>
                                    <th style='text-align: center; '>Tipo</th>
                                    <th class="text-center">Vencimento</th>
                                    <th class="text-left">Descrição</th>
                                    <th class="text-center">Cliente\Fornecedor</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table> --}}
                    </div>
                </div>

            </div>

        </div>

    </div>


@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs
            $('#input_date').daterangepicker({
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

            $('#bt_search').on('click', function(){

                var frm = $('#finne_form');
                $.ajax({
                        url: "{{ url('integration/finne/get_transaction') }}",
                        type: "GET",
                        data: frm.serialize(),
                        success: function(response) {
                           console.log(response);
                        }
                    });
            })


        });
    </script>
@endpush
