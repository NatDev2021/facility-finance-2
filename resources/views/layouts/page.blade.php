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

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
            cluster: 'us2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if (data && data.post && data.post.message && data.post.title) {

                notifyMe(data.post.title, data.post.message)
                Toast.fire({
                    icon: data.post.icon,
                    title: data.post.message,
                });
            }
        });


        function notifyMe(title, msg) {
            if (!("Notification" in window)) {
                alert("This browser does not support Desktop notifications");
            }
            if (Notification.permission === "granted") {
                callNotify(title, msg);
                return;
            }
            if (Notification.permission !== "denied") {
                Notification.requestPermission((permission) => {
                    if (permission === "granted") {
                        callNotify(title, msg);
                    }
                });
                return;
            }
        }

        function callNotify(title, msg) {
            new Notification(title, {
                body: msg,
                icon: window.location.origin + '/img/AGILIZACRED.jpg'
            });
        }
    </script>
@stop
