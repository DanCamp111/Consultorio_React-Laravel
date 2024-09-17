@extends('adminlte::page')

@section('title', 'Detalles de la Cita')

@section('content_header')
    <h1>Detalles de la Cita</h1>
@stop

@section('content')
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .form-container, .card {
            max-width: 800px;
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
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">Paciente: {{ $cita->paciente->nombre }} {{ $cita->paciente->ap_paterno }} {{ $cita->paciente->ap_materno }}</p>
                <p class="card-text">Especialidad: {{ $cita->especialidad->nombre }}</p>
                <p class="card-text">Fecha y Hora: {{ $cita->fecha }} {{ $cita->hora }}</p>
                <p class="card-text">Doctor: {{ $cita->doctor->nombre }} {{ $cita->doctor->ap_paterno }} {{ $cita->doctor->ap_materno }}</p>
                <p class="card-text">Cedula Profesional: {{ $cita->doctor->cedula }}</p>
            </div>
        </div>

        <h3>Actualizar Observaciones</h3>
        <form action="{{ route('citas.updateObservaciones', $cita->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="4">{{ $cita->observaciones }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Observaciones</button>
        </form>

        <h3 class="mt-5">Asignar Medicamentos</h3>
        <form action="{{ route('doctor.citas.assignMedicamento', $cita->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="buscarMedicamento">Buscar Medicamento</label>
                <input type="text" class="form-control" id="buscarMedicamento" placeholder="Buscar medicamento...">
            </div>
            <div class="form-group">
                <label for="medicamento">Medicamento</label>
                <select class="form-control" id="medicamento" name="id_medicamento">
                    @foreach($medicamentos as $medicamento)
                        <option value="{{ $medicamento->id }}">{{ $medicamento->descripcion }} ({{ $medicamento->existencias }} disponibles)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" id="unidad" name="unidad" required>
            </div>
            <div class="form-group">
                <label for="cada_cuanto">Cada Cuanto</label>
                <input type="text" class="form-control" id="cada_cuanto" name="cada_cuanto" required>
            </div>
            <div class="form-group">
                <label for="dias">Días</label>
                <input type="number" class="form-control" id="dias" name="dias" required>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Medicamento</button>
        </form>

        <h3 class="mt-5">Asignar Materiales</h3>
        <form action="{{ route('doctor.citas.assignMaterial', $cita->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="buscarMaterial">Buscar Material</label>
                <input type="text" class="form-control" id="buscarMaterial" placeholder="Buscar material...">
            </div>
            <div class="form-group">
                <label for="material">Material</label>
                <select class="form-control" id="material" name="id_material">
                    @foreach($materiales as $material)
                        <option value="{{ $material->id }}">{{ $material->descripcion }} ({{ $material->existencia }} disponibles)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" id="unidad" name="unidad" required>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Material</button>
            <a href="{{ route('doctor.citas.receta', $cita->id) }}" class="btn btn-secondary">
                <i class="fas fa-file-pdf"></i> Generar Receta
            </a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelectOptions = (searchInput, selectElement) => {
                const filter = searchInput.value.toLowerCase();
                const options = selectElement.options;

                for (let i = 0; i < options.length; i++) {
                    const optionText = options[i].text.toLowerCase();
                    if (optionText.includes(filter)) {
                        options[i].style.display = '';
                    } else {
                        options[i].style.display = 'none';
                    }
                }
            };

            const searchMedicamentoInput = document.getElementById('buscarMedicamento');
            const medicamentoSelect = document.getElementById('medicamento');

            searchMedicamentoInput.addEventListener('input', function() {
                filterSelectOptions(searchMedicamentoInput, medicamentoSelect);
            });

            const searchMaterialInput = document.getElementById('buscarMaterial');
            const materialSelect = document.getElementById('material');

            searchMaterialInput.addEventListener('input', function() {
                filterSelectOptions(searchMaterialInput, materialSelect);
            });
        });
    </script>
</body>
@stop
