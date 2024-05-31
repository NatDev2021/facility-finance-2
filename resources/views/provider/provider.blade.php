@extends('layouts.page')

@section('title', 'Fornecedores')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Fornecedores</h1>
        <a href="{{ url('provider/form') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </a>
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

                <div class="card-body table-responsive ">
                    <table class="table table-striped table-valign-middle ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">CPF/CNPJ</th>
                                <th class="text-left">Nome</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($provider as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="text-left">{{ Helper::formatDocument($item->person->document ?? '') }}</td>
                                    <td class="text-left">{{ $item->person->name ?? '' }}</td>
                                    <td class="text-right">
                                        <a href="provider/edit/{{ $item->id }}" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $provider->links() }}
                    </div>
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

                window.location.href = "{{ url('provider?search=') }}" + search;


            });


        });
    </script>
@endpush
