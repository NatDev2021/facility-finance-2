@extends('layouts.page')

@section('title', 'Fornecedores')

@section('content_header')
    <h1>Cadastro de Fornecedores</h1>
@stop

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('provider/save') }}" id="provider_form" method="post">
                @csrf
                <input type="hidden" name="id_provider" id="id_provider" value="{{ $provider->id ?? '' }}" autocomplete="off">

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
                                    <x-adminlte-card title="Pessoa" theme="dark">
                                        @include('provider.forms.persomForm')
                                    </x-adminlte-card>

                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href="/provider" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-success float-right">Salvar</button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>

        </div>

    </div>

@stop
