<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name : config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition login-page" style="background-image: url('/images/fondo1.jpg'); background-size: cover; background-repeat: no-repeat;">
<div class="login-box">
    <div class="login-logo">
        <a style="color: white;" href="{{ url('/home') }}"><b>{{  datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name : config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Bienvenido</p>

            <form method="post" action="{{ url('/login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="text"
                           name="login"
                           value="{{ old('username') ?: old('email') }}"
                           placeholder="Correo o nombre de usuario"
                           class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                     @if ($errors->has('username') || $errors->has('email'))
                        <span class="error invalid-feedback">
                            {{ $errors->first('username') ?: $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="Contraseña"
                           class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <!--div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div-->

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </div>

                </div>
            </form>
            <br>
            <p class="mb-1">
                <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
