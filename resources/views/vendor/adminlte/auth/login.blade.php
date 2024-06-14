@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
@php($password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
    @php($password_reset_url = $password_reset_url ? route($password_reset_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
    @php($password_reset_url = $password_reset_url ? url($password_reset_url) : '')
@endif
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Login do Usuário</title>
    <link rel="shortcut icon" href="img/favicons/favicon.ico" />
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>

    <link href="css/login.css?<?= date('Y-m-d_H:i:s') ?>" rel="stylesheet" />

    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        body {
            height: 100vh;
            background-color: #e9ecef
        }

        .container {
            margin: 130px auto
        }

        .panel-heading {
            text-align: center;
        }

        #forgot {
            min-width: 100px;
            margin-left: auto;
            text-decoration: none
        }

        a:hover {
            text-decoration: none
        }

        .form-inline label {
            padding-left: 10px;
            margin: 0;
            cursor: pointer
        }

        .btn.btn-dark {
            margin-top: 20px;
            border-radius: 15px;
            background-color: #212529 !important;
        }

        .panel {
            min-height: 380px;
            box-shadow: 20px 20px 80px rgb(218, 218, 218);
            border-radius: 12px
        }

        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #ddd;
            color: #4343ff
        }

        input[type='text'],
        input[type='password'] {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%
        }

        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none
        }



        a[target='_blank'] {
            position: relative;
            transition: all 0.1s ease-in-out
        }

        .bordert {
            border-top: 1px solid #aaa;
            position: relative
        }

        .bordert:after {
            content: "or connect with";
            position: absolute;
            top: -13px;
            left: 33%;
            background-color: #fff;
            padding: 0px 8px
        }

        @media (max-width: 1320px) {

            .company-logo {
                width: 250px;
            }

        }

        @media(max-width: 360px) {
            #forgot {
                margin-left: 0;
                padding-top: 10px
            }

            body {
                height: 100%
            }

            .company-logo {
                width: 250px;
            }

            .container {
                margin: 30px 0
            }

            .bordert:after {
                left: 25%
            }
        }
    </style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
</head>

<body class='snippet-body'>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="/"><img width="150px" src="img/Facility.svg" /></a>
    </nav>

    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-4  offset-lg-4 offset-md-3">
                <div class="panel border bg-white">
                    <div class="panel-heading p-3">
                        <img class="company-logo" width="300px" height="100" src="img/FacilityWeb.svg" />

                    </div>
                    <div class="panel-body p-3">
                        @section('auth_header', __('adminlte::adminlte.login_message'))

                        <form action="{{ $login_url }}" method="POST">
                            @csrf
                            <div class="form-group py-2">
                                <div class="input-field"> <span class="far fa-user p-2"></span>
                                    <input type="text" id="email" name="email"
                                        placeholder="{{ __('adminlte::adminlte.email') }}" autofocus required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group py-1 pb-2">
                                <div class="input-field"> <span class="fas fa-lock px-2"></span>
                                    <input type="password" id="password" name="password"
                                        placeholder="{{ __('adminlte::adminlte.password') }}" required>
                                    <button onclick="showPassword()" type="button" class="btn bg-white text-muted">
                                        <span id="eye" class="far fa-eye-slash"></span>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-inline"><input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="text-muted">Lembrar-me</label> <a
                                    href={{ $password_reset_url }} id="forgot" class="font-weight-bold">Esqueceu a
                                    senha?</a>
                            </div>
                            <button type="submit" class="btn btn-dark btn-block mt-3">Entrar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        function showPassword() {
            var x = document.getElementById("password");
            var eye = document.getElementById("eye");

            if (x.type === "password") {
                x.type = "text";
                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");

            } else {
                x.type = "password";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>

</html>
