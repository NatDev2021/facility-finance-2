@extends('layouts.page')
@section('title', 'Plano de Contas')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Nova Conta a Pagar</h1>
    </div>

@stop


@section('content')

    <div class="content">
        <div class="container-fluid">
            <form action="{{ url('accounts_payable/save') }}" id="accounts_payable" method="post">
                @csrf

                <div class="row">
                    <div class="col-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-regular fa-up"></i>
                                    Dados da Conta

                                </h3>
                            </div>

                            <div class="card-body table-responsive">

                                @include('accounts_payable.forms.accounts_payableForm')


                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="/accounts_payable" class="btn btn-secondary">Voltar</a>
                                        <button type="submit" class="btn btn-success float-right">Salvar</button>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-regular fa-lightbulb"></i>
                                    Dica do Sistema

                                </h3>
                            </div>

                            <div class="card-body table-responsive">
                                <p> - O plano de contas facilita agrupar melhor suas contas em categorias.</p>
                                <p> - Os campos marcados com <span class="text-danger"> (*)</span> são obrigatórios.</p>
                            </div>


                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>

@stop
