@extends('adminlte::page')

@section('title', 'Materiales')

@section('content_header')
<h1>Materiales</h1>
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
        <h1>Material</h1>
        <form action="{{ route('guardar.material') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $material->id ?? 0 }}">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" value="{{ $material->codigo ?? '' }}" required pattern="\d{8}" title="El código debe ser exactamente 8 dígitos numéricos">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="{{ $material->descripcion ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" value="{{ $material->precio ?? '' }}" required pattern="\d+(\.\d{1,2})?" title="El precio debe ser un número válido, con hasta dos decimales">
            </div>
            <div class="form-group">
                <label for="fecha_caducidad">Fecha de Caducidad:</label>
                <input type="date" id="fecha_caducidad" name="fecha_caducidad" value="{{ $material->fecha_caducidad ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="existencia">Existencia:</label>
                <input type="number" id="existencia" name="existencia" value="{{ $material->existencia ?? '' }}" required pattern="\d+" title="La existencia debe ser un número entero positivo">
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

</body>
@stop

