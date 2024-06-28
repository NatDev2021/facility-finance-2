@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')

@stop

@section('classes_body', 'iframe-mode')
@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    @include('sweetalert::alert')

    <div class="wrapper">
        {{-- Content Wrapper --}}
        @include('adminlte::partials.cwrapper.cwrapper-default')

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')

@stop
