<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Responsiva-{{ $responsiva->responsiva_number }}</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .folio {
            text-align: right;
            font-weight: bold;
        }

        .section {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
        }

        .signature {
            margin-top: 25px;
        }
    </style>
</head>

<body>

    <div class="folio">
        Folio: {{ $responsiva->responsiva_number }}
    </div>

    <div class="header">
        <h3>DOCUMENTO DE RESGUARDO DE ACTIVOS</h3>
    </div>

    <!-- Primera Parte -->
    <div class="section">
        <p>
            <span class="label">Fecha:</span>
            {{ \Carbon\Carbon::parse($responsiva->date)->format('d/m/Y') }}
        </p>
        <p class="label">
            A quien corresponda:
        </p>
        <p>
            Yo, <span class="label">{{ $responsiva->teacher->full_name }}</span>, en mi calidad de <span class="label">Profesor</span> en el COLEGIO WEXFORD,
            por medio de la presente hago constar que he recibido, en calidad de resguardo,
            los siguientes activos propiedad de la empresa:
        </p>
    </div>

    <!-- Tabla -->
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border:1px solid #000; padding:6px;">Dispositivo</th>
                <th style="border:1px solid #000; padding:6px;">Número de serie</th>
                <th style="border:1px solid #000; padding:6px;">Condición</th>
                <th style="border:1px solid #000; padding:6px;">Ubicación</th>
                <th style="border:1px solid #000; padding:6px;">Entregó con</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="border:1px solid #000; padding:6px;">
                    {{ $responsiva->device->description }}
                </td>
                <td style="border:1px solid #000; padding:6px;">
                    {{ $responsiva->device->serial_number }}
                </td>
                <td style="border:1px solid #000; padding:6px;">
                    {{ $responsiva->condition }}
                </td>
                <td style="border:1px solid #000; padding:6px;">
                    {{ $responsiva->location }}
                </td>
                <td style="border:1px solid #000; padding:6px;">
                    {{ $responsiva->delivered_by }}
                </td>
            </tr>

            <!-- FILA DE COMENTARIOS -->
            <tr>
                <td colspan="5" style="border:1px solid #000; padding:6px;">
                    <strong>Comentarios:</strong>
                    <div style="height:60px;"></div>
                </td>
            </tr>
        </tbody>
    </table>


    <!-- Texto -->
    <div class="section" style="text-align: justify;">
        <p>
            <span class="label">1. Responsabilidad:</span> Me comprometo a utilizar estos activos exclusivamente para los fines relacionados con
            mi actividad laboral y a mantenerlos en buen estado de conservación.
        </p>
        <p>
            <span class="label">2. Protección y cuidado:</span> Entiendo que es mi responsabilidad proteger y cuidar adecuadamente los activos
            asignados a mi resguardo, tomando todas las medidas necesarias para evitar daños, pérdidas o robos.
        </p>
        <p>
            <span class="label">3. Reporte de daños o pérdidas:</span> En caso de que algún activo sufra daños, pérdida o robo, me comprometo a
            notificar inmediatamente al <span class="label">Departamento de Desarrollo Humano</span> y a colaborar en cualquier investigación
            o proceso relacionado.
        </p>
        <p>
            <span class="label">4. Devolución de activos:</span> Me comprometo a devolver todos los activos en las mismas condiciones en que me
            fueron entregados (salvo el desgaste normal por el uso) al momento de la terminación de mi relación laboral
            con <span class="label">Colegio Wexford</span>, o cuando me sea solicitado por la empresa.
        </p>
        <p>
            <span class="label">5. Condiciones de uso:</span> Reconozco que cualquier uso indebido de los activos que no esté autorizado por la empresa
            puede dar lugar a sanciones disciplinarias y/o legales, de acuerdo con las políticas internas y la normativa
            vigente. Al firmar este documento, reconozco que he recibido los activos descritos en las condiciones
            indicadas y que asumo la responsabilidad total por su resguardo y uso adecuado.
        </p>
    </div>

    <!-- Firmas -->
    <div class="signature">
        <p>
            <span class="label">Nombre del Empleado:</span> __________________________
        </p>
        <p>
            <span class="label">Firma:</span> ________________________________________
        </p>
        <p>
            <span class="label">Fecha:</span> ________________________________________
        </p>
    </div>

</body>

</html>