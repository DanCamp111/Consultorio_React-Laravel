<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludinno | Register</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="icon" href="{{ asset('assets/gentella/images/corazon.ico') }}" type="image/ico">
    <script src="https://kit.fontawesome.com/f3cd46a135.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="particles-js"></div>
    <div class="container">
        <div class="card text-center box">
            <div class="card-header">
                <img src="{{ asset('img/AdminLTELogo.png') }}" alt="Logo" style="width: 70px; height: auto;">
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="form-group InputBox">
                        <input type="text" name="name" value="{{ old('name') }}" required>
                        <label><i class="fas fa-user"></i> Nombre completo</label>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group InputBox">
                        <input type="email" name="email" value="{{ old('email') }}" required>
                        <label><i class="fas fa-envelope"></i> Correo electrónico</label>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group InputBox">
                        <input type="password" name="password" required>
                        <label><i class="fas fa-lock"></i> Contraseña</label>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group InputBox">
                        <input type="password" name="password_confirmation" required>
                        <label><i class="fas fa-lock"></i> Confirmar contraseña</label>
                    </div>
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">{{ __('Registrar') }}</button>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('login') }}">Ya tengo una cuenta</a>
                    </div>
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