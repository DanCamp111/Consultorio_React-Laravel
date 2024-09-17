@extends('adminlte::page')

@section('title', 'Citas')

@section('content_header')
<h1>Citas</h1>
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lista de Citas</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Doctor</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($citas as $cita)
                                <tr>
                                    <td>{{ $cita->id }}</td>
                                    <td>{{ $cita->paciente->nombre }}</td>
                                    <td>{{ $cita->fecha }}</td>
                                    <td>{{ $cita->estado }}</td>
                                    <td>{{ $cita->doctor ? $cita->doctor->nombre : 'No asignado' }}</td>
                                    <td>
                                        @if($cita->estado == 'pendiente')
                                        <form action="{{ route('autorizar.cita') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $cita->id }}">
                                            <button type="submit" class="btn btn-success">Autorizar</button>
                                        </form>
                                        <form action="{{ route('rechazar.cita') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $cita->id }}">
                                            <button type="submit" class="btn btn-danger">Rechazar</button>
                                        </form>
                                        @endif
                                        @if($cita->estado == 'aprobada' && $cita -> id_doctor == null)  	
                                        <form action="{{ route('asignar.doctor') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $cita->id }}">
                                            <select name="id_doctor" required>
                                                <option value="">Seleccione Doctor</option>
                                                @foreach($doctores->where('id_especialidades', $cita->id_especialidades) as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Asignar</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@stop