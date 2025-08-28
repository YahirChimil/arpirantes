<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Aspirantes Seleccionados</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #888;
            padding: 8px;
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
        <h1>Aspirantes Seleccionados</h1>
        <div>Instituto Tecnológico de Oaxaca</div>
        <div style="font-size:11px; color:#666;">Lista generada automáticamente</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>CURP</th>
                <th>Sede</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($aspirantes)): ?>
                <tr>
                    <td colspan="3" style="text-align:center;">No hay aspirantes seleccionados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($aspirantes as $asp): ?>
                    <tr>
                        <td><?= esc($asp['curp']) ?></td>
                        <td><?= esc($asp['nombre_sede']) ?></td>
                        <td><?= esc($asp['nombre_carrera']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>