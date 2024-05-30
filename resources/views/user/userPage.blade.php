@extends('layouts.page')

@section('title', 'Usuário')

@section('content_header')
    <h1>Perfil do Usuário</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{url('/img/'.$user->image_profile)}}"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{$user->name}}</h3>
                    <p class="text-muted text-center">{{$user->profile}}</p>

                </div>

            </div>


        </div>

        <div class="col-md-9">

            <form action="{{url('user/save')}}" method="post">
                @csrf
                <input type="hidden" name="id_user" value="{{$user->id}}" autocomplete="off">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#cadastro"
                                                    data-toggle="tab">Cadastro</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#permissoes" data-toggle="tab">Permissões</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="cadastro">

                                @include('user.forms.userForm',['user'=>$user])
                            </div>

                            <div class="tab-pane" id="permissoes">
                                @include('user.forms.userPermissionsForm',['user_permissions'=>$user_permissions])

                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href="/users" class="btn btn-secondary">Voltar</a>
                                <input type="submit" value="Salvar" class="btn btn-success float-right">
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>

    </div>
@stop


