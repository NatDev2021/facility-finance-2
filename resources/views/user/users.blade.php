@extends('layouts.page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Usuários</h1>
        @can('is_admin')
            <button type="button" class="btn btn-outline-primary" id="new_user" data-toggle="modal" data-target="#userModal">
                <i class="fa-solid fa-plus"></i>
                Adicionar
            </button>
        @endcan
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
                                <th class="text-left">CPF</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">E-mail</th>
                                <th class="text-center">Perfil</th>
                                @can('is_admin')
                                    <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="text-left">{{ Helper::formatDocument($item->document ?? '') }}</td>
                                    <td class="text-left">{{ $item->name }}</td>
                                    <td class="text-left">{{ $item->email }}</td>
                                    <td class="text-center">
                                        {{ ($item->profile ?? '') == 'admin' ? 'Administrador' : 'Usuário' }}</td>
                                    @can('is_admin')
                                        <td class="text-right">
                                            <a href="user/page/{{ $item->id }}" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <form action="{{ url('user/save') }}" id="user_form" method="post">
        @csrf
        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Novo Usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('user.forms.userForm')
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="bt_save" class="btn btn-success float-right">Salvar&nbsp;
                            <span id="spinner"></span>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop


@push('js')
    <script>
        $(document).ready(function() { // onloadjs

            $('#bt_save').on('click', function() {

                if (!validateEmptyFields('document', 'name', 'email')) {
                    return false;
                }
                $('#spinner').addClass("spinner-border spinner-border-sm"); // Liga spiner
                $('.btn').addClass("disabled");
            });


            $('#bt_search').on('click', function() {

                var search = $('#search').val();

                window.location.href = "{{ url('users?search=') }}" + search;


            });


        });
    </script>
@endpush
