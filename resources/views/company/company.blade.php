@extends('layouts.page')

@section('title', 'Empresa')

@section('content_header')
    <h1>Empresa</h1>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('company/save') }}" id="company_form" method="post">
                @csrf
                <input type="hidden" name="id_company" id="id_company" value="{{ $company->id ?? '' }}" autocomplete="off">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>

                        </h3>
                    </div>

                    <div class="card-body table-responsive p-0">

                        <div class="timeline mt-3">

                            <div>
                                <i class="fas fa-address-card bg-blue"></i>
                                <div class="timeline-item">
                                    <x-adminlte-card title="Dados Básicos" theme="dark">
                                        @include('company.forms.companyForm')
                                    </x-adminlte-card>
                                </div>
                            </div>

                            <div>
                                <i class="fas fa-home bg-blue"></i>
                                <div class="timeline-item">
                                    <x-adminlte-card title="Endereço" theme="dark">
                                        @include('company.forms.addressForm')
                                    </x-adminlte-card>

                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="bt_save" class="btn btn-success float-right">Salvar</button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>

        </div>

    </div>


@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs


            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('document', 'company_name')) {
                    return false;
                }
                document.getElementById('company_form').submit();

            });




        });
    </script>
@endpush
