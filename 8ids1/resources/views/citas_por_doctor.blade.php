@extends('adminlte::page')

@section('title', 'Citas del Doctor')

@section('content_header')
    <h1>Citas para el Doctor(a) {{ $doctor->nombre }}</h1>
@stop

@section('content')
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-primary,
        .btn-secondary {
            padding: 10px 15px;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007BFF;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #28a745;
        }

        .btn-secondary:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="table-container">
        @if($citas->isEmpty())
            <p>No hay citas para este doctor(a).</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->id }}</td>
                            <td>{{ $cita->paciente->nombre }}</td>
                            <td>
                                <a href="{{ route('doctor.citas.show', $cita->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Ver más
                                </a>
                                <a href="{{ route('doctor.citas.receta', $cita->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-file-pdf"></i> Generar Receta
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
@stop
