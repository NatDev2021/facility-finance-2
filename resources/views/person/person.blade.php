@extends('layouts.page')
@section('title', 'Pessoas')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Pessoas</h1>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
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
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                            </h3>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end  p-0">

                            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                                <i class="fas fa-search text-end"></i>
                            </a>

                            <div class="navbar-search-block" style="display: {{ empty($search) ? 'none' : 'flex' }};">
                                <x-adminlte-input name="search" id="search" placeholder="pesquisar" label="&nbsp;"
                                    value="{{ $search ?? '' }}">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button icon="fas fa-search" theme="success" id="bt_search" />

                                        <x-adminlte-button icon="fas fa-times" theme="danger" data-widget="navbar-search" />
                                    </x-slot>

                                </x-adminlte-input>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">CPF/CNPJ</th>
                                <th class="text-left">Nome</th>
                                <th class="text-left">E-mail</th>
                                <th class="text-center">Telefone</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($person as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="text-left">{{ Helper::formatDocument($item->document ?? '') }}</td>
                                    <td class="text-left">{{ $item->name ?? '' }}</td>
                                    <td class="text-left">{{ $item->email ?? '' }}</td>
                                    <td class="text-center">{{ Helper::formatPhoneNumber($item->phone[0]->phone ?? '') }}
                                    </td>
                                    <td class="text-right">
                                        <a href="person/edit/{{ $item->id }}" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $person->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nova Pessoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Selecione o tipo de pessoa que deseja adicionar.
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ url('person/form/pf') }}" class="btn btn-primary">Física</a>
                    <a href="{{ url('person/form/pj') }}" class="btn btn-primary">Jurídica</a>
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs



            $('#bt_search').on('click', function() {

                var search = $('#search').val();

                window.location.href = "{{ url('person?search=') }}" + search;


            });


        });
    </script>
@endpush
