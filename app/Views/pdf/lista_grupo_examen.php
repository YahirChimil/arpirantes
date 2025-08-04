<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Aspirantes - Grupo Examen</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            margin-bottom: 10px;
        }

        h1 {
            font-size: 1.5em;
            margin-bottom: 0.5em;
        }

        .info {
            margin-bottom: 10px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #888;
            padding: 7px;
        }

        th {
            background: #e5e7eb;
        }

        .firma {
            height: 35px;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php if ($logoBase64): ?>
            <img src="<?= $logoBase64 ?>" alt="TecNM" class="logo" style="height:60px;">
        <?php endif; ?>
        <h1>Lista de Aspirantes - Grupo de Examen</h1>
        <div>Instituto Tecnológico de Oaxaca</div>
    </div>
    <div class="info">
        <strong>Sede:</strong> <?= esc($grupo['nombre_sede']) ?> &nbsp; | &nbsp;
        <strong>Aula:</strong> <?= esc($grupo['nombre_aula']) ?> &nbsp; | &nbsp;
        <strong>Carrera:</strong> <?= esc($grupo['nombre_carrera']) ?> <br>
        <strong>Fecha:</strong> <?= esc($grupo['fecha']) ?> &nbsp; | &nbsp;
        <strong>Hora:</strong> <?= esc($grupo['hora']) ?>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>CURP</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Firma</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($aspirantes)): ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No hay aspirantes asignados a este grupo.</td>
                </tr>
            <?php else: ?>
                <?php $i = 1;
                foreach ($aspirantes as $asp): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($asp['curp']) ?></td>
                        <td><?= esc($asp['nombre']) ?></td>
                        <td><?= esc($asp['primer_apellido']) ?></td>
                        <td><?= esc($asp['segundo_apellido']) ?></td>
                        <td class="firma"></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>