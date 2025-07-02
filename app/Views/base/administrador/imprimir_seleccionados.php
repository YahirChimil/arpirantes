<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aspirantes Seleccionados</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        h1 { text-align: center; margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f0f0f0; }
        .btn-print {
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<button onclick="window.print()" class="btn-print">Imprimir Lista</button>

<h1>Aspirantes Seleccionados</h1>

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
            <tr><td colspan="3" style="text-align:center;">No hay aspirantes seleccionados.</td></tr>
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
