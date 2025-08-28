<!-- filepath: app/Views/base/publico/pdf_aprobados.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Aspirantes Aprobados</title>
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
    </style>
</head>

<body>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div style="flex: 1; text-align: left;">
            <img src="<?= $logoBase64 ?>" alt="Logo Izquierdo" style="height: 60px; width: auto; object-fit: contain;">
        </div>
        <div style="flex: 1; text-align: right;">
            <?php if (!empty($logo2Base64)): ?>
                <img src="<?= $logo2Base64 ?>" alt="Logo Derecho" style="height: 80px; width: auto; object-fit: contain;">
            <?php endif; ?>
        </div>
    </div>
    <div class="header">

        <h1>Aspirantes Aprobados - Grupo de Curso</h1>
        <div>Instituto Tecnológico de Oaxaca</div>
    </div>
    <div class="info">
        <strong>Sede:</strong> <?= esc($grupo['nombre_sede'] ?? '') ?> &nbsp; | &nbsp;
        <strong>Aula:</strong> <?= esc($grupo['nombre_aula'] ?? '') ?> &nbsp; | &nbsp;
        <strong>Carrera:</strong> <?= esc($grupo['nombre_carrera'] ?? '') ?>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>CURP</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($aspirantes)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No hay aspirantes aprobados en este grupo.</td>
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
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>