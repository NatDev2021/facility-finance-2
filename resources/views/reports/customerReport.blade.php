@extends('layouts.page')

@section('title', 'Relatório de Clientes')

@section('content_header')
    <h1>Relatório de Clientes</h1>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">


            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h2 class="card-title">
                        Total de clientes: {{ $countCustomer }}

                    </h2>
                </div>

                <div class="card-body ">
                    <form id="report_form" method="post">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                {{-- With multiple slots, and plugin config parameter --}}
                                @php
                                    $config = [
                                        'placeholder' => 'Selecione...',
                                        'allowClear' => true,
                                    ];
                                @endphp
                                <x-adminlte-select2 id="customer" name="customer[]" label="Clientes" :config="$config"
                                    multiple>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-address-card"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($customers as $item)
                                        <option @selected(($loan->customer_id ?? '') == $item->id) value="{{ $item->id }}">
                                            {{ $item->person->name }}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="inputDescription">&nbsp;</label>
                                <button type="button" id="bt_generate" onclick="generateReport()"
                                    class="form-control btn btn-success ">Gerar&nbsp;
                                    <span id="spinner"></span>

                                </button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed id="report_embed" type="application/pdf" width="100%" height="600">
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <script>
        function generateReport() {

            var frm = $('#report_form');

            $.ajax({
                url: "{{ url('reports/customer') }}",
                type: "POST",
                dataType: "json",
                data: frm.serialize(),
                beforeSend: function() {
                    $('#spinner').addClass("spinner-border spinner-border-sm"); // Liga spiner
                    $('#bt_generate').addClass("disabled");

                },
                complete: function() {
                    $('#spinner').removeClass("spinner-border spinner-border-sm"); //Desliga spiner
                    $('#bt_generate').removeClass("disabled");

                },
                success: function(response) {
                    var embed = document.querySelector("#report_embed");
                    embed.setAttribute('src', "data:application/pdf;base64," + response.report);
                    $('#reportModal').modal('show');

                }
            });
        }
    </script>
@endpush
