<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <title>Calificaciones del Aspirante</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 p-6">

    <div class="max-w-3xl mx-auto bg-white shadow p-6 rounded">

        <h1 class="text-2xl font-bold mb-4">
            Calificaciones de: <?= esc($aspirante['nombre']) ?> <?= esc($aspirante['primer_apellido']) ?>
            <?= esc($aspirante['segundo_apellido']) ?>
        </h1>

        <form method="post" action="<?= base_url('calificaciones/actualizar') ?>" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="curp" value="<?= esc($aspirante['curp']) ?>">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Parcial 1</label>
                    <input type="number" name="parcial1" min="0" max="100"
                        value="<?= esc($calificaciones['parcial1']) ?>" class="w-full border px-3 py-2 rounded"
                        required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Parcial 2</label>
                    <input type="number" name="parcial2" min="0" max="100"
                        value="<?= esc($calificaciones['parcial2']) ?>" class="w-full border px-3 py-2 rounded"
                        required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Parcial 3</label>
                    <input type="number" name="parcial3" min="0" max="100"
                        value="<?= esc($calificaciones['parcial3']) ?>" class="w-full border px-3 py-2 rounded"
                        required>
                </div>
            </div>

            <?php
            $p1 = (float) $calificaciones['parcial1'];
            $p2 = (float) $calificaciones['parcial2'];
            $p3 = (float) $calificaciones['parcial3'];
            $promedio = ($p1 + $p2 + $p3) / 3;
            $estado = $promedio >= 70 ? 'Aprobado' : 'No Aprobado';
            $color = $promedio >= 70 ? 'text-green-600' : 'text-red-600';
            ?>

            <div class="mt-4 text-lg font-bold <?= $color ?>">
                Promedio: <?= number_format($promedio, 2) ?> — <?= $estado ?>
            </div>

            <div class="flex gap-4 mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Guardar
                </button>
                <a href="<?= base_url('grupos') ?>"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    ← Volver a Grupos
                </a>
            </div>
        </form>
    </div>
</body>

</html>