<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludinno| Login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <script src="https://kit.fontawesome.com/f3cd46a135.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="particles-js"></div>
<div class="container ">
    @if (session('error_login'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert-text">
                <span>{{ session('error_login') }}</span>
            </div>
        </div>
    @endif

    @if (session('error_recovery'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert-text">
                <span>{{ session('error_recovery') }}</span>
            </div>
        </div>
    @endif

    @if (session('error_dataTime'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert-text">
                <span>{{ session('error_dataTime') }}</span>
            </div>
        </div>
    @endif

    @if (session('successChagePass'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert-text">
                <span>{{ session('successChagePass') }}</span>
            </div>
        </div>
    @endif

    @if (session('successRecovery'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert-text">
                <span>{{ session('successRecovery') }}</span>
            </div>
        </div>
    @endif

    <div class="card text-center box">
        <div class="card-header">
            <img src="{{ asset('img/AdminLTELogo.png') }}" alt="Logo">
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="form-group InputBox">
                    <input type="email" name="email" value="{{ old('email') }}" required="">
                    <label><i class="fas fa-envelope"></i> Correo electrónico</label>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group InputBox">
                    <input type="password" name="password" required="">
                    <label><i class="fas fa-lock"></i> Contraseña</label>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <button class="btn btn-primary btn-block">{{ __('Ingresar') }}</button>
                </div>

                <div class="form-group">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('Recuérdame') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <a href="{{ route('password.request') }}">Recuperar Contraseña</a>
                </div>

                @if (Route::has('register'))
                    <div class="form-group">
                        <a href="{{ route('register') }}">Registrar una nueva membresía</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7H/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('views/particles/particles.min.js') }}"></script>
<script src="{{ asset('views/particles/app.js') }}"></script>
</body>
</html>
