@extends('adminlte::page')

@section('title', 'Consultorios')

@section('content_header')
<h1>Consultorios</h1>
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
        <h1>Consultorios</h1>
        <form action="{{ route('guardar.consultorio') }}" method="post" id="consultorioForm">
            @csrf
            <input type="hidden" name="id" value="{{ $consultorio->id }}">
            <div class="form-group">
                <label for="numero">Numero:</label>
                <input type="text" id="numero" name="numero" value="{{ $consultorio->numero }}" required pattern="\d+" title="El consultorio solo puede contener dígitos">
                <span class="error-message" id="numeroError">El consultorio solo puede contener dígitos</span>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('consultorioForm').addEventListener('submit', function(event) {
            var numeroInput = document.getElementById('numero');
            var numeroError = document.getElementById('numeroError');
            
            // Limpiar el mensaje de error
            numeroError.style.display = 'none';

            // Verificar que el campo solo contenga números
            var regex = /^\d+$/;
            if (!regex.test(numeroInput.value)) {
                numeroError.style.display = 'block';
                event.preventDefault(); // Evitar el envío del formulario
            }
        });
    </script>

</body>
@stop
