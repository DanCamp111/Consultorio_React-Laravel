@extends('adminlte::page')

@section('title', 'Doctores')

@section('content_header')
<h1>Doctores</h1>
@stop

@section('content')

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .form-group input[type="radio"] {
        width: auto;
    }

    .form-group button {
        padding: 10px 15px;
        background-color: #007BFF;
        border: none;
        color: white;
        cursor: pointer;
        border-radius: 5px;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    .password-container {
        position: relative;
    }

    .password-container .toggle-password {
        position: absolute;
        right: 10px;
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Doctores</h1>
        <form action="{{ route('guardar.doctor') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $doctor->id }}">
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $doctor->nombre }}" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
            </div>

            <div class="form-group">
                <label for="ap_paterno">Apellido Paterno:</label>
                <input type="text" id="ap_paterno" name="ap_paterno" value="{{ $doctor->ap_paterno }}" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
            </div>

            <div class="form-group">
                <label for="ap_materno">Apellido Materno:</label>
                <input type="text" id="ap_materno" name="ap_materno" value="{{ $doctor->ap_materno }}" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
            </div>

            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="">Seleccione una especialidad</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}" {{ $doctor->id_especialidades == $especialidad->id ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cedula">Cedula:</label>
                <input type="text" id="cedula" name="cedula" value="{{ $doctor->cedula }}" required>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ $doctor->telefono }}" pattern="\d{10}" title="Debe ingresar exactamente 10 dígitos numéricos" required>
            </div>

            @if (!$doctor->exists)
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $doctor->user ? $doctor->user->email : '' }}" required>
            </div>

            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}" title="Debe tener al menos 12 caracteres, incluyendo letras mayúsculas, minúsculas, números y símbolos" required>
                <span class="toggle-password" onclick="togglePassword()">👁</span>
            </div>
            @endif

            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const passwordToggle = document.querySelector('.toggle-password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordToggle.textContent = '👁'; // Cambia el ícono cuando está visible
        } else {
            passwordField.type = 'password';
            passwordToggle.textContent = '👁'; // Cambia el ícono cuando está oculto
        }
    }
    </script>

</body>
@stop
