@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
<h1>Pacientes</h1>
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
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Pacientes</h1>
        <form action="{{ route('guardar.paciente') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $paciente->id }}">
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $paciente->nombre }}" 
                       pattern="[A-Za-z\s]+" title="El nombre solo puede contener letras y espacios" required>
            </div>

            <div class="form-group">
                <label for="ap_paterno">Apellido Paterno:</label>
                <input type="text" id="ap_paterno" name="ap_paterno" value="{{ $paciente->ap_paterno }}" 
                       pattern="[A-Za-z\s]+" title="El apellido paterno solo puede contener letras y espacios" required>
            </div>

            <div class="form-group">
                <label for="ap_materno">Apellido Materno:</label>
                <input type="text" id="ap_materno" name="ap_materno" value="{{ $paciente->ap_materno }}" 
                       pattern="[A-Za-z\s]+" title="El apellido materno solo puede contener letras y espacios" required>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ $paciente->telefono }}" 
                       pattern="\d{10}" title="El teléfono debe contener exactamente 10 dígitos numéricos" required>
            </div>
            
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

</body>
@stop
