<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <title>Aspirantes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">
            Aspirantes en el grupo: <span class="text-gray-800"><?= esc($grupo['nombre']) ?></span>
        </h2>

        <!-- 🟢 INICIO FORMULARIO -->
        <form action="<?= base_url('grupo/guardar_aprobados') ?>" method="post">

            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full table-auto border border-gray-200 rounded-lg bg-white">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="border px-4 py-3 text-left">CURP</th>
                            <th class="border px-4 py-3 text-left">Nombre Completo</th>
                            <th class="border px-4 py-3 text-left">Sede</th>
                            <th class="border px-4 py-3 text-left">Carrera</th>
                            <th class="border px-4 py-2">¿Aprobó?</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php if (empty($aspirantes)): ?>
                            <tr class="text-center">
                                <td colspan="5" class="px-6 py-4 text-gray-500">No hay aspirantes en este grupo.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($aspirantes as $a): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-3"><?= esc($a['curp']) ?></td>
                                    <td class="border px-4 py-3">
                                        <?= esc($a['nombre'] . ' ' . $a['primer_apellido'] . ' ' . $a['segundo_apellido']) ?>
                                    </td>
                                    <td class="border px-4 py-3"><?= esc($a['nombre_sede']) ?></td>
                                    <td class="border px-4 py-3"><?= esc($a['nombre_carrera']) ?></td>
                                    <td class="border px-4 py-2 text-center">
                                        <input type="checkbox" name="aprobados[]" value="<?= esc($a['curp']) ?>"
                                            class="form-checkbox h-5 w-5 text-green-600" <?= isset($a['nivelacion_aprobado']) && $a['nivelacion_aprobado'] ? 'checked' : '' ?>>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- 🟢 BOTONES -->

            <div class="mt-4 flex gap-4">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition shadow">
                    Guardar Aprobados
                </button>

                <a href="<?= base_url('grupo/exportar_aprobados/' . $grupo['id']) ?>"
                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition shadow">
                    Exportar PDF de Aprobados
                </a>

            </div>
        </form>
        <!-- 🔴 FIN FORMULARIO -->


        <!-- 🔵 BOTÓN VOLVER (SE MANTIENE COMO LO TENÍAS) -->
        <div class="mt-6">
            <a href="<?= base_url('grupos') ?>"
                class="inline-block bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition font-medium shadow">
                ← Volver a Grupos
            </a>
        </div>
    </div>

</body>

</html>