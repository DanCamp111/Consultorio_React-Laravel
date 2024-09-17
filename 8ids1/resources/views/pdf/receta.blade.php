<!DOCTYPE html>
<html>

<head>
    <title>Receta Médica</title>
    <style>
        @page {
            margin: 5mm 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            border: 1px solid black;
            /* Añadir un borde alrededor de la hoja */
        }

        header,
        footer {
            position: fixed;
            width: 100%;
            text-align: center;
        }

        header {
            top: 0;
        }

        footer {
            bottom: 0;
        }

        .content {
            margin: 0;
            padding: 70px 10px 70px 10px;
            /* Espacio para el encabezado, pie de página y margen interno */
        }

        .section h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            font-size: 12px;
        }

        .observaciones,
        .medicamentos,
        .materiales {
            font-size: 12px;
        }

        .signature {
            text-align: right;
            margin-top: 10px;
            font-size: 12px;
        }

        .signature p {
            display: inline-block;
            width: 100px;
            /* Hacer la línea más larga */
            border-top: 2px solid #000;
            /* Hacer la línea más gruesa */
            padding-top: 5px;
            text-align: center;
        }

        .contact-info {
            font-size: 10px;
            margin-top: 10px;
        }

        .header,
        .footer {
            text-align: center;
            font-size: 12px;
        }

        .header span,
        .footer span {
            display: block;
        }
    </style>
</head>

<body>
    <header class="header">
        <span style="font-size: 20px;"><strong>Receta Médica</strong></span>
        <span style="color: #811801; font-size: 12px;"><strong>Cédula Profesional: {{ $doctor->cedula }}</strong></span>
        <span style="font-size: 12px;">Dr(a) {{ $doctor->nombre }} {{ $doctor->ap_paterno }} {{ $doctor->ap_materno }}</span>
    </header>
    <footer class="footer">
        <span><b>Hospital San Ángel Inn Universidad</b></span>
        <span>Tel. 55 5605 8879 Cel. 55 7909 1858</span>
        <span style="color: #811801;">URGENCIAS: <b>Cel. (55) 5456 7654</b></span>
    </footer>
    <div class="content">
        <table cellspacing="0" style="width: 90%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td colspan="4" style="text-align:left;">
                        <span style="font-size:12px;">
                            <strong>Nombre del Paciente:</strong>
                        </span>
                    </td>
                    <td colspan="16" style="border-bottom:1px solid black;">
                        <span style="font-size:12px;">
                            {{ $paciente->nombre }} {{ $paciente->ap_paterno }} {{ $paciente->ap_materno }}
                        </span>
                    </td>
                    <td colspan="2" style="text-align:left;">
                        <span style="font-size:12px;">
                            <strong>Fecha:</strong>
                        </span>
                    </td>
                    <td colspan="2" style="border-bottom:1px solid black;">
                        <span style="font-size:12px;">
                            {{ $cita->fecha }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="24" class="observaciones">
                        <p>{{ $observaciones }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="24" class="medicamentos">
                        @if($medicamentos->isEmpty())
                        <p>No se han asignado medicamentos.</p>
                        @else
                        <ul>
                            @foreach($medicamentos as $medicamento)
                            <li>{{ $medicamento->descripcion }} - Cantidad: {{ $medicamento->pivot->cantidad }}, Unidad: {{ $medicamento->pivot->unidad }}, Cada Cuánto: {{ $medicamento->pivot->cada_cuanto }}, Días: {{ $medicamento->pivot->dias }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="24" class="materiales">
                        @if($materiales->isEmpty())
                        <p>No se han asignado materiales.</p>
                        @else
                        <ul>
                            @foreach($materiales as $material)
                            <li>{{ $material->descripcion }} - Cantidad: {{ $material->pivot->cantidad }}, Unidad: {{ $material->pivot->unidad }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>