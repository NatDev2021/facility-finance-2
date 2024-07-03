@extends('layouts.page')

@section('title', 'Relatório de Clientes')

@section('content_header')
    <h1>Relatório de Fornecedores</h1>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">


            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h2 class="card-title">
                        Total de fornecedores: {{ $countProvider }}

                    </h2>
                </div>

                <div class="card-body ">
                    <form id="report_form" method="post">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col-md-2 ">
                                <label for="amount">Tipo</label>
                                <x-adminlte-select name="report_type" id="report_type">
                                    <option value="a">Analítico</option>
                                    <option value="s">Sintético</option>
                                </x-adminlte-select>
                            </div>
                            <div class="col-md-8">
                                {{-- With multiple slots, and plugin config parameter --}}
                                @php
                                    $config = [
                                        'placeholder' => 'Selecione...',
                                        'allowClear' => true,
                                    ];
                                @endphp
                                <x-adminlte-select2 id="provider" name="provider[]" label="Fornecedores" :config="$config"
                                    multiple>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-address-card"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($providers as $item)
                                        <option  value="{{ $item->id }}"> {{ $item->person->name }}</option>
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

            let reportType = $('#report_type').val();
            let providers = $('#provider').val();

            if (reportType == 'a' && providers.length === 0) {

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "O relatório analítico deve conter ao menos um fornecedor selecionado!",
                });
                return false;
            }

            var frm = $('#report_form');
            $.ajax({
                url: "{{ url('reports/provider') }}",
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
