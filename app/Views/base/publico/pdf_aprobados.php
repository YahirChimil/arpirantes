<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aspirantes Aceptados</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 40px;
            position: relative;
        }

        .encabezado {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .encabezado h1 {
            font-size: 16px;
            margin: 0;
        }

        .encabezado h2 {
            font-size: 14px;
            margin: 5px 0 0 0;
        }

        .titulo {
            text-align: center;
            font-size: 14px;
            margin: 20px 0 10px 0;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #e0e0e0;
        }

        .pie {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
        }

        .pie small {
            color: #555;
        }
    </style>
</head>
<body>

    <!-- 🟦 Encabezado sin logo -->
    <div class="encabezado">
        <h1>Tecnológico Nacional de México</h1>
        <h2>Instituto Tecnológico de Oaxaca</h2>
    </div>

    <!-- 🟦 Título del listado -->
    <div class="titulo">
        Aspirantes Aceptados - Grupo <?= isset($grupo['nombre']) ? esc($grupo['nombre']) : '' ?>
    </div>

    <!-- 🟦 Tabla de aspirantes -->
    <table>
        <thead>
            <tr>
                <th>CURP</th>
                <th>Nombre</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aspirantes as $a): ?>
                <tr>
                    <td><?= esc($a['curp']) ?></td>
                    <td><?= esc($a['nombre'] . ' ' . $a['primer_apellido'] . ' ' . $a['segundo_apellido']) ?></td>
                    <td><?= esc($a['nombre_carrera']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 🟦 Pie de página abajo -->
    <div class="pie">
        <small>
            Fecha de generación: <?= date('d/m/Y H:i') ?> <br>
            Documento generado automáticamente por el sistema de gestión de nuevo ingreso.
        </small>
    </div>

</body>
</html>
