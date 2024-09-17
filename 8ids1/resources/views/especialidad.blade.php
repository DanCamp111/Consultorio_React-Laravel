@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
<h1>Especialidades</h1>
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

    .error-message {
        color: red;
        display: none;
    }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Especialidades</h1>
        <form action="{{ route('guardar.especialidad') }}" method="post" id="especialidadForm">
            @csrf
            <input type="hidden" name="id" value="{{ $especialidad->id }}">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $especialidad->nombre }}" required pattern="[A-Za-z\s]+" title="El nombre solo puede contener letras y espacios">
                <span class="error-message" id="nombreError">El nombre solo puede contener letras y espacios.</span>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('especialidadForm').addEventListener('submit', function(event) {
            var nombreInput = document.getElementById('nombre');
            var nombreError = document.getElementById('nombreError');
            
            // Limpiar el mensaje de error
            nombreError.style.display = 'none';

            // Verificar el patrón del campo nombre
            var regex = /^[A-Za-z\s]+$/;
            if (!regex.test(nombreInput.value)) {
                nombreError.style.display = 'block';
                event.preventDefault(); // Evitar el envío del formulario
            }
        });
    </script>

</body>
@stop
