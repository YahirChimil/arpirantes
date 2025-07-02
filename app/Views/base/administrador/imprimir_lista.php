<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Aspirantes - Grupo <?= esc($grupo['id']) ?></title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 2rem; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .encabezado { margin-bottom: 2rem; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align: right;">
        <button onclick="window.print()">🖨️ Imprimir</button>
    </div>

    <h1>Lista de Aspirantes</h1>
    <h2>Grupo <?= esc($grupo['id']) ?> - <?= esc($grupo['nombre']) ?></h2>

    <div class="encabezado">
        <p><strong>Carrera:</strong> <?= esc($grupo['nombre_carrera']) ?></p>
        <p><strong>Sede:</strong> <?= esc($grupo['nombre_sede']) ?></p>
        <p><strong>Aula:</strong> <?= esc($grupo['nombre_aula'] ?? 'Sin asignar') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>CURP</th>
                <th>Nombre Completo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aspirantes as $i => $asp): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($asp['curp']) ?></td>
                    <td><?= esc($asp['nombre'] . ' ' . $asp['primer_apellido'] . ' ' . $asp['segundo_apellido']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
